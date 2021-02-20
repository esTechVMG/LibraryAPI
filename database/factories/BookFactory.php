<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'description' => $faker->paragraph(1,true),
        'quantity' => $faker->randomNumber(9,false)
    ];
});
