<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Order extends Model
{
    use SoftDeletes , Searchable;

    protected $fillable = [
        'order_number', 'user_id', 'address_id', 'status',
        'subtotal', 'discount', 'shipping_cost', 'tax', 'total',
        'payment_method', 'currency', 'meta'
    ];

    protected $casts = [
        'subtotal' => 'float',
        'discount' => 'float',
        'shipping_cost' => 'float',
        'tax' => 'float',
        'total' => 'float',
        'meta' => 'array',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function payments()
    {
        return $this->hasMany(PaymentTransaction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function address()
    {
        return $this->belongsTo(UserAddress::class);
    }


    public function toSearchableArray(): array
    {
        return [
            'order_number'        => $this->order_number ?? '',
        ];
    }
}

