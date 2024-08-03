<?php

declare(strict_types=1);

namespace App\Domains\Books\Services\APIs;

use App\Domains\Books\Contracts\ApiContract;
use App\Domains\Books\DTOs\Services\BooksApiGetOptionsDTO;
use App\Domains\Books\DTOs\UpdateBooksOptionsDTO;
use App\Domains\Books\Formatters\ExternalBookFormatter;
use App\Domains\Books\Models\ExternalBook;
use Illuminate\Support\Collection;

readonly class ExternalBookService implements ApiContract
{
    public function __construct(public ExternalBookFormatter $formatter)
    {
    }

    public function getBookDTOs(BooksApiGetOptionsDTO $options): Collection
    {
        return collect(
            $this->formatter->formatBookDetailsArray(
                ExternalBook::query()
                    ->when($options->search, function ($query, $search) {
                        $query->where(function ($query) use ($search) {
                            $query->where('title', 'like', "%{$search}%")
                                ->orWhere('description', 'like', "%{$search}%");
                        });
                    })
                    ->when($options->pageSize, function ($query, $pageSize) {
                        $query->limit($pageSize);
                    })
                    ->get()
                    ->toArray()
            )
        );

    }

    public function updateBooks(UpdateBooksOptionsDTO $options): Collection
    {
        return collect();
    }
}
