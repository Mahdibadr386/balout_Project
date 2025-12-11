<?php

namespace App\Http\Requests\Admin\Option;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'type' => ['sometimes', 'nullable', 'in:two_option,multiple_option'],
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'effect' => ['sometimes', 'nullable', 'numeric'],
        ];

    }

    public function messages()
    {
        return [

            'category_id.required' => 'انتخاب دسته بندی الزامی است.',
            'category_id.integer'  => 'شناسه دسته بندی معتبر نیست.',
            'category_id.exists'   => 'دسته بندی انتخاب‌شده در سیستم ثبت نشده است.',

            'type.in' => 'نوع گزینه فقط می‌تواند two_option یا multiple_option باشد.',

            'name.required' => 'عنوان گزینه نمی‌تواند خالی باشد.',
            'name.string'   => 'عنوان گزینه باید متن باشد.',
            'name.max'      => 'طول عنوان گزینه نباید بیشتر از ۲۵۵ کاراکتر باشد.',

            'effect.numeric' => 'مقدار اثر باید یک عدد معتبر باشد.',
        ];
    }

}
