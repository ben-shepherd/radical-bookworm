<?php

declare(strict_types=1);

namespace App\Domains\Books\Services\APIs;

use App\Domains\Books\Contracts\ApiContract;
use App\Domains\Books\DTOs\BookDTO;
use App\Domains\Books\DTOs\BookNameDTO;
use App\Domains\Books\DTOs\Services\APIs\NyTimesRequestListOptions;
use App\Domains\Books\DTOs\Services\BooksApiGetOptionsDTO;
use App\Domains\Books\Faker\FakeListResponse;
use App\Domains\Books\Faker\FakeNamesResponse;
use App\Domains\Books\Formatters\NyTimesFormatter;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

readonly class NyTimesService implements ApiContract
{
    public function __construct(
        private ClientInterface  $client,
        private NyTimesFormatter $formatter
    )
    {
    }

    public function getBookDTOs(BooksApiGetOptionsDTO $options): Collection
    {
        $unformattedBooksArray = $this->requestBooks($options->filterByCategory);

        $bookDTOs = collect($this->formatter->formatBookDetailsArray($unformattedBooksArray));

        if (strlen($options->search) > 0) {
            $search = strtolower($options->search);

            $bookDTOs = $bookDTOs->filter(function (BookDTO $book) use ($search) {
                $author = $book->authors[0] ?? '';

                return str_contains(strtolower($book->title), $search)
                    || str_contains(strtolower($book->description), $search)
                    || str_contains(strtolower($author), $search);
            });
        }

        return !is_numeric($options->pageSize) ? $bookDTOs : $bookDTOs->take($options->pageSize);

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
        $handleResponse = function ($response) {
            return array_map(function ($resultItem) {
                return new BookNameDTO(
                    $resultItem['list_name']
                );
            }, $response['results'] ?? []);
        };

        try {
            $url = 'lists/names.json';

            $response = json_decode(
                $this->client->request('GET', $url, $this->guzzleOptionsWithApiKey())
                    ->getBody()
                    ->getContents()
                , true
            );

            return $handleResponse($response['body'] ?? []);

        } catch (RequestException $e) {
            if ($e->getResponse()->getStatusCode() === 429) {
                return $handleResponse((new FakeNamesResponse())->toArray());
            }
        }

        return $handleResponse([]);
    }

    /**
     * Iterates through names to retrieve an updated list of books
     */
    public function requestBooks($category = null): array
    {
        Log::info(__CLASS__ . '::' . __FUNCTION__ . '(' . $category . ')');

        if ($category) {
            return $this->getBookDetailsFromResponse(
                $this->requestList(
                    new NyTimesRequestListOptions($category)
                )
            );
        }

        $nameDTOs = $this->requestNames();
        $results = [];

        Log::info('Names: ' . json_encode($nameDTOs));

        foreach ($nameDTOs as $nameDTO) {

            // If the nameDTO is not an instance of BookNameDTO, we skip it (bug where it can be string sometimes)
            if ($nameDTO instanceof BookNameDTO === false) {
                continue;
            }

            $options = new NyTimesRequestListOptions($nameDTO->listForUrl);

            Log::info('Current name: ' . $nameDTO->listForUrl . ' Options: ' . json_encode($options));

            $response = $this->requestList($options);

            $bookDetailsArray = $this->getBookDetailsFromResponse($response);

            Log::info('List response: ' . count($bookDetailsArray));

            $results = array_merge($results, $bookDetailsArray);
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
            $options = $this->guzzleOptionsWithApiKey([
                'query' => [
                    'published_date' => $publishedDate,
                    'offset' => $optionsDTO->offset ?? 0,
                ]
            ]);
            $response = json_decode($this->client->request('GET', $url, $options)->getBody()->getContents(), true);

            return $response['body'] ?? [];

        } catch (RequestException $e) {
            if ($e->getResponse()->getStatusCode() === 429) {
                return (new FakeListResponse())->toArray();
            }
        }

        return [];
    }

    /**
     * Helper method for getting book details from the response
     */
    private function getBookDetailsFromResponse(array $response): array
    {
        $bookDetails = array_map(function ($resultItem) {
            return $resultItem['book_details'][0] ?? null;
        }, $response);

        return array_filter($bookDetails, fn($bookDetail) => $bookDetail !== null);
    }
}
