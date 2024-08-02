<?php

namespace App\Domains\Books\Contracts;

use App\Domains\Books\DTOs\Services\BooksApiGetOptionsDTO;
use Illuminate\Support\Collection;

interface BooksApiServiceContract
{
    public function getBooks(BooksApiGetOptionsDTO $options): Collection;

    public function updateBooks(): void;
}
