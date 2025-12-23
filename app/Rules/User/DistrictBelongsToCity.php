<?php

namespace App\Rules\User;

use Illuminate\Contracts\Validation\Rule;
use App\Models\District;

class DistrictBelongsToCity implements Rule
{
    protected $addresses;

    /**
     * @param array $addresses آرایه کامل addresses از request
     */
    public function __construct(array $addresses)
    {
        $this->addresses = $addresses;
    }

    /**
     * Determine if the validation rule passes.
     */
    public function passes($attribute, $value)
    {
        preg_match('/addresses\.(\d+)\.district_id/', $attribute, $matches);
        $index = $matches[1] ?? null;

        if ($index === null) {
            return false;
        }

        $cityId = $this->addresses[$index]['city_id'] ?? null;

        if (!$value || !$cityId) {
            return true;
        }

        return District::where('id', $value)
            ->where('city_id', $cityId)
            ->exists();
    }

    /**
     * Get the validation error message.
     */
    public function message()
    {
        return 'ناحیه انتخاب شده متعلق به شهر انتخاب شده نیست.';
    }
}
