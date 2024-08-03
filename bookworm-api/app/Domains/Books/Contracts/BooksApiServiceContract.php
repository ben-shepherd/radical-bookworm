<?php

namespace App\Domains\Books\Contracts;

use App\Domains\Books\DTOs\BookDTO;
use App\Domains\Books\DTOs\Services\BooksApiGetOptionsDTO;
use Illuminate\Support\Collection;

interface BooksApiServiceContract
{
    /**
     * @param BooksApiGetOptionsDTO $options
     * @return Collection<BookDTO>
     */
    public function getBookDTOs(BooksApiGetOptionsDTO $options): Collection;

    /**
     * @return Collection<BookDTO>
     */
    public function updateBooks(BooksApiGetOptionsDTO $options): Collection;
}
