<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{

    protected $fillable = [
        'address',
        'tel',
        'user_id',
        'city_id',
        'district_id',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'city_id' => 'integer',
        'district_id' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
