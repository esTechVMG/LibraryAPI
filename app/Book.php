<?php

namespace App;

use App\Http\Resources\BookResource;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public $resource = BookResource::class;

    protected $fillable = [
        'title', 'description', 'quantity',
    ];
    public $timestamps = false;
    public function users(){
        return $this->hasManyThrough(User::class,Borrow::class);
    }
}
