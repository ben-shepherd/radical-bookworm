<?php

declare(strict_types=1);

namespace App\Domains\Books\Services;

use App\Domains\Books\Contracts\ApiContract;
use App\Domains\Books\Contracts\BooksApiServiceContract;
use App\Domains\Books\DTOs\BookDTO;
use App\Domains\Books\DTOs\Services\BooksApiGetOptionsDTO;
use App\Domains\Books\DTOs\Services\GetCachedBestSellerOptions;
use App\Domains\Books\Exceptions\BooksApiException;
use App\Domains\Books\Factory\BookFactory;
use App\Domains\Books\Repository\BookRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

readonly class BooksApiService implements BooksApiServiceContract
{
    public function __construct(
        private BookRepository $bookRepository,
        private BookFactory    $bookFactory
    )
    {
    }

    /**
     * @return Collection<BookDTO>
     * @throws BooksApiException|BindingResolutionException
     */
    public function getBookDTOs(BooksApiGetOptionsDTO $options): Collection
    {
        Log::info(__CLASS__.__FUNCTION__.'('.json_encode($options).")");
        $results = collect();

        $this->iterateThroughAPIs(function ($api) use (&$results, $options) {

            Log::info('API: '.gettype($api));

            /**
             * @var ApiContract $api
             */
            $books = $api->getBookDTOs($options);

            Log::info('Results: '.count($books));

            $results = $results->merge($books);
        });

        return $results
            ->unique('externalId')
            ->sortBy('title')->values();
    }

    /**
     * @param GetCachedBestSellerOptions $options
     * @return Collection<BookDTO>
     * @throws BindingResolutionException
     * @throws BooksApiException
     */
    public function getCachedBestSellers(GetCachedBestSellerOptions $options): Collection
    {
        if(!$options->cached) {
            cache()->forget($options->cacheKey);
        }

        return cache()->remember($options->cacheKey, $options->cacheMinutes * 60, function() {
            return $this->getBookDTOs(new BooksApiGetOptionsDTO());
        });
    }

    /**
     * Iterates through all available apis and updates the books collection.
     *
     * @throws BooksApiException
     * @throws BindingResolutionException
     */
    public function updateBooks(BooksApiGetOptionsDTO $options): Collection
    {
        $results = collect();

        $this->iterateThroughAPIs(function ($api) use (&$results, $options) {
            /**
             * @var ApiContract $api
             */
            $bookDTOs = $api->getBookDTOs($options);

            foreach ($bookDTOs as $bookDTO) {
                try {
                    $book = $this->bookRepository->findByExternalId($bookDTO->externalId);

                    $book->title = $bookDTO->title;
                    $book->authors = $bookDTO->authors;
                    $book->description = $bookDTO->description;
                    // Don't overwrite the image (we want to keep picsum URL)
                    //$book->image = $bookDto->image;
                    $book->link = $bookDTO->link;
                    $book->save();

                    $results->push($book);
                    continue;

                } catch (ModelNotFoundException $e) {
                    // do nothing
                }

                // Create for the first time
                $book = $this->bookFactory->createFromDTO($bookDTO);
                $book->save();
                $results->push($book);
            }
        });

        return $results;
    }

    /**
     * @param callable $callback
     * @return void
     * @throws BindingResolutionException
     * @throws BooksApiException
     */
    private function iterateThroughAPIs(callable $callback): void
    {
        $apiClassStrings = config('books.apis');

        foreach ($apiClassStrings as $apiClassString) {

            if (!class_exists($apiClassString)) {
                throw new BooksApiException('API class does not exist');
            }

            $apiClass = app()->make($apiClassString);

            if ($apiClass instanceof ApiContract === false) {
                throw new BooksApiException('API class \'' . $apiClassString . '\' does not implement ApiContract');
            }

            $callback($apiClass);
        }
    }
}
