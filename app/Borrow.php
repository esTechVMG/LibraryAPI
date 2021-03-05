<?php

namespace App;

use App\Http\Resources\BorrowResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Borrow extends Model
{
    public $resource = BorrowResource::class;
    protected $primaryKey = 'id';
    function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    function book(){
        return $this->belongsTo(Book::class,'book_id');
    }
    protected $hidden = [
        
    ];
}
