<?php

declare(strict_types=1);

namespace App\Domains\Books\Controllers;

use App\Domains\Books\Contracts\BooksApiServiceContract;
use App\Domains\Books\DTOs\Services\BooksApiGetOptionsDTO;
use App\Domains\Books\Requests\BestSellersRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Get(
 *     path="/api/best-sellers",
 *     tags={"Books"},
 *     summary="Get best selling books",
 *     description="",
 *     @OA\Parameter(
 *         name="search",
 *         in="query",
 *         @OA\Schema(type="string"),
 *         description="Search term to filter the results by"
 *     ),
 *     @OA\Parameter(
 *         name="pageSize",
 *         in="query",
 *         @OA\Schema(type="integer"),
 *         description="Number of items to return per page. Defaults to 20"
 *     ),
 *     @OA\Parameter(
 *         name="cache",
 *         in="query",
 *         @OA\Schema(type="boolean"),
 *         description="Whether to retrieve data from cache or API. Defaults to true"
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Book")
 *         )
 *     )
 * )
 */
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
            return $booksApiService->getBookDTOs($options)->toArray();
        });

        return new JsonResponse($books);
    }

}

