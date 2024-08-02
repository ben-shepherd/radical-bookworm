<?php

declare(strict_types=1);

namespace App\Domains\Books\Controllers;

use App\Domains\Books\Contracts\BooksApiServiceContract;
use App\Domains\Books\DTOs\Services\BooksApiGetOptionsDTO;
use App\Domains\Books\Requests\BestSellersRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class BestSellersController extends Controller
{
    public function __invoke(BooksApiServiceContract $booksApiService, BestSellersRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $search = $validated['search'] ?? '';
        $pageSize = isset($validated['pageSize']) ? (int)$validated['pageSize'] : null;
        $cacheKey = 'best_sellers' . $search . $pageSize;

        $options = new BooksApiGetOptionsDTO($search, $pageSize);

        $books = cache()->remember($cacheKey, now()->addMinutes(5)->toDate(), function () use ($booksApiService, $options) {
            return $booksApiService->getBooks($options)->toArray();
        });

        Log::info('BestSellers cacheKey: ' . $cacheKey . ' Books: ' . json_encode($books));

        return new JsonResponse($books);
    }

}

