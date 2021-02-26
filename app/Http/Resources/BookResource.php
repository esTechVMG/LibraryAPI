<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends BaseResource
{   
    public static $map = [
        'id' => 'identifier',
        'title' => 'title',
        'description' => 'description',
        'quantity' => 'quantity',
    ];

    public function generateLinks($request)
    {
        return [
            [
                'rel' => 'self',
                'href' => route('books.show', $this->id),
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
