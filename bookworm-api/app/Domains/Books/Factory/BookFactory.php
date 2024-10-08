<?php

declare(strict_types=1);

namespace App\Domains\Books\Factory;

use App\Base\Factory;
use App\Domains\Books\DTOs\BookDTO;
use App\Domains\Books\Models\Book;

class BookFactory extends Factory
{
    public function __construct(string $modelClass = Book::class)
    {
        parent::__construct($modelClass);
    }

    public function createFromDTO(BookDTO $data): Book
    {
        $book = new Book();
        $book->externalId = $data->externalId;
        $book->title = $data->title;
        $book->authors = $data->authors;
        $book->description = $data->description;
        $book->image = "https://picsum.photos/536/354.jpg?v=" . $data->externalId;
        $book->link = $data->link;
        return $book;
    }
}
