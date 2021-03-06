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
    public function index(Borrow $borrow){
        return $this->showAll(collect([$borrow->user]));
    }    
}
