<?php

namespace App\Http\Controllers\Book;
use App\Book;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    /*public function __construct()
	{
		//$this->middleware('auth');
	}*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->showAll(Book::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'title'       => 'required|max:100|string',
            'description'      => 'required|max:1000|string',
            'quantity' => 'required|numeric|max:9000'
        );
        $request->validate($rules);
        $book = Book::create($request->only('title', 'description', 'quantity'));
        return $this->showOne($book);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return $this->showOne($book);
    }
}
