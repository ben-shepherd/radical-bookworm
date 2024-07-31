<?php

declare(strict_types=1);

namespace App\Domains\Books\Contracts;

use App\Domains\Books\DTOs\BookDTO;
use App\Domains\Books\DTOs\UpdateBooksOptionsDTO;
use App\Domains\Books\Models\Book;
use Illuminate\Support\Collection;

interface UpdateBooksContract
{
    /**
     * @return Collection<BookDTO>
     */
    public function updateBooks(UpdateBooksOptionsDTO $options): Collection;
}
