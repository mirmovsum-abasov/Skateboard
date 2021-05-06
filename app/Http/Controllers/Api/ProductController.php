<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(15);
        $json     = [];

        foreach ($products as $product) {
            $json [] = [
                'id'=>$product->id,
                'name' => $product->name,
                'color' => $product->allcolor(),
                'type' => $product->type->id
            ];
        }
        return response()->json($json, 201);
    }
}
