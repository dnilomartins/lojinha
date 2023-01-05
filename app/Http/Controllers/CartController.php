<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\RemoveProductRequest;

class CartController extends Controller
{
    public function index()
    {
        return Cart::all();
    }

    public function show()
    {
        return Cart::with('products')->get();
    }
    
    public function addProduct(AddProductRequest $request, Cart $cart)
    {
        $product = $cart->products()->find($request->product_id);
        if($product)
        {
            $previous_quantity = $product->pivot->quantity;
            $cart->products()->updateExistingPivot($request->product_id, ['quantity' => $previous_quantity + $request->quantity]);
        }
        else
        {
            $cart->products()->attach($request->product_id, ['quantity' => $request->quantity]);
        }
        return $cart;
    }

    public function removeProduct(RemoveProductRequest $request, Cart $cart)
    {
        $product = $cart->products()->findOrFail($request->product_id);
        $previous_quantity = $product->pivot->quantity;

        abort_if($request->quantity > $previous_quantity, 500, 'A quantidade é maior do que a quantidade atual');

        if($request->quantity < $previous_quantity)
        {
            $cart->products()->updateExistingPivot($request->product_id, ['quantity' => $previous_quantity - $request->quantity]);
        }
        else
        {
            $cart->products()->detach($request->product_id);
        }
        return $cart;
    }

    public function removeAllProducts(Cart $cart)
    {
        return $cart->products()->detach();
    }
}