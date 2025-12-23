<?php

namespace App\Http\Requests\Admin\Discount;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiscountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',

            'scope' => 'required|in:product,category,order,personal',

            'discountable_type' => 'nullable|string|max:255',
            'discountable_id' => 'nullable|integer',

            'type' => 'required|in:amount,percent',
            'value' => 'required|integer|min:1',

            'max_amount' => 'nullable|integer|min:1',

            'is_personal' => 'required|boolean',

            'starts_at' => 'required|date|after_or_equal:today',
            'ends_at' => 'required|date|after:starts_at',

            'is_active' => 'boolean',
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
            'name.required' => 'وارد کردن نام تخفیف الزامی است.',
            'scope.required' => 'انتخاب نوع تخفیف الزامی است.',
            'scope.in' => 'نوع تخفیف انتخاب‌شده معتبر نیست.',

            'type.required' => 'نوع تخفیف باید مشخص شود.',
            'type.in' => 'نوع تخفیف فقط می‌تواند مبلغ ثابت یا درصدی باشد.',

            'value.required' => 'مقدار تخفیف الزامی است.',
            'value.min' => 'مقدار تخفیف باید حداقل ۱ باشد.',

            'starts_at.after_or_equal' => 'تاریخ شروع نمی‌تواند قبل از امروز باشد.',
            'ends_at.after' => 'تاریخ پایان باید بعد از تاریخ شروع باشد.',
        ];
    }
}
