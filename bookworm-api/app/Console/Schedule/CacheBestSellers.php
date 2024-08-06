<?php

declare(strict_types=1);

namespace App\Console\Schedule;

use App\Domains\Books\Contracts\BooksApiServiceContract;
use App\Domains\Books\DTOs\Services\BooksApiGetOptionsDTO;
use App\Domains\Books\DTOs\Services\GetCachedBestSellerOptions;
use Illuminate\Support\Facades\Log;

readonly class CacheBestSellers
{
    public function __construct(private BooksApiServiceContract $booksApiService)
    {}

    public function __invoke(): void
    {
        Log::info('Schedule: caching best sellers, next run at '.now()->addHour()->toString());

        $this->booksApiService->getCachedBestSellers(
            new BooksApiGetOptionsDTO(),
            new GetCachedBestSellerOptions(false, 60)
        );
    }
}
