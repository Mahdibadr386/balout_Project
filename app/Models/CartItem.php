<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
    use SoftDeletes;

    protected $table = 'cart_items';

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'price',
        'total_price',
    ];

    protected $casts = [
        'price' => 'float',
        'total_price' => 'float',
        'quantity' => 'integer',
    ];


    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function options()
    {
        return $this->hasMany(CartItemOption::class, 'cart_item_id', 'id');
    }




    public function calculateTotalPrice(): float
    {
        $optionEffect = (float)$this->options()->sum('price_effect');
        return ($this->price + $optionEffect) * $this->quantity;
    }

    protected static function booted()
    {
        static::creating(function ($item) {
            $item->total_price = $item->calculateTotalPrice();
        });

        static::updating(function ($item) {
            $item->total_price = $item->calculateTotalPrice();
        });
    }
}
