<?php

declare(strict_types=1);

namespace App\Domains\Books\Controllers;

use App\Domains\Books\Contracts\BooksApiServiceContract;
use App\Domains\Books\DTOs\Services\BooksApiGetOptionsDTO;
use App\Domains\Books\Requests\BestSellersRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class BestSellersController extends Controller
{
    public function __invoke(BooksApiServiceContract $booksApiService, BestSellersRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $search = $validated['search'] ?? '';
        $pageSize = isset($validated['pageSize']) ? (int)$validated['pageSize'] : null;
        $cacheKey = 'best_sellers';

        $options = new BooksApiGetOptionsDTO($search, $pageSize);

        if (request()->input('cache') === 'false') {
            cache()->forget($cacheKey);
        }

        $books = cache()->remember($cacheKey, now()->addMinutes(5)->toDate(), function () use ($booksApiService, $options) {
            return $booksApiService->getBooks($options)->toArray();
        });

        return new JsonResponse($books);
    }

}

