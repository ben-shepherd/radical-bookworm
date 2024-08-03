<?php

declare(strict_types=1);

namespace App\Domains\Books\Controllers;

use App\Domains\Books\Factory\BookFavouriteFactory;
use App\Domains\Books\Repository\BookFavouriteRepository;
use App\Domains\Books\Repository\BookRepository;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 * @OA\Put(
 *     path="/api/books/{bookId}/favourite",
 *     tags={"Books"},
 *     summary="Toggle book favourite status",
 *     description="",
 *     @OA\Parameter(
 *         name="bookId",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="boolean")
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="type", type="string", enum={"added", "removed"}, example="added")
 *         )
 *     ),
 *     @OA\Response(
 *         response="404",
 *         description="Book not found",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="Book not found")
 *         )
 *     )
 * )
 */
class BooksUpdateFavouriteController extends Controller
{
    public function __invoke(
        BookRepository          $bookRepository,
        BookFavouriteRepository $bookFavouriteRepository,
        BookFavouriteFactory    $bookFavouriteFactory,
        string                  $bookId
    ): JsonResponse
    {
        // Check book exists
        $bookRepository->find($bookId);
        $userId = Auth::id();
        $favourited = false;

        try {
            $bookFavourite = $bookFavouriteRepository->findByUserAndBook($userId, $bookId);
            $bookFavourite->delete();
        } catch (ModelNotFoundException $e) {
            $bookFavourite = $bookFavouriteFactory->createFromUserAndBook($userId, $bookId);
            $bookFavourite->save();
            $favourited = true;
        }

        return new JsonResponse([
            'success' => true,
            'type' => $favourited
        ]);
    }
}

