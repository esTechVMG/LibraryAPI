<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use App\Borrow;
use App\User;
use Faker\Generator as Faker;

$factory->define(Borrow::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'book_id' => Book::all()->random()->id
    ];
});
