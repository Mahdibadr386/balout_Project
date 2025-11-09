<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;

    protected $table = 'carts';

    protected $fillable = [
        'user_id',
        'status',
        'subtotal',
        'total',
    ];

    protected $casts = [
        'subtotal' => 'float',
        'total' => 'float',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_id', 'id');
    }


    public function calculateTotals(): void
    {
        $subtotal = $this->items()->sum('total_price');
        $this->update([
            'subtotal' => $subtotal,
            'total' => $subtotal,
        ]);
    }
}
