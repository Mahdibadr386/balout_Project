<?php

namespace App\Rules\Option;

use App\Models\OptionDetail;
use Illuminate\Contracts\Validation\Rule;

class OptionDetailBelongsToOption implements Rule
{
    public function passes($attribute, $value)
    {
        $parts = explode('.', $attribute);

        if (count($parts) < 3) {
            return false;
        }

        $index = $parts[1];


        $optionId = request()->input("options.$index.option_id");

        if (! $optionId) {
            return false;
        }


        return OptionDetail::where('id', $value)
            ->where('option_id', $optionId)
            ->exists();
    }

    public function message()
    {
        return 'زیرگزینه انتخاب‌شده متعلق به گزینه انتخاب‌شده نیست.';
    }
}
