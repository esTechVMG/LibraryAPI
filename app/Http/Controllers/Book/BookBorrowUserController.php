<?php

namespace App\Http\Controllers\Book;

use App\Book;
use App\Borrow;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class BookBorrowUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Book $book, Borrow $borrow){
        $users = collect([$borrow->user]);
        return $this->showAll($users);
    }
}
