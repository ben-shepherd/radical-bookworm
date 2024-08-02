<?php

declare(strict_types=1);

namespace App\Domains\Books\Contracts;

use App\Domains\Books\DTOs\BookDTO;
use App\Domains\Books\DTOs\Services\BooksApiGetOptionsDTO;
use App\Domains\Books\DTOs\UpdateBooksOptionsDTO;
use Illuminate\Support\Collection;

interface ApiContract
{
    /**
     * @return Collection<BookDTO>
     */
    public function getBooks(BooksApiGetOptionsDTO $options): Collection;

    /**
     * @return Collection<BookDTO>
     */
    public function updateBooks(UpdateBooksOptionsDTO $options): Collection;
}
