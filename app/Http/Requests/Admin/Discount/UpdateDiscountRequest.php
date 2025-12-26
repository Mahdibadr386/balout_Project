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

            'discountable_type' => 'required|nullable|string|max:255',
            'discountable_id' => 'required|nullable|integer',

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

            $scope = $this->input('scope');
            $type  = $this->input('type');
            $value = $this->input('value');

            // کنترل منطقی scope
            if (in_array($scope, ['product', 'category'])) {
                if (!$this->filled('discountable_type') || !$this->filled('discountable_id')) {
                    $validator->errors()->add(
                        'discountable',
                        'برای تخفیف محصول یا دسته‌بندی، انتخاب موجودیت الزامی است.'
                    );
                }
            }

            if ($scope === 'order') {
                if ($this->filled('discountable_type') || $this->filled('discountable_id')) {
                    $validator->errors()->add(
                        'discountable',
                        'تخفیف سفارش نباید به محصول یا دسته‌بندی خاصی متصل باشد.'
                    );
                }
            }

            if ($scope === 'personal' && !$this->boolean('is_personal')) {
                $validator->errors()->add(
                    'is_personal',
                    'تخفیف شخصی باید به‌صورت شخصی تعریف شود.'
                );
            }

            // کنترل درصد
            if ($type === 'percent' && $value > 100) {
                $validator->errors()->add(
                    'value',
                    'درصد تخفیف نمی‌تواند بیشتر از ۱۰۰ باشد.'
                );
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
