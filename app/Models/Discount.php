<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discounts';

    protected $fillable = [
        'name',
        'description',
        'scope',
        'discountable_id',
        'discountable_type',
        'type',
        'value',
        'max_amount',
        'is_personal',
        'starts_at',
        'ends_at',
        'is_active',
    ];

    protected $casts = [
        'used_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];


    public function discountable()
    {
        return $this->morphTo();
    }

    public function codes()
    {
        return $this->hasMany(DiscountCode::class);
    }

    public function usages()
    {
        return $this->hasMany(DiscountUsage::class, 'discount_id');
    }

}
