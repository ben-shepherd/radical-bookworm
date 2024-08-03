<?php

declare(strict_types=1);

namespace App\Domains\Books\Controllers;

use App\Domains\Books\DTOs\BookDTO;
use App\Domains\Books\Factory\BookFactory;
use App\Domains\Books\Repository\BookRepository;
use App\Domains\Books\Requests\BookCreateRequest;
use App\Domains\Books\Requests\BookIndexRequest;
use App\Domains\Books\Requests\BookUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class BooksController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/books",
     *     summary="List all books",
     *     tags={"Books"},
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search string",
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number",
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Parameter(
     *         name="pageSize",
     *         in="query",
     *         description="Page size",
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Book")
     *         )
     *     ),
     * )
     */
    public function index(BookRepository $repository, BookIndexRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $search = $validated['search'] ?? '';
        $page = (int)($validated['page'] ?? 1);
        $pageSize = (int)($validated['pageSize'] ?? 10);

        return new JsonResponse(
            $repository->findManyBySearchQuery($search, $page, $pageSize)->get()
        );
    }

    /**
     * @OA\Post(
     *     path="/api/books",
     *     summary="Create a new book",
     *     tags={"Books"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/BookCreateRequest")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Book")
     *     )
     * )
     */
    public function store(BookFactory $factory, BookRepository $repository, BookCreateRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            $book = $repository->findByExternalId($validated['externalId']);
            return new JsonResponse($book);
        } catch (ModelNotFoundException $e) {
            // do nothing
        }

        $bookDTO = new BookDTO(
            $validated['externalId'] ?? '',
            $validated['title'] ?? '',
            $validated['authors'] ?? [],
            $validated['description'] ?? '',
            $validated['image'] ?? '',
            $validated['link'] ?? ''
        );

        $book = $factory->createFromDTO($bookDTO);
        $book->save();

        return new JsonResponse($book);
    }


    /**
     * @OA\Get(
     *     path="/api/books/{id}",
     *     summary="Get a book",
     *     tags={"Books"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Book")
     *     )
     * )
     */
    public function show(BookRepository $repository, string $id): JsonResponse
    {
        return new JsonResponse(
            $repository->find($id)
        );
    }

    /**
     * @OA\Put(
     *     path="/api/books/{id}",
     *     summary="Update a book",
     *     tags={"Books"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/BookUpdateRequest")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Book")
     *     )
     * )
     */
    public function update(BookRepository $repository, BookUpdateRequest $request, string $id): JsonResponse
    {
        $validated = $request->validated();
        $book = $repository->find($id);
        $book->update($validated);

        return new JsonResponse($book);
    }

    /**
     * @OA\Delete(
     *     path="/api/books/{id}",
     *     summary="Delete a book",
     *     tags={"Books"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource not found"
     *     )
     * )
     */
    public function destroy(BookRepository $repository, string $id): JsonResponse
    {
        try {
            $book = $repository->find($id);
            $book->delete();
        } catch (ModelNotFoundException $e) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Resource not found'
            ], 404);
        }

        return new JsonResponse([
            'success' => true
        ]);
    }
}

