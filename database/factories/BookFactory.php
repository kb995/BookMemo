<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'cover' => '',
        'author' => $faker->name,
        'isbn' => '123456789',
        'description' => $faker->paragraph,
        // 'status' => '',
        // 'rank' => '',
        'user_id' => 1,
    ];
});
