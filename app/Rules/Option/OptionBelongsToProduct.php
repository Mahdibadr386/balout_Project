<?php

namespace App\Rules\Option;

use App\Models\Option;
use Illuminate\Contracts\Validation\Rule;

class OptionBelongsToProduct implements Rule
{
    protected int|null $productId;

    public function __construct(?int $productId = null)
    {

        $this->productId = $productId;
    }

    public function passes($attribute, $value)
    {

        $productId = $this->productId ?? request()->input('product_id');

        if (! $productId) {
            return false;
        }



        return Option::where('id', $value)
            ->where('product_id', $productId)
            ->exists();
    }

    public function message()
    {
        return 'گزینه انتخاب‌شده متعلق به این محصول نیست.';
    }
}
