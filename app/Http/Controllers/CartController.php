<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Requests\AddProductRequest;

class CartController extends Controller
{
    public function index()
    {
        return Cart::with('products')->get();
    }

    public function show(Cart $cart)
    {
        return $cart;
    }
    
    public function addProduct(AddProductRequest $request, Cart $cart)
    {
        $cart->products()->attach($request->product_id);
        return $cart;
    }
}
