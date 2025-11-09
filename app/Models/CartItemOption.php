<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItemOption extends Model
{
    use SoftDeletes;

    protected $table = 'cart_item_options';

    protected $fillable = [
        'cart_item_id',
        'option_id',
        'option_detail_id',
        'price_effect',
        'option_message_id',
    ];

    protected $casts = [
        'price_effect' => 'float',
    ];


    public function item()
    {
        return $this->belongsTo(CartItem::class, 'cart_item_id', 'id');
    }

    public function option()
    {
        return $this->belongsTo(Option::class, 'option_id', 'id')->with('messages');
    }


    public function optionDetail()
    {
        return $this->belongsTo(OptionDetail::class, 'option_detail_id', 'id');
    }

    public function optionMessage()
    {
        return $this->belongsTo(OptionMessage::class, 'option_message_id', 'id');
    }




    protected static function booted()
    {
        static::creating(function ($cio) {
            if (!$cio->price_effect) {
                $cio->price_effect = optional($cio->optionDetail)->price ?? 0;
            }
        });
    }
}
