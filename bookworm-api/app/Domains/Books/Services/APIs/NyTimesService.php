<?php

declare(strict_types=1);

namespace App\Domains\Books\Services\APIs;

use App\Domains\Books\Contracts\UpdateBooksContract;
use App\Domains\Books\DTOs\BookNameDTO;
use App\Domains\Books\DTOs\Services\APIs\NyTimesRequestListOptions;
use App\Domains\Books\DTOs\UpdateBooksOptionsDTO;
use App\Domains\Books\Factory\BookFactory;
use App\Domains\Books\Faker\FakeListResponse;
use App\Domains\Books\Faker\FakeNamesResponse;
use App\Domains\Books\Formatters\NyTimesFormatter;
use App\Domains\Books\Repository\BookRepository;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

readonly class NyTimesService implements UpdateBooksContract
{
    public function __construct(
        private ClientInterface  $client,
        private NyTimesFormatter $formatter,
        private BookRepository   $repository,
        private BookFactory      $factory,
    )
    {
    }

    /**
     * Refreshes all books, updates or creates new books.
     * @param UpdateBooksOptionsDTO $options
     * @return Collection
     */
    public function updateBooks(UpdateBooksOptionsDTO $options): Collection
    {
        Log::info(__CLASS__ . '@' . __FUNCTION__);

        $results = collect();

        /**
         * Response Example
         * array([title => string, description => string, primary_isbn13 => string, ...])
         */
        $response = $this->requestBooks();

        $bookDTOs = $this->formatter->formatBookDetailsArray($response);

        Log::info('Found ' . count($bookDTOs) . ' bookDTOs');

        foreach ($bookDTOs as $bookDto) {

            $book = null;

            try {
                $book = $this->repository->findByExternalId($bookDto->externalId);

                Log::info('Updating book with externalId: ' . $bookDto->externalId . ' Name: ' . $bookDto->title);

                $book->title = $bookDto->title;
                $book->authors = $bookDto->authors;
                $book->description = $bookDto->description;
                $book->image = $bookDto->image;
                $book->link = $bookDto->link;
                $book->save();

                $results->push($book);

            } catch (ModelNotFoundException $e) {
                // do nothing
            }

            Log::info('Creating book with externalId: ' . $bookDto->externalId . ' Name: ' . $bookDto->title);

            $book = $this->factory->createFromArray($bookDto);
            $book->save();
            $results->push($book);
        }

        return $results;
    }

    /**
     * Adds the api-key to the query property.
     */
    private function guzzleOptionsWithApiKey(array $options = []): array
    {
        $options['query'] = array_merge($options['query'] ?? [], [
            'api-key' => config('books.nytimes.apiKey'),
        ]);

        return $options;
    }

    /**
     * Returns an updated list of names used to requestList of books
     */
    public function requestNames(): array
    {
        try {
            $url = 'lists/names.json';

            $response = json_decode(
                $this->client->request('GET', $url, $this->guzzleOptionsWithApiKey())
                    ->getBody()
                    ->getContents()
                ,
                true
            );

            return array_map(function ($resultItem) {
                return new BookNameDTO(
                    $resultItem['list_name']
                );
            }, $response['body']['results'] ?? []);
        } catch (RequestException $e) {
            if ($e->getResponse()->getStatusCode() === 429) {
                return (new FakeNamesResponse())->toArray();
            }
        }
    }

    /**
     * Iterates through names to retrieve an updated list of books
     */
    public function requestBooks(): array
    {
        $nameDTOs = $this->requestNames();
        $results = [];

        Log::info(__CLASS__ . '@' . __FUNCTION__ . ': Found ' . count($nameDTOs) . ' nameDTOs');

        foreach ($nameDTOs as $nameDTO) {

            $response = $this->requestList(
                new NyTimesRequestListOptions($nameDTO->listForUrl)
            );

            Log::info('Found ' . count($response['results'] ?? []) . ' books for ' . $nameDTO->name);

            $results = array_merge($results, $this->getBookDetailsFromResponse($response));
        }

        return $results;
    }

    /**
     * Retrieves an array of books (based off provided list string e.g. hardcover-fiction)
     */
    public function requestList(NyTimesRequestListOptions $optionsDTO): array
    {
        try {
            $bestSellersDate = $optionsDTO->bestSellersDate ?? 'current';
            $publishedDate = $optionsDTO->publishedDate ?? 'current';

            $url = sprintf('lists/%s/%s.json', $bestSellersDate, $optionsDTO->list);

            Log::info(__CLASS__ . '@' . __FUNCTION__ . ': URL: ' . $url);

            return json_decode(
                $this->client->request('GET', $url, $this->guzzleOptionsWithApiKey([
                    'query' => [
                        'published_date' => $publishedDate,
                        'offset' => $optionsDTO->offset ?? 0,
                    ]
                ]))->getBody()->getContents()
                ,
                true
            );
        } catch (RequestException $e) {
            if ($e->getResponse()->getStatusCode() === 429) {
                return (new FakeListResponse())->toArray();
            }
        }
    }

    /**
     * Helper method for getting book details from the response
     */
    private function getBookDetailsFromResponse(array $response): array
    {
        $bookDetails = array_map(function ($resultItem) {
            return $resultItem['book_details'][0] ?? null;
        }, $response['results'] ?? []);

        return array_filter($bookDetails, fn($bookDetail) => $bookDetail !== null);
    }
}
