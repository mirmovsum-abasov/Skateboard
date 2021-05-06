<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Colors;
use App\Models\ProductType;
use Faker\Generator as Faker;

$factory->define(\App\Models\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'product_type' => factory(ProductType::class)->create()->id,
        'product_color' => factory(Colors::class)->create()->id,
        'price' => mt_rand(3),
        'extra_price' => mt_rand(2)
    ];
});
