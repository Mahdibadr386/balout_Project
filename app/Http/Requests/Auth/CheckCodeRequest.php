<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class CheckCodeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tel' => [
                'required',
                'string',
                'regex:/^09[0-9]{9}$/',
            ],
            'code' => [
                'required',
                'string',
                'size:6',
                'regex:/^[0-9]{6}$/', // Exactly 6 digits
            ],
        ];
    }

    public function messages()
    {
        return [
            'tel.required' => 'شماره موبایل الزامی است.',
            'tel.string'   => 'شماره موبایل باید به صورت متن باشد.',
            'tel.regex'    => 'فرمت شماره موبایل صحیح نیست. شماره باید با ۰۹ شروع شود و دقیقاً ۱۱ رقم باشد.',

            'code.required' => 'کد تأیید الزامی است.',
            'code.string'   => 'کد تأیید باید به صورت متن باشد.',
            'code.size'     => 'کد تأیید باید دقیقاً ۶ کاراکتر باشد.',
            'code.regex'    => 'کد تأیید باید دقیقاً شامل ۶ رقم باشد.',
        ];
    }

    public function attributes()
    {
        return [
            'tel' => 'شماره تلفن',
            'code' => 'کد تأیید',
        ];
    }
}
