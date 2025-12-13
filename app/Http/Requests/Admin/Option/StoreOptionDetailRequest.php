<?php

namespace App\Http\Requests\Admin\Option;

use Illuminate\Foundation\Http\FormRequest;

class StoreOptionDetailRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'option_id' => 'required|integer|exists:options,id',
            'details'   => 'required|array|min:1',
            'details.*.name'  => 'required|string|max:255',
            'details.*.price' => 'required|numeric|min:0|max:1000000000.00',
        ];
    }

    public function messages()
    {
        return [
            'option_id.required' => 'شناسه گزینه الزامی است.',
            'option_id.integer'  => 'شناسه گزینه باید عدد صحیح باشد.',
            'option_id.exists'   => 'گزینه انتخاب شده معتبر نیست.',

            'details.required' => 'جزئیات گزینه الزامی است.',
            'details.array'    => 'جزئیات گزینه باید به صورت آرایه باشد.',
            'details.min'      => 'حداقل یک جزئیات گزینه باید وارد شود.',

            'details.*.name.required' => 'نام جزئیات الزامی است.',
            'details.*.name.string'   => 'نام جزئیات باید به صورت متن باشد.',
            'details.*.name.max'      => 'نام جزئیات نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',

            'details.*.price.required' => 'قیمت جزئیات الزامی است.',
            'details.*.price.numeric'  => 'قیمت جزئیات باید عدد باشد.',
            'details.*.price.min'      => 'قیمت جزئیات نمی‌تواند منفی باشد.',
            'details.*.price.max'      => 'قیمت جزئیات نمی‌تواند بیشتر از ۱٬۰۰۰٬۰۰۰٬۰۰۰ باشد.',
        ];
    }
}
