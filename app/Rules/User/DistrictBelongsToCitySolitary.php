<?php

namespace App\Rules\User;

use Illuminate\Contracts\Validation\Rule;
use App\Models\District;

class DistrictBelongsToCitySolitary implements Rule
{
    protected $cityId;

    public function __construct($cityId)
    {
        $this->cityId = $cityId;
    }

    public function passes($attribute, $value)
    {
        if (!$value) return true;
        return District::where('id', $value)
            ->where('city_id', $this->cityId)
            ->exists();
    }

    public function message()
    {
        return 'ناحیه انتخاب شده متعلق به شهر انتخاب شده نیست.';
    }
}
