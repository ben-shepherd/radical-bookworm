<?php

declare(strict_types=1);

namespace App\Domains\Books\DTOs\Services\APIs;

use Carbon\Carbon;

final readonly class NyTimesRequestListOptions
{
    public function __construct(
        public string  $list = 'hardcover-fiction',
        public ?Carbon $bestSellersDate = null,
        public ?Carbon $publishedDate = null,
        public ?int    $offset = 0
    )
    {
    }
}
