<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class CheckUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tel' => [
                'required',
                'string',
                'regex:/^09[0-9]{9}$/',
            ]
        ];
    }

    public function messages()
    {
        return [
            'tel.required' => 'شماره موبایل الزامی است.',
            'tel.string'   => 'شماره موبایل باید به صورت متن باشد.',
            'tel.regex'    => 'فرمت شماره موبایل صحیح نیست. شماره باید با ۰۹ شروع شود و دقیقاً ۱۱ رقم باشد.',
        ];
    }
}
