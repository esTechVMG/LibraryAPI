<?php

namespace App\Http\Controllers\User;

use App\Borrow;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserBorrowController extends Controller
{
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
}