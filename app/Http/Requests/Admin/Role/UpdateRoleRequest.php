<?php

namespace App\Http\Requests\Admin\Role;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $roleId = $this->route('role') ? $this->route('role')->id : null;
        return [
            'name' => 'required|string|unique:roles,name,' . $roleId,
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'نام نقش الزامی است.',
            'name.string'   => 'نام نقش باید به صورت متن باشد.',
            'name.unique'   => 'این نام نقش قبلاً استفاده شده است.',

            'permissions.nullable' => 'مجوزها می‌توانند خالی باشند.',
            'permissions.array'    => 'مجوزها باید به صورت آرایه باشند.',

            'permissions.*.exists' => 'یکی از مجوزهای انتخاب شده معتبر نیست.',
        ];
    }

}
