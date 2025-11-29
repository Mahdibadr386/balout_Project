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
            'optionable_id' => 'required|integer',
            'optionable_type' => 'required|string|max:255',
            'type' => 'nullable|in:two_option,multiple_option',
            'name' => 'required|string|max:255',
            'effect' => 'nullable|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'optionable_id.required' => 'شناسه موردنظر الزامی است.',
            'optionable_id.integer' => 'شناسه باید عدد صحیح باشد.',
            'optionable_type.required' => 'نوع موجودیت الزامی است.',
            'optionable_type.max' => 'نوع موجودیت نمی‌تواند بیش از ۲۵۵ کاراکتر باشد.',
            'type.in' => 'نوع گزینه معتبر نیست.',
            'name.required' => 'نام گزینه الزامی است.',
            'name.max' => 'نام گزینه نباید بیش از ۲۵۵ کاراکتر باشد.',
            'effect.numeric' => 'مقدار اثر باید عددی باشد.',
        ];
    }
}
