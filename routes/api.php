<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {
    Route::apiResource('books', 'Book\BookController', ['only' => ['index', 'show', 'store']]);
    Route::apiResource('books.borrows', 'Book\BookBorrowController', ['only' => ['index']]);
    Route::apiResource('books.borrows.users', 'Book\BookBorrowUserController', ['only' => ['index', 'show']]);
    Route::apiResource('books.users', 'Book\BookUserController', ['only' => ['index']]);

    Route::apiResource('users', 'User\UserController', ['only' => ['index', 'show', 'store']]);
    Route::apiResource('users.borrows', 'User\UserBorrowController', ['only' => ['index', 'show']]);
    Route::apiResource('users.borrows.books', 'User\UserBorrowBookController', ['only' => ['index', 'show']]);
    Route::apiResource('users.books', 'User\UserBookController', ['only' => ['index', 'show']]);

    Route::apiResource('borrows', 'Borrow\BorrowController', ['only' => ['index', 'show', 'store']]);
    Route::apiResource('borrows.books', 'Borrow\BorrowBookController', ['only' => ['index']]);
    Route::apiResource('borrows.users', 'Borrow\BorrowController', ['only' => ['index']]);
    
    Route::post('login', 'User\UserController@login')->name('login');
});
