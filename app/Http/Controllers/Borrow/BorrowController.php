<?php

namespace App\Http\Controllers\Borrow;

use App\Book;
use App\Borrow;
use App\Http\Controllers\Controller;
use App\Http\Resources\BorrowResource;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth')->only('store','destroy');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->showAll(Borrow::all());
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'user_id' => 'required|numeric|min:0|exists:users,id|digits_between:1,10',
            'book_id' => 'required|numeric|min:0|exists:books,id|digits_between:1,10',
        ];
        //dd($request);
        $data = $this->transformAndValidateRequest(BorrowResource::class, $request, $rules);
        $user = User::all()->find($request['user_id']);
        $book = Book::all()->find($request['book_id']);
        $data['user_id'] = $user->id;
        $data['book_id'] = $book->id;
        if($book->is_available == 1){
            $book['is_available'] = 0;
            $book->save();
            $borrow = Borrow::create($data);
            return $this->showOne($borrow,201);
        }else{
            return $this->errorResponse("Book is not available",403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function show(Borrow $borrow)
    {
        return $this->showOne($borrow);
    }

    public function destroy(Borrow $borrow){
        $book = $borrow->book;
        $book->is_available = 1;
        $book->save();
        $borrow->delete();
        return $this->errorResponse('Borrow deleted successfully',200);
    }
}