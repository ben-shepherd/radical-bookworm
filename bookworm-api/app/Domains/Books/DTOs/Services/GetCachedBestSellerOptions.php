<?php

declare(strict_types=1);

namespace App\Domains\Books\DTOs\Services;

readonly class GetCachedBestSellerOptions
{
    public function __construct(
        public bool $cached = true,
        public int $cacheMinutes = 60,
        public string $cacheKey = 'bestSellers'
    )
    {
    }
}
