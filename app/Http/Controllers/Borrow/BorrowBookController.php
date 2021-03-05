<?php

namespace App\Http\Controllers\Borrow;

use App\Book;
use App\Borrow;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BorrowBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Borrow $borrow)
    {
        redirect()->route('books.show',$borrow->book);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function show(Borrow $borrow, Book $book)
    {
        return $this->showOne($book);
    }
}
