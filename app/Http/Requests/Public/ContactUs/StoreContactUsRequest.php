<?php

namespace App\Http\Requests\Public\ContactUs;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactUsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => [
                'required',
                'string',
                'min:2',
                'max:200',
                'regex:/^[a-zA-Zآ-یءئ\s]+$/u',
            ],
            'last_name' => [
                'required',
                'string',
                'min:2',
                'max:200',
                'regex:/^[a-zA-Zآ-یءئ\s]+$/u',
            ],
            'tel' => [
                'required',
                'string',
                'regex:/^09\d{9}$/',
            ],
            'subject' => [
                'required',
                'string',
                'min:3',
                'max:200',
                'not_regex:/https?:\/\//i',
            ],
            'message' => [
                'required',
                'string',
                'min:10',
                'max:2000',
                'not_regex:/https?:\/\//i',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'نام الزامی است.',
            'first_name.regex' => 'نام فقط می‌تواند شامل حروف فارسی یا انگلیسی باشد.',
            'last_name.required' => 'نام خانوادگی الزامی است.',
            'last_name.regex' => 'نام خانوادگی فقط می‌تواند شامل حروف فارسی یا انگلیسی باشد.',
            'tel.required' => 'شماره تلفن الزامی است.',
            'tel.regex' => 'فرمت شماره تلفن معتبر نیست.',
            'subject.required' => 'موضوع پیام الزامی است.',
            'subject.not_regex' => 'موضوع نباید شامل لینک یا تبلیغ باشد.',
            'message.required' => 'متن پیام الزامی است.',
            'message.min' => 'متن پیام کوتاه است',
            'message.max' => 'متن پیام باید زیر 2000 حرف باشد',
            'message.not_regex' => 'متن پیام نباید شامل لینک یا تبلیغ باشد.',
        ];
    }


}
