<?php

declare(strict_types=1);

namespace App\Domains\Books\Factory;

use App\Base\Factory;
use App\Domains\Books\Models\BookFavourite;

class BookFavouriteFactory extends Factory
{
    public function __construct(string $modelClass = BookFavourite::class)
    {
        parent::__construct($modelClass);
    }

    public function createFromUserAndBook(string $userId, string $bookId): BookFavourite
    {
        /** @var BookFavourite $bookFavourite */
        $bookFavourite = $this->create();
        $bookFavourite->userId = $userId;
        $bookFavourite->bookId = $bookId;

        return $bookFavourite;
    }
}
