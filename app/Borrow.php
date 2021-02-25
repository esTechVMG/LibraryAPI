<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    function user(){
        return $this->hasOne('App\User');
    }
    function book(){
        return $this->hasOne('App\Book');
    }
}
