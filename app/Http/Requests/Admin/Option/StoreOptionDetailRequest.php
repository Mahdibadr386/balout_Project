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
            'name'      => 'required|string|max:255',
            'price'     => 'required|numeric|min:0|max:9999999999.99',
        ];
    }

    public function messages()
    {
        return [
            'option_id.required' => 'شناسه گزینه اصلی الزامی است.',
            'option_id.integer'  => 'شناسه گزینه اصلی باید عدد باشد.',
            'option_id.exists'   => 'گزینه انتخاب‌شده معتبر نیست.',

            'name.required' => 'نام جزئیات گزینه الزامی است.',
            'name.string'   => 'نام باید به صورت رشته باشد.',
            'name.max'      => 'نام نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',

            'price.required' => 'قیمت الزامی است.',
            'price.numeric'  => 'قیمت باید عدد باشد.',
            'price.min'      => 'قیمت نمی‌تواند کمتر از صفر باشد.',
            'price.max'      => 'قیمت بیش از حد بزرگ است.',
        ];
    }
}
