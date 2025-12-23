<?php

namespace App\Http\Requests\Admin\Discount;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDiscountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string|max:1000',

            'scope' => 'sometimes|required|in:product,category,order,personal',

            'discountable_type' => 'sometimes|nullable|string|max:255',
            'discountable_id' => 'sometimes|nullable|integer',

            'type' => 'sometimes|required|in:amount,percent',
            'value' => 'sometimes|required|integer|min:1',

            'max_amount' => 'sometimes|nullable|integer|min:1',

            'is_personal' => 'sometimes|required|boolean',

            'starts_at' => 'sometimes|required|date',
            'ends_at' => 'sometimes|required|date|after:starts_at',

            'is_active' => 'sometimes|boolean',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            if ($this->filled('type') && $this->input('type') === 'percent') {
                if ($this->filled('value') && $this->input('value') > 100) {
                    $validator->errors()->add(
                        'value',
                        'درصد تخفیف نمی‌تواند بیشتر از ۱۰۰ باشد.'
                    );
                }
            }
        });
    }

    public function messages(): array
    {
        return [
            'name.required' => 'نام تخفیف الزامی است.',
            'scope.in' => 'نوع تخفیف انتخاب‌شده معتبر نیست.',
            'ends_at.after' => 'تاریخ پایان باید بعد از تاریخ شروع باشد.',
        ];
    }
}
