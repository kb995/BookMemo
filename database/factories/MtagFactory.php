<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Mtag;
use Faker\Generator as Faker;

$factory->define(Mtag::class, function (Faker $faker) {
    return [
        'name' => 'サンプルタグ',
        'book_id' => 1,
        'user_id' => 1,
    ];
});
