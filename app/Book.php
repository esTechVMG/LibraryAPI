<?php

namespace App;

use App\Http\Resources\BookResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    
    protected $primaryKey = 'id';
    public $resource = BookResource::class;

    protected $fillable = [
        'title', 'description', 'quantity',
    ];
    public $timestamps = false;

    public function borrows(){
        return $this->hasMany(Borrow::class);
    }
}
