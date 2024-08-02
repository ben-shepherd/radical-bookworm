<?php

declare(strict_types=1);

namespace App\Domains\Books\Formatters;

use App\Domains\Books\Contracts\FormatterContract;
use App\Domains\Books\DTOs\BookDTO;

class NyTimesFormatter implements FormatterContract
{
    /**
     * The book details array received from the NY Times API.
     *
     * @param array<string, mixed> $data
     * The array contains the following properties:
     * - primary_isbn13: (string|null) The primary ISBN13 of the book.
     * - title: (string|null) The title of the book.
     * - description: (string|null) The description of the book.
     * - author: (string|null) The author of the book.
     *
     * @return array<BookDTO>
     */
    public function formatBookDetailsArray(array $data): array
    {
        return array_map(function ($item) {

            $externalId = $item['primary_isbn13'] ?? null;
            $title = $item['title'] ?? '';
            $description = $item['description'] ?? '';
            $authors = [$item['author'] ?? ''];
            $image = "https://picsum.photos/536/354.jpg?v=" . $externalId;
            $url = '';

            return new BookDTO(
                externalId: $externalId,
                title: $title,
                authors: $authors,
                description: $description,
                image: $image,
                link: $url
            );
        }, $data);
    }
}
