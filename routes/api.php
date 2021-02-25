<?php

use Illuminate\Http\Request;
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
Route::apiResources([
    'users' => 'User\UserController',
    'users.borrows' => 'User\UserBorrowController',
    'users.books' => 'User\UserBookController',
    'books' => 'Book\BookController',
    'books.borrows' => 'Book\BookBorrowController',
    'books.users' => 'Book\BookUserController',
    'borrows' => 'Borrow\BorrowController',
    'borrows.users' => 'Borrow\BorrowUserController',
    'borrows.books' => 'Borrow\BorrowBookController',
]);
Route::post('login', 'User\UserController@login')->name('login');