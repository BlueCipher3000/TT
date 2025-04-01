<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'items',
        'total_price',
        'status',
    ];
    protected $casts = [
        'items' => 'array',
    ];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
