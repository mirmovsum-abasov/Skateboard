<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class Products extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        factory(\App\Models\ProductType::class, 3)->create();
        factory(\App\Models\Colors::class, 3)->create();

        for ($i=0; $i<=30; $i++){
            $product_t = \App\Models\ProductType::findOrFail($faker->randomElement([1,2,3]));
            $product_c = \App\Models\Colors::findOrFail($faker->randomElement([1,2,3]));
            $create = new \App\Models\Product();
            $create->name = $faker->sentence;
            $create->product_type = $product_t->id;
            $create->product_color = $product_c->id;
            $create->price = rand(50,200);
            $create->extra_price = rand(10,100);
            $create->save();

            $p_c = new \App\Models\ProductColor();
            $p_c->product_id = $create->id;
            $p_c->color_id = $product_c->id;
            $p_c->save();
        }
    }
}
