<?php

declare(strict_types=1);

namespace App\Domains\Books\DTOs\Services;

class BooksApiGetOptionsDTO
{
    public function __construct(
        public string  $search = '',
        public ?int    $pageSize = 10,
        public ?string $filterByCategory = null
    )
    {
    }
}
