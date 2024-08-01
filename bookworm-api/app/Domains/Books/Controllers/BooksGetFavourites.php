<?php

declare(strict_types=1);

namespace App\Domains\Books\Controllers;

use App\Domains\Books\Repository\BookRepository;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class BooksGetFavourites extends Controller
{
    public function __invoke(BookRepository $repository): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();

        return new JsonResponse(
            $repository->findUserFavouriteBooks($user)
        );
    }
}

