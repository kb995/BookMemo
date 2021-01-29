<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Memo;
use Faker\Generator as Faker;

$factory->define(Memo::class, function (Faker $faker) {
    return [
        'memo' => $faker->sentence,
        'folder' => null,
        'book_id' => 1,
    ];
});
