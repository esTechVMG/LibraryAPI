<?php

namespace App\Http\Controllers\User;

use App\Book;
use App\Borrow;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserBorrowBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, Borrow $borrow){
        return $this->showAll(collect([$borrow->book]));
    }
}
