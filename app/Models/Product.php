<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $appends = [
        'total',
    ];

    protected $fillable = [
        'name',
        'price',
    ];

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_product', 'cart_id', 'product_id');
    }

    public function getTotalAttribute()
    {
        if($this->pivot) return $this->price * $this->pivot->quantity;
        return null;
    }
}