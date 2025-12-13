<?php

namespace App\Http\Requests\Admin\Role;

use Illuminate\Foundation\Http\FormRequest;

class AssignRoleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'users'   => 'required|array|min:1',
            'users.*' => 'exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'users.required' => 'لیست کاربران الزامی است.',
            'users.array'    => 'لیست کاربران باید به صورت آرایه باشد.',
            'users.min'      => 'حداقل یک کاربر باید انتخاب شود.',

            'users.*.exists' => 'یکی از کاربران انتخاب شده معتبر نیست.',
        ];
    }

}
