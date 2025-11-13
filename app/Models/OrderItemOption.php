<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItemOption extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'order_item_id', 'option_id', 'option_detail_id',
        'option_name', 'option_detail_name', 'message', 'price_effect'
    ];

    protected $casts = ['price_effect' => 'float'];

    public function item()
    {
        return $this->belongsTo(OrderItem::class);
    }
}

