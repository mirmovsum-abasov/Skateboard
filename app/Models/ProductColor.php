<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    public function color()
    {
        return $this->belongsToMany(
            Colors::class,
            Product::class,
            'color_id',
            'product_id'
        );
    }


}
