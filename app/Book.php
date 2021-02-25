<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title', 'description', 'quantity',
    ];
    public $timestamps = false;
    public function users(){
        return $this->hasManyThrough(User::class,Borrow::class);
    }
}
