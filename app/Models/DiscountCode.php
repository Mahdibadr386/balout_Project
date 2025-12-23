<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{


    protected $table = 'discount_codes';

    protected $fillable = [
        'discount_id',
        'user_id',
        'code',
        'used_at'
    ];

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function usage()
    {
        return $this->hasOne(DiscountUsage::class);
    }

    public function isUsed(): bool
    {
        return $this->usage()->exists();
    }
}
