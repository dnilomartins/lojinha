<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_itens',
        'total_amout',
    ];

    public function user()
    {
        return $this->belogsTo(User::class);
    }
}