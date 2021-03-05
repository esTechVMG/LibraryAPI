<?php

namespace App\Http\Controllers\User;

use App\Book;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $borrows = $user->borrows;
        $out = collect([]);
        foreach ($borrows as $borrow){
            $out->push($borrow->book);
        }
        return $this->showAll($out);
    }
    public function show(User $user, Book $book){
        return $this->showOne($book);
    }
}
