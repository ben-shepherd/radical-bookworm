<?php

declare(strict_types=1);

namespace App\Domains\Books\Controllers;

use App\Domains\Books\Contracts\BooksApiServiceContract;
use App\Domains\Books\DTOs\Services\BooksApiGetOptionsDTO;
use App\Domains\Books\DTOs\Services\GetCachedBestSellerOptions;
use App\Domains\Books\Requests\BestSellersRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Get(
 *     path="/api/best-sellers",
 *     tags={"Books"},
 *     summary="Get best selling books",
 *     description="",
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
    public function __invoke(BooksApiServiceContract $booksApiService): JsonResponse
    {
        return new JsonResponse(
            $booksApiService->getCachedBestSellers()
        );
    }
}

