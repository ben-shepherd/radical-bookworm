<?php

declare(strict_types=1);

namespace App\Domains\Books\Repository;

use App\Base\Repository;
use App\Domains\Books\Models\Book;

class BookRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(Book::class);
    }

    public function findByExternalId(string $externalId): Book
    {
        /** @var Book */
        return $this->findBy(['externalId' => $externalId]);
    }
}
