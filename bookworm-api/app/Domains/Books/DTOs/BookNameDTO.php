<?php

declare(strict_types=1);

namespace App\Domains\Books\DTOs;

class BookNameDTO
{
    public function __construct(
        public string  $name,
        public ?string $listForUrl = null
    )
    {
        $this->listForUrl = strtolower(str_replace(' ', '-', $this->name));
    }
}
