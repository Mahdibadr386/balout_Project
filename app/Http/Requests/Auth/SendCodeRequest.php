<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SendCodeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'tel' => [
                'required',
                'string',
                'regex:/^09[0-9]{9}$/',

            ],
        ];

        $user = User::where('tel', $this->tel)->first();
        $isNewUser = !$user || $user->status != 1;

        if ($isNewUser) {
            $rules['first_name'] = [
                'required',
                'string',
                'max:255',
                'regex:/^[\p{Arabic}\p{L}\s]+$/u',
            ];
            $rules['last_name'] = [
                'required',
                'string',
                'max:255',
                'regex:/^[\p{Arabic}\p{L}\s]+$/u',
            ];

            $rules['tel'][] = Rule::unique('users', 'tel')->where(function ($query) {
                return $query->where('status', 1);
            });
        } else {
            $rules['tel'][] = Rule::exists('users', 'tel')->where(function ($query) {
                return $query->where('status', 1)->where('is_active', 1);
            });
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'tel.required' => 'شماره موبایل الزامی است.',
            'tel.string'   => 'شماره موبایل باید به صورت متن باشد.',
            'tel.regex'    => 'فرمت شماره موبایل صحیح نیست. شماره باید با ۰۹ شروع شود و دقیقاً ۱۱ رقم باشد.',
            'tel.unique'   => 'این شماره موبایل قبلاً ثبت شده است.',
            'tel.exists'   => 'شماره موبایل وارد شده یافت نشد یا حساب شما فعال نیست.',

            'first_name.required' => 'نام الزامی است.',
            'first_name.string'   => 'نام باید به صورت متن باشد.',
            'first_name.max'      => 'نام نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
            'first_name.regex'    => 'نام فقط می‌تواند شامل حروف فارسی، حروف لاتین و فضای خالی باشد.',

            'last_name.required' => 'نام خانوادگی الزامی است.',
            'last_name.string'   => 'نام خانوادگی باید به صورت متن باشد.',
            'last_name.max'      => 'نام خانوادگی نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
            'last_name.regex'    => 'نام خانوادگی فقط می‌تواند شامل حروف فارسی، حروف لاتین و فضای خالی باشد.',
        ];
    }
}
