<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'cover' => 'book_default.jpg',
        'author' => $faker->name,
        'isbn' => '123456789',
        'description' => $faker->paragraph,
        'status' => '0',
        'rank' => '0',
        'user_id' => 1,
    ];
});
