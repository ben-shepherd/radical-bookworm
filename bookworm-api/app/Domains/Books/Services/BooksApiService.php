<?php

declare(strict_types=1);

namespace App\Domains\Books\Services;

use App\Domains\Books\Contracts\ApiContract;
use App\Domains\Books\Contracts\BooksApiServiceContract;
use App\Domains\Books\DTOs\BookDTO;
use App\Domains\Books\DTOs\Services\BooksApiGetOptionsDTO;
use App\Domains\Books\DTOs\UpdateBooksOptionsDTO;
use App\Domains\Books\Exceptions\BooksApiException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Collection;

class BooksApiService implements BooksApiServiceContract
{
    /**
     * @return Collection<BookDTO>
     * @throws BooksApiException|BindingResolutionException
     */
    public function getBooks(BooksApiGetOptionsDTO $options): Collection
    {
        $results = collect();

        $this->iterateThroughAPIs(function ($api) use (&$results, $options) {
            /**
             * @var ApiContract $api
             */
            $books = $api->getBooks($options);
            $results = $results->merge($books);
        });

        return $results;
    }

    /**
     * Iterates through all available apis and updates the books collection.
     *
     * @throws BooksApiException
     * @throws BindingResolutionException
     */
    public function updateBooks(): void
    {
        $this->iterateThroughAPIs(function ($api) {
            /**
             * @var ApiContract $api
             */
            $api->updateBooks(new UpdateBooksOptionsDTO());
        });
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
