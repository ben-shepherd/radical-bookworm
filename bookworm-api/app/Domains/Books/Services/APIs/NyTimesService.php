<?php

declare(strict_types=1);

namespace App\Domains\Books\Services\APIs;

use App\Domains\Books\Contracts\ApiContract;
use App\Domains\Books\DTOs\BookNameDTO;
use App\Domains\Books\DTOs\Services\APIs\NyTimesRequestListOptions;
use App\Domains\Books\DTOs\Services\BooksApiGetOptionsDTO;
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

readonly class NyTimesService implements ApiContract
{
    public function __construct(
        private ClientInterface  $client,
        private NyTimesFormatter $formatter,
        private BookRepository   $repository,
        private BookFactory      $factory,
    )
    {
    }

    public function getBooks(BooksApiGetOptionsDTO $options): Collection
    {
        $booksArrayUnformatted = $this->requestBooks($options->filterByCategory);
        $bookDTOs = $this->formatter->formatBookDetailsArray($booksArrayUnformatted);
        $booksArray = collect(
            array_map(function ($bookDto) {
                return $bookDto->toArray();
            }, $bookDTOs)
        );

        if (strlen($options->search) > 0) {
            $search = strtolower($options->search);

            $booksArray = $booksArray->filter(function ($book) use ($search) {
                $author = $book['authors'][0] ?? '';

                return str_contains(strtolower($book['title']), $search)
                    || str_contains(strtolower($book['description']), $search)
                    || str_contains(strtolower($author), $search);
            });
        }

        return !is_numeric($options->pageSize) ? $booksArray : $booksArray->take($options->pageSize);

    }

    /**
     * Refreshes all books, updates or creates new books.
     * @param UpdateBooksOptionsDTO $options
     * @return Collection
     */
    public function updateBooks(UpdateBooksOptionsDTO $options): Collection
    {
        $results = collect();

        /**
         * Response Example
         * array([title => string, description => string, primary_isbn13 => string, ...])
         */
        $response = $this->requestBooks();

        $bookDTOs = $this->formatter->formatBookDetailsArray($response);

        foreach ($bookDTOs as $bookDto) {

            $book = null;

            try {
                $book = $this->repository->findByExternalId($bookDto->externalId);

                $book->title = $bookDto->title;
                $book->authors = $bookDto->authors;
                $book->description = $bookDto->description;
                // Don't overwrite the image (we want to keep picsum URL)
                //$book->image = $bookDto->image;
                $book->link = $bookDto->link;
                $book->save();

                $results->push($book);
                continue;

            } catch (ModelNotFoundException $e) {
                // do nothing
            }

            $book = $this->factory->createFromDTO($bookDto);
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
    public function requestBooks($category = null): array
    {
        if ($category) {
            return $this->getBookDetailsFromResponse(
                $this->requestList(
                    new NyTimesRequestListOptions($category)
                )
            );
        }

        $nameDTOs = $this->requestNames();
        $results = [];

        foreach ($nameDTOs as $nameDTO) {

            // If the nameDTO is not an instance of BookNameDTO, we skip it (bug where it can be string sometimes)
            if ($nameDTO instanceof BookNameDTO === false) {
                continue;
            }

            if ($category && $nameDTO->listForUrl !== $category) {
                continue;
            }
            $response = $this->requestList(
                new NyTimesRequestListOptions($nameDTO->listForUrl)
            );

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
