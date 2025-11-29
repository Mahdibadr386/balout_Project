<?php

namespace App\Http\Requests\Admin\Option;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'optionable_id' => 'sometimes|integer',
            'optionable_type' => 'sometimes|string|max:255',
            'type' => 'nullable|in:two_option,multiple_option',
            'name' => 'sometimes|string|max:255',
            'effect' => 'nullable|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'optionable_id.integer' => 'شناسه باید عدد صحیح باشد.',
            'optionable_type.max' => 'نوع موجودیت نمی‌تواند بیش از ۲۵۵ کاراکتر باشد.',
            'type.in' => 'نوع گزینه معتبر نیست.',
            'name.max' => 'نام گزینه نباید بیش از ۲۵۵ کاراکتر باشد.',
            'effect.numeric' => 'مقدار اثر باید عددی باشد.',
        ];
    }
}
