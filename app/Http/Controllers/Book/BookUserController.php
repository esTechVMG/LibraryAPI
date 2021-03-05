<?php

namespace App\Http\Controllers\Book;

use App\Book;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class BookUserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param \App\Book
     * @return \Illuminate\Http\Response
     */
    
    public function index(Book $book)
    {
        $collection = collect([]);
        foreach ($book->borrows as $borrow){
            $collection->push($borrow->user);
        }
        return $this->showAll($collection,201);
    }

    public function show(Book $book,User $user){
        return $this->showOne($user);
    }
}
