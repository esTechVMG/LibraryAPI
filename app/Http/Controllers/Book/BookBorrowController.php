<?php

namespace App\Http\Controllers\Book;

use App\Book;
use App\Borrow;
use App\Http\Controllers\Controller;
use App\Http\Resources\BorrowResource;
use App\User;
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

    public function show(Book $book, Borrow $borrow){
        return $this->showOne($borrow);
    }
    public function store(Book $book, Request $request){
        $rules = [
            'user_id' => 'numeric|min:0|digits_between:1,10|required|exists:users,id',
        ];
        $data = $this->transformAndValidateRequest(BorrowResource::class, $request, $rules);
        $data['book_id'] = $book->id;
        $borrow = Borrow::create($data);
        if($book->is_available == 1){
            $book['is_available'] = 0;
            $book->save();
            return $this->showOne($borrow,201);
        }else{
            return $this->errorResponse("Book is not available",403);
        }
    }
}
