<?php

namespace App\Http\Controllers\Borrow;

use App\Borrow;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class BorrowUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Borrow
     * @return \Illuminate\Http\Response
     */
    public function index(Borrow $borrow)
    {
        $users = $borrow->user;
        return $this->showAll($users);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function show(Borrow $borrow, User $user)
    {
        return $this->showOne($user);  
    }
}
