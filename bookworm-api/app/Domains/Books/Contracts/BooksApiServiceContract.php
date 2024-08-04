<?php

namespace App\Domains\Books\Contracts;

use App\Domains\Books\DTOs\BookDTO;
use App\Domains\Books\DTOs\Services\BooksApiGetOptionsDTO;
use App\Domains\Books\DTOs\Services\GetCachedBestSellerOptions;
use Illuminate\Support\Collection;

interface BooksApiServiceContract
{
    /**
     * @param BooksApiGetOptionsDTO $options
     * @return Collection<BookDTO>
     */
    public function getBookDTOs(BooksApiGetOptionsDTO $options): Collection;

    /**
     * @param GetCachedBestSellerOptions $options
     * @return Collection<BookDTO>
     */
    public function getCachedBestSellers(GetCachedBestSellerOptions $options): Collection;

    /**
     * @return Collection<BookDTO>
     */
    public function updateBooks(BooksApiGetOptionsDTO $options): Collection;
}
