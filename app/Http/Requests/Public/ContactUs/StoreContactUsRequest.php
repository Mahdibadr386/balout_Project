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
            'first_name.string'   => 'نام باید به صورت متن باشد.',
            'first_name.min'      => 'نام باید حداقل ۲ کاراکتر باشد.',
            'first_name.max'      => 'نام نمی‌تواند بیشتر از ۲۰۰ کاراکتر باشد.',
            'first_name.regex'    => 'نام فقط می‌تواند شامل حروف فارسی، حروف لاتین و فضای خالی باشد.',

            'last_name.required' => 'نام خانوادگی الزامی است.',
            'last_name.string'   => 'نام خانوادگی باید به صورت متن باشد.',
            'last_name.min'      => 'نام خانوادگی باید حداقل ۲ کاراکتر باشد.',
            'last_name.max'      => 'نام خانوادگی نمی‌تواند بیشتر از ۲۰۰ کاراکتر باشد.',
            'last_name.regex'    => 'نام خانوادگی فقط می‌تواند شامل حروف فارسی، حروف لاتین و فضای خالی باشد.',

            'tel.required' => 'شماره موبایل الزامی است.',
            'tel.string'   => 'شماره موبایل باید به صورت متن باشد.',
            'tel.regex'    => 'فرمت شماره موبایل صحیح نیست. شماره باید با ۰۹ شروع شود و دقیقاً ۱۱ رقم باشد.',

            'subject.required'   => 'موضوع الزامی است.',
            'subject.string'     => 'موضوع باید به صورت متن باشد.',
            'subject.min'        => 'موضوع باید حداقل ۳ کاراکتر باشد.',
            'subject.max'        => 'موضوع نمی‌تواند بیشتر از ۲۰۰ کاراکتر باشد.',
            'subject.not_regex'  => 'موضوع نمی‌تواند شامل لینک باشد.',

            'message.required'   => 'پیام الزامی است.',
            'message.string'     => 'پیام باید به صورت متن باشد.',
            'message.min'        => 'پیام باید حداقل ۱۰ کاراکتر باشد.',
            'message.max'        => 'پیام نمی‌تواند بیشتر از ۲۰۰۰ کاراکتر باشد.',
            'message.not_regex'  => 'پیام نمی‌تواند شامل لینک باشد.',
        ];
    }


}
