<?php

declare(strict_types=1);

namespace App\Domains\Books\Services;

use App\Domains\Books\Contracts\UpdateBooksContract;
use App\Domains\Books\DTOs\UpdateBooksOptionsDTO;
use App\Domains\Books\Exceptions\UpdateBooksException;
use Illuminate\Contracts\Container\BindingResolutionException;

class BooksApiService
{
    /**
     * Iterates through all available apis and updates the books collection.
     *
     * @throws UpdateBooksException
     * @throws BindingResolutionException
     */
    public function updateBooks(): void
    {
        $apiClassStrings = config('books.apis');

        foreach ($apiClassStrings as $apiClassString) {

            if (!class_exists($apiClassString)) {
                throw new UpdateBooksException('API class does not exist');
            }

            $apiClass = app()->make($apiClassString);

            if ($apiClass instanceof UpdateBooksContract === false) {
                throw new UpdateBooksException('API class \'' . $apiClassString . '\' does not implement UpdateBooksContract');
            }

            $apiClass->updateBooks(new UpdateBooksOptionsDTO());
        }
    }
}
