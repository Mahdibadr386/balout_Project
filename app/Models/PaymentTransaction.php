<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentTransaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'order_id', 'gateway', 'gateway_transaction_id',
        'amount', 'status', 'currency',
        'request_payload', 'response_payload', 'idempotency_key'
    ];

    protected $casts = [
        'amount' => 'float',
        'request_payload' => 'array',
        'response_payload' => 'array',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

