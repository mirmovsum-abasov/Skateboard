<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['product_id', 'color_id', 'amount', 'email', 'phone', 'addr', 'delivery_date', 'preparation_date'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
