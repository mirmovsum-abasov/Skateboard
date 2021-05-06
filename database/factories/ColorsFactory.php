<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Colors;
use Faker\Generator as Faker;

$factory->define(Colors::class, function (Faker $faker) {
    return [
        'name' => $faker->colorName,
        'hex_code' => $faker->hexColor,
    ];
});

