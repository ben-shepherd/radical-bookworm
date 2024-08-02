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


    public function show(BookRepository $repository, string $id): JsonResponse
    {
        return new JsonResponse(
            $repository->find($id)
        );
    }

    public function update(BookRepository $repository, BookUpdateRequest $request, string $id): JsonResponse
    {
        $validated = $request->validated();
        $book = $repository->find($id);
        $book->update($validated);

        return new JsonResponse($book);
    }

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

