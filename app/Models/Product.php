<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'product_type', 'product_color', 'price', 'extra_price'];

    public function colors()
    {
        return $this->belongsTo(ProductColor::class, 'id', 'product_id')->get();
    }

    public function colors_ids(){
        $colors = $this->colors();
        $colors_ids = [];
        if (count($colors)>0){
            foreach ($colors as $f)
                $colors_ids[] = $f->color_id;
        }
        return $colors_ids;
    }

    public function allcolor()
    {
        $color = $this->colors_ids();
        $colors = [];
        foreach ($color as $c){
            $fetch = Colors::findOrFail($c);
            $colors []= ['name' => $fetch->name,'hex_code' => $fetch->hex_code];
        }
        return $colors;
    }

    public function type()
    {
        return $this->belongsTo(ProductType::class, 'product_type', 'id');
    }
}
