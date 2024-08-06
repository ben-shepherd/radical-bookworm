<?php

declare(strict_types=1);

namespace App\Domains\Books\Controllers;

use App\Domains\Books\Contracts\BooksApiServiceContract;
use App\Domains\Books\DTOs\Services\BooksApiGetOptionsDTO;
use App\Domains\Books\Requests\BestSellersSearchRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Get(
 *     path="/api/best-sellers-search",
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
class BestSellersSearchController extends Controller
{
    public function __invoke(BooksApiServiceContract $booksApiService, BestSellersSearchRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $search = $validated['search'] ?? '';
        $pageSize = isset($validated['pageSize']) ? (int)$validated['pageSize'] : null;

        return new JsonResponse(
            $booksApiService->getCachedBestSellers(
                new BooksApiGetOptionsDTO($search, $pageSize)
            )
        );
    }

}

