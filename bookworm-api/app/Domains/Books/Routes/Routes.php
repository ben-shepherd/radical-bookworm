<?php

use App\Domains\Books\Controllers\BestSellersController;
use App\Domains\Books\Controllers\BooksController;
use App\Domains\Books\Controllers\BooksGetFavourites;
use App\Domains\Books\Controllers\BooksUpdateFavouriteController;
use Illuminate\Support\Facades\Route;


Route::get('/best-sellers', BestSellersController::class);
Route::resource('/books', BooksController::class);
Route::post('/books/{book}/favourite', BooksUpdateFavouriteController::class);
Route::get('/books-favourites', BooksGetFavourites::class);
