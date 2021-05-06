<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|numeric|exists:products,id',
            'color_id' => 'required|numeric|exists:colors,id',
            'amount' => 'required|numeric|max:10',
            'email' => 'nullable|email|max:100',
            'phone' => 'required_with:email|string|max:20',
            'addr' => 'required|string|max:400'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'error', 'response' => $validator->messages()], 304);
        }

        Order::create([
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'amount' => $request->amount,
            'email' => $request->email ?? null,
            'phone' => $request->phone ?? null,
            'addr' => $request->addr
        ])->save();
        return response()->json(['message' => 'success'], 201);

    }
}
