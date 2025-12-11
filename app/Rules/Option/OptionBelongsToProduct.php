<?php

namespace App\Rules\Option;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class OptionBelongsToProduct implements Rule
{
    protected ?int $productId;

    public function __construct(?int $productId = null)
    {
        $this->productId = $productId;
    }

    public function passes($attribute, $value)
    {
        // $value = option_id
        $productId = $this->productId ?? request()->input('product_id');

        if (! $productId || ! $value) {
            return false;
        }

        // استخراج index از رشته attribute مثلاً: options.1.option_id
        $parts = explode('.', $attribute);
        $index = $parts[1] ?? null;

        if ($index === null) {
            return false;
        }

        // گرفتن detail_id صحیح از آرایه ورودی
        $detailId = request()->input("options.$index.option_detail_id");

        if (! $detailId) {
            return false;
        }

        // چک در جدول option_product
        return DB::table('option_product')
            ->where('product_id', $productId)
            ->where('option_id', $value)
            ->where('detail_id', $detailId)
            ->exists();
    }

    public function message()
    {
        return 'گزینه یا مقدار انتخاب شده برای این محصول معتبر نیست.';
    }
}
