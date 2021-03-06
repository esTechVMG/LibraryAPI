<?php

namespace App\Http\Controllers\User;

use App\Book;
use App\Borrow;
use App\Http\Controllers\Controller;
use App\Http\Resources\BorrowResource;
use App\User;
use Illuminate\Http\Request;

class UserBorrowController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth')->only('store');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $borrows = $user->borrows;
        return $this->showAll($borrows);
    }
    public function show(User $user, Borrow $borrow){
        return $this->showOne($borrow);
    }
    public function store(User $user, Request $request){
        $rules = [
            'book_id' => 'numeric|min:0|digits_between:1,10|required|exists:books,id',
        ];
        $data = $this->transformAndValidateRequest(BorrowResource::class, $request, $rules);
        $book = Book::all()->find($request['book_id']);
        $data['user_id'] = $user->id;
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