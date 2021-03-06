<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SellerController extends Controller
{
    public function index()
    {
        $orders = Order::with('product')->orderBy('id', 'desc')->paginate(15);
        $json   = [];
        foreach ($orders as $order) {
            $json [] = [
                'id' => $order->id,
                'product_id' => $order->product->id,
                'product_name' => $order->product->name,
                'product_color' => $order->product->allcolor(),
                'product_type' => $order->product->type->name,
                'product_amount' => $order->amount,
                'email' => $order->email,
                'phone' => $order->phone,
                'adress' => $order->addr,
                'order_date' => $order->created_at,
                'delivery_date' => $order->delivery_date,
                'preparation_date' => $order->preparation_date
            ];
        }
        return response()->json($json, 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'delivery_date' => 'required|date_format:Y-m-d H:i:s',
            'preparation_date' => 'required|date_format:Y-m-d H:i:s'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'error', 'response' => $validator->messages()], 304);
        }

        $order = Order::find($id);
        $order->update([
            'delivery_date' => $request->delivery_date,
            'preparation_date' => $request->preparation_date
        ]);

        return response()->json(['message' => 'Success', 'response' => 'Success'], 201);

    }
}
