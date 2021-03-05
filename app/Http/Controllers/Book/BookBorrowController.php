<?php

namespace App\Http\Controllers\Book;

use App\Book;
use App\Borrow;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookBorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Book $book)
    {
        $borrows = $book->borrows;
        return $this->showAll($borrows);
    }

    public function show(Book $book,Borrow $borrow){
        return $this->showOne($borrow);
    }
}
