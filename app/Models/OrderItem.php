<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'order_id', 'product_id', 'quantity',
        'unit_price', 'options_price', 'total_price', 'product_snapshot'
    ];

    protected $casts = [
        'unit_price' => 'float',
        'options_price' => 'float',
        'total_price' => 'float',
        'product_snapshot' => 'array',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function options()
    {
        return $this->hasMany(OrderItemOption::class);
    }

    // OrderItem.php
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}

