<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class BorrowResource extends BaseResource
{
    public static $map = [
        'id' => 'identifier',
        'user_id' => 'user_id',
        'book_id' => 'book_id',
        'updated_at' => 'last_modified',
        'created_at' => 'creation_date',
    ];
    public function generateLinks($request)
    {
        return [
            [
                'rel' => 'self',
                'href' => route('borrows.show', $this->id),
            ],
            [
                'rel' => 'book',
                'href' => route('books.show', $this->user_id),
            ],
            [
                'rel' => 'user',
                'href' => route('users.show', $this->user_id),
            ],
            
        ];
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
