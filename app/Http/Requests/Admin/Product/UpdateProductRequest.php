<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');
        return [
            'name' => 'sometimes|string|max:255',
            'slug' => ['sometimes','string','max:255', Rule::unique('products','slug')->ignore($id)],
            'description' => 'nullable|string',
            'price_base' => 'sometimes|numeric|min:0',
            'discount_percentage' => 'nullable|integer|min:0|max:100',
            'unit' => 'nullable|string|max:50',
            'quantity' => 'nullable|integer|min:0',
            'minimum' => 'nullable|integer|min:0',
            'maximum' => 'nullable|integer|min:0',
            'preparation_time' => 'nullable|integer|min:0',
            'available' => 'nullable|boolean',
            'rate' => 'nullable|numeric|min:0|max:5',
            'batch_code' => 'nullable|string|max:100',
            'matin_code' => 'nullable|string|max:100',
            'category_id' => 'nullable|exists:categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'نام محصول باید متنی باشد.',
            'name.max' => 'نام محصول نباید بیش از ۲۵۵ کاراکتر باشد.',
            'slug.unique' => 'این اسلاگ قبلاً ثبت شده است.',
            'price_base.numeric' => 'قیمت محصول باید عددی باشد.',
            'discount_percentage.integer' => 'درصد تخفیف باید عدد صحیح باشد.',
            'discount_percentage.max' => 'درصد تخفیف نمی‌تواند بیش از ۱۰۰ باشد.',
            'category_id.exists' => 'دسته‌بندی انتخاب‌شده معتبر نیست.',
        ];
    }
}
