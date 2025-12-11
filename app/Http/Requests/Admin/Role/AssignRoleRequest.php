<?php

namespace App\Http\Requests\Admin\Role;

use Illuminate\Foundation\Http\FormRequest;

class AssignRoleRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->hasRole('super_admin');
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
            'users.required'   => 'لطفاً حداقل یک کاربر را انتخاب کنید.',
            'users.array'      => 'فرمت اطلاعات کاربران نامعتبر است.',
            'users.min'        => 'حداقل یک کاربر باید انتخاب شود.',
            'users.*.exists'   => 'کاربر انتخاب‌شده معتبر نیست یا وجود ندارد.',
        ];
    }

}
