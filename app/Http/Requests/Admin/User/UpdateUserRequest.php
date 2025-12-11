<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->hasRole('super_admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name'     => 'nullable|string|min:2|max:255',
            'last_name'      => 'nullable|string|min:2|max:255',
            'name_en'        => 'nullable', 'string', 'regex:/^[A-Za-z\s\-]+$/', 'max:255',
            'tel'            => 'required|string|unique:users,tel|regex:/^[0-9]{10,15}$/',
        ];
    }

    public function messages()
    {
        return [
            'first_name.string' => 'نام باید از نوع رشته باشد.',
            'first_name.max' => 'نام نباید بیش از ۲۵۵ کاراکتر باشد.',

            'last_name.string' => 'نام خانوادگی باید از نوع رشته باشد.',
            'last_name.max' => 'نام خانوادگی نباید بیش از ۲۵۵ کاراکتر باشد.',

            'name_en.string' => 'نام انگلیسی باید از نوع رشته باشد.',
            'name_en.max' => 'نام انگلیسی نباید بیش از ۲۵۵ کاراکتر باشد.',

            'tel.required' => 'شماره تلفن الزامی است.',
            'tel.string' => 'شماره تلفن باید از نوع رشته باشد.',
            'tel.max' => 'شماره تلفن نباید بیش از ۲۵۵ کاراکتر باشد.',
            'tel.unique' => 'این شماره تلفن قبلاً ثبت شده است.',
            'tel.regex' => 'این شماره تلفن معتبر نمی باشد',

        ];
    }
}
