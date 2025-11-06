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
                'unique:users',
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
            'tel.required' => 'شماره تلفن الزامی است',
            'tel.string' => 'شماره تلفن باید متن باشد',
            'tel.regex' => 'فرمت شماره تلفن صحیح نمی‌باشد',
            'tel.unique' => 'این شماره تلفن قبلاً ثبت شده است',
            'tel.exists' => 'حساب کاربری با این شماره یافت نشد یا غیرفعال است',
            'first_name.required' => 'نام الزامی است',
            'first_name.string' => 'نام باید متن باشد',
            'first_name.max' => 'نام نباید بیش از 255 کاراکتر باشد',
            'first_name.regex' => 'نام فقط می‌تواند شامل حروف فارسی باشد',
            'last_name.required' => 'نام خانوادگی الزامی است',
            'last_name.string' => 'نام خانوادگی باید متن باشد',
            'last_name.max' => 'نام خانوادگی نباید بیش از 255 کاراکتر باشد',
            'last_name.regex' => 'نام خانوادگی فقط می‌تواند شامل حروف فارسی باشد',
        ];
    }
}
