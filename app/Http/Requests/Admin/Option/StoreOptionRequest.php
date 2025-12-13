<?php

namespace App\Http\Requests\Admin\Option;

use Illuminate\Foundation\Http\FormRequest;

class StoreOptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'type' => ['nullable', 'in:two_option,multiple_option'],
            'name' => ['required', 'string', 'max:255'],
            'effect' => ['nullable', 'numeric'],
        ];

    }

    public function messages()
    {
        return [
            'category_id.required' => 'شناسه دسته‌بندی الزامی است.',
            'category_id.integer'  => 'شناسه دسته‌بندی باید عدد صحیح باشد.',
            'category_id.exists'   => 'دسته‌بندی انتخاب شده معتبر نیست.',

            'type.nullable' => 'نوع گزینه می‌تواند خالی باشد.',
            'type.in'       => 'نوع گزینه انتخاب شده معتبر نیست. فقط two_option یا multiple_option مجاز است.',

            'name.required' => 'نام گزینه الزامی است.',
            'name.string'   => 'نام گزینه باید به صورت متن باشد.',
            'name.max'      => 'نام گزینه نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',

            'effect.nullable' => 'تأثیر قیمت می‌تواند خالی باشد.',
            'effect.numeric'  => 'تأثیر قیمت باید عدد باشد.',
        ];
    }

}
