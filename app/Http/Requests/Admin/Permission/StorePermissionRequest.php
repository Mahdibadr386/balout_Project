<?php

namespace App\Http\Requests\Admin\Permission;

use Illuminate\Foundation\Http\FormRequest;

class StorePermissionRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->hasRole('super_admin');
    }

    public function rules()
    {
        return [
            'name' => 'required|string|unique:permissions,name',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'لطفاً نام مجوز را وارد کنید.',
            'name.string'   => 'نام مجوز باید یک متن معتبر باشد.',
            'name.unique'   => 'این نام مجوز قبلاً استفاده شده است.',
        ];
    }

}
