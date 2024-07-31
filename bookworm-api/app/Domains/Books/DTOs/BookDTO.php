<?php

declare(strict_types=1);

namespace App\Domains\Books\DTOs;

readonly class BookDTO
{
    public function __construct(
        public string $externalId,
        public string $title,
        public array  $authors,
        public string $description,
        public string $image,
        public string $link
    )
    {
    }

    public function toArray(): array
    {
        return [
            'externalId' => $this->externalId,
            'title' => $this->title,
            'authors' => $this->authors,
            'description' => $this->description,
            'image' => $this->image,
            'link' => $this->link,
        ];
    }
}
