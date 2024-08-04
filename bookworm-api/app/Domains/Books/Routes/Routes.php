<?php

use App\Domains\Books\Controllers\BestSellersController;
use App\Domains\Books\Controllers\BooksController;
use App\Domains\Books\Controllers\BooksGetFavourites;
use App\Domains\Books\Controllers\BooksUpdateFavouriteController;
use App\Domains\Books\DTOs\Services\BooksApiGetOptionsDTO;
use App\Domains\Books\Services\BooksApiService;
use App\Domains\Books\Controllers\BestSellersSearchController;
use Illuminate\Support\Facades\Route;

Route::resource('/books', BooksController::class);

Route::get('/best-sellers', BestSellersController::class);

Route::get('/best-sellers-search', BestSellersSearchController::class);

Route::post('/books/{book}/favourite', BooksUpdateFavouriteController::class);

Route::get('/books-favourites', BooksGetFavourites::class);

// used for testing
Route::get('update-books', function () {
    /** @var BooksApiService $booksService */
    $booksService = app()->make(BooksApiService::class);
    $booksService->updateBooks(new BooksApiGetOptionsDTO());
});
