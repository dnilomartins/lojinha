<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $appends = [
        'total',
    ];

    protected $fillable = [
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'cart_product', 'cart_id', 'product_id')->withPivot('quantity');
    }

    public function getTotalAttribute()
    {
        $products = $this->products()->get(['price']);
        return array_reduce($products->toArray(), function($total, $product){
            return $total + $product['price'] * $product['pivot']['quantity'];      
        }, 0);
    }
}