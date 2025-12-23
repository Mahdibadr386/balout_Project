<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountUsage extends Model
{
    protected $table = 'discount_usages';
    protected $fillable = [
        'discount_id',
        'discount_code_id',
        'order_id',
        'user_id',
        'order_subtotal',
        'discount_amount',
        'final_total',
        'used_at',
    ];

    protected $casts = [
        'used_at' => 'datetime',
    ];

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function code()
    {
        return $this->belongsTo(DiscountCode::class, 'discount_code_id');
    }
}
