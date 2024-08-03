<?php

declare(strict_types=1);

namespace App\Domains\Books\Formatters;

use App\Domains\Books\Contracts\FormatterContract;
use App\Domains\Books\DTOs\BookDTO;


class ExternalBookFormatter implements FormatterContract
{
    /**
     * The book details array received from the NY Times API.
     *
     * @param array<string, mixed> $data
     * The array contains the following properties:
     * - isbn: (string|null) The primary isbn of the book.
     * - title: (string|null) The title of the book.
     * - subtitle: (string|null) The subtitle of the book.
     * - author: (string|null) The author of the book.
     * - published: (string|null) The publication date of the book.
     * - publisher: (string|null) The publisher of the book.
     * - pages: (int|null) The number of pages of the book.
     * - description: (string|null) The description of the book.
     * - website: (string|null) The website of the book.
     *
     * @return array<BookDTO>
     */
    public function formatBookDetailsArray(array $data): array
    {
        return array_map(function ($item) {

            $externalId = $item['isbn'] ?? null;
            $title = $item['title'] ?? '';
            $description = $item['description'] ?? '';
            $authors = [$item['author'] ?? ''];
            $image = "https://picsum.photos/536/354.jpg?v=" . $externalId;
            $url = $item['website'] ?? '';

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
