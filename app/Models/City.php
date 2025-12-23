<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    protected $table = 'cities';
    public $timestamps = false;
    protected $fillable = [
        'address',
        'tel',
        'user_id',
        'city_id',
    ];

    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }

    public function districts()
    {
        return $this->hasMany(District::class);
    }

}
