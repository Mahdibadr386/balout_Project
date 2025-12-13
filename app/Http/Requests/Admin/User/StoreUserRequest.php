<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name'     => 'required|string|min:2|max:255',
            'last_name'      => 'required|string|min:2|max:255',
            'name_en'        => 'required', 'string', 'regex:/^[A-Za-z\s\-]+$/', 'max:255',
            'tel'            => 'required|string|unique:users,tel|regex:/^[0-9]{10,15}$/',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'نام الزامی است.',
            'first_name.string'   => 'نام باید به صورت متن باشد.',
            'first_name.min'      => 'نام باید حداقل ۲ کاراکتر باشد.',
            'first_name.max'      => 'نام نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',

            'last_name.required' => 'نام خانوادگی الزامی است.',
            'last_name.string'   => 'نام خانوادگی باید به صورت متن باشد.',
            'last_name.min'      => 'نام خانوادگی باید حداقل ۲ کاراکتر باشد.',
            'last_name.max'      => 'نام خانوادگی نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',

            'name_en.required' => 'نام لاتین الزامی است.',
            'name_en.string'   => 'نام لاتین باید به صورت متن باشد.',
            'name_en.regex'    => 'نام لاتین فقط می‌تواند شامل حروف انگلیسی، فضای خالی و خط تیره باشد.',
            'name_en.max'      => 'نام لاتین نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',

            'tel.required' => 'شماره موبایل الزامی است.',
            'tel.string'   => 'شماره موبایل باید به صورت متن باشد.',
            'tel.unique'   => 'این شماره موبایل قبلاً ثبت شده است.',
            'tel.regex'    => 'فرمت شماره موبایل صحیح نیست. شماره باید بین ۱۰ تا ۱۵ رقم باشد.',
        ];
    }

}
