<?php

declare(strict_types=1);

namespace App\Domains\Books\Repository;

use App\Base\Repository;
use App\Domains\Books\Models\BookFavourite;

class BookFavouriteRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(BookFavourite::class);
    }

    public function findByUserAndBook(string $userId, string $bookId): ?BookFavourite
    {
        /** @var BookFavourite */
        return $this->createQueryBuilder()
            ->where('userId', $userId)
            ->where('bookId', $bookId)
            ->firstOrFail();
    }
}
