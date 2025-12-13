<?php

namespace App\Http\Requests\Admin\Option;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOptionDetailRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'option_id' => 'required|integer|exists:options,id',
            'name'      => 'required|string|max:255',
            'price'     => 'required|numeric|min:0|max:1000000000.00',
        ];
    }

    public function messages()
    {
        return [
            'option_id.required' => 'شناسه گزینه الزامی است.',
            'option_id.integer'  => 'شناسه گزینه باید عدد صحیح باشد.',
            'option_id.exists'   => 'گزینه انتخاب شده معتبر نیست.',

            'name.required' => 'نام جزئیات الزامی است.',
            'name.string'   => 'نام جزئیات باید به صورت متن باشد.',
            'name.max'      => 'نام جزئیات نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',

            'price.required' => 'قیمت الزامی است.',
            'price.numeric'  => 'قیمت باید عدد باشد.',
            'price.min'      => 'قیمت نمی‌تواند منفی باشد.',
            'price.max'      => 'قیمت نمی‌تواند بیشتر از ۱٬۰۰۰٬۰۰۰٬۰۰۰ باشد.',
        ];
    }
}
