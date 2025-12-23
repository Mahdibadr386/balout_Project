<?php

namespace App\Http\Requests\Admin\Discount;

use Illuminate\Foundation\Http\FormRequest;

class CodeStoreDiscountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => 'nullable|string|max:50|unique:discount_codes,code',
            'user_id' => 'nullable|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'code.unique' => 'این کد تخفیف قبلاً ثبت شده است.',
            'user_id.exists' => 'کاربر انتخاب‌شده معتبر نیست.',
        ];
    }
}
