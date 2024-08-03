<?php

declare(strict_types=1);

namespace App\Domains\Books\Contracts;

use App\Domains\Books\DTOs\BookDTO;
use App\Domains\Books\DTOs\Services\BooksApiGetOptionsDTO;
use Illuminate\Support\Collection;

interface ApiContract
{
    /**
     * @return Collection<BookDTO>
     */
    public function getBookDTOs(BooksApiGetOptionsDTO $options): Collection;
}
