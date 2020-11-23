<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Btag;
use Faker\Generator as Faker;

$factory->define(Btag::class, function (Faker $faker) {
    return [
        'name' => 'サンプルタグB',
        'book_id' => 1,
    ];
});
