<?php

namespace App\Http\Requests\Admin\Role;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->hasRole('super_admin');
    }

    public function rules()
    {
        return [
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required'      => 'لطفاً نام نقش را وارد کنید.',
            'name.string'        => 'نام نقش باید یک متن معتبر باشد.',
            'name.unique'        => 'این نام نقش قبلاً استفاده شده است.',
            'permissions.array'  => 'فرمت مجوزها نامعتبر است.',
            'permissions.*.exists'=> 'مجوز انتخاب‌شده معتبر نیست یا وجود ندارد.',
        ];
    }

}
