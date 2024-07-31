<?php

declare(strict_types=1);

namespace App\Domains\Books\Contracts;

use App\Domains\Books\DTOs\BookDTO;

interface FormatterContract
{
    /**
     * @param array $data
     * @return array<BookDTO>
     */
    public function formatBookDetailsArray(array $data): array;
}
