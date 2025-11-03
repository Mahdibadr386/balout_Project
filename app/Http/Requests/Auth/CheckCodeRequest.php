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
            'tel.required' => 'شماره تلفن الزامی است',
            'tel.string' => 'شماره تلفن باید متن باشد',
            'tel.regex' => 'فرمت شماره تلفن صحیح نمی‌باشد',
            'code.required' => 'کد تأیید الزامی است',
            'code.string' => 'کد تأیید باید متن باشد',
            'code.size' => 'کد تأیید باید 6 رقم باشد',
            'code.regex' => 'کد تأیید فقط می‌تواند شامل عدد باشد',
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
