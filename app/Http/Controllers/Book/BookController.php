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
        $rules = [
            'title'       => 'required|max:100|string|min:3',
            'description'      => 'required|max:1000|string|min:10',
        ];
        $data = $this->transformAndValidateRequest(BookResource::class, $request, $rules);
        $book = Book::create($data);
        return $this->showOne($book,201);
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
