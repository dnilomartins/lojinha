<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

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

    

}
