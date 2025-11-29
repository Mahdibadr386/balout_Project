<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'description' => 'nullable|string',
            'price_base' => 'required|numeric|min:0',
            'discount_percentage' => 'nullable|integer|min:0|max:100',
            'unit' => 'required|string|max:50',
            'quantity' => 'required|integer|min:0',
            'minimum' => 'required|integer|min:0',
            'maximum' => 'required|integer|min:0',
            'preparation_time' => 'required|integer|min:0',
            'available' => 'required|boolean',
            'rate' => 'nullable|numeric|min:0|max:5',
            'batch_code' => 'nullable|string|max:100',
            'matin_code' => 'nullable|string|max:100',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'نام محصول الزامی است.',
            'name.string' => 'نام محصول باید متنی باشد.',
            'name.max' => 'نام محصول نباید بیش از ۲۵۵ کاراکتر باشد.',
            'slug.required' => 'اسلاگ محصول الزامی است.',
            'slug.unique' => 'این اسلاگ قبلاً ثبت شده است.',
            'price_base.required' => 'قیمت محصول الزامی است.',
            'price_base.numeric' => 'قیمت محصول باید عددی باشد.',
            'discount_percentage.integer' => 'درصد تخفیف باید عدد صحیح باشد.',
            'discount_percentage.max' => 'درصد تخفیف نمی‌تواند بیش از ۱۰۰ باشد.',
            'category_id.exists' => 'دسته‌بندی انتخاب‌شده معتبر نیست.',
        ];
    }
}
