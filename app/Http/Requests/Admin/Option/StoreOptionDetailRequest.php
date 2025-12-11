<?php

namespace App\Http\Requests\Admin\Option;

use Illuminate\Foundation\Http\FormRequest;

class StoreOptionDetailRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'option_id' => 'required|integer|exists:options,id',
            'details'   => 'required|array|min:1',
            'details.*.name'  => 'required|string|max:255',
            'details.*.price' => 'required|numeric|min:0|max:9999999999.99',
        ];
    }

    public function messages()
    {
        return [
            'option_id.required' => 'شناسه گزینه اصلی الزامی است.',
            'option_id.integer'  => 'شناسه گزینه اصلی باید عدد باشد.',
            'option_id.exists'   => 'گزینه انتخاب‌شده معتبر نیست.',

            'details.required'  => 'حداقل یک جزئیات باید ارسال شود.',
            'details.array'     => 'جزئیات باید به صورت آرایه ارسال شوند.',
            'details.min'       => 'حداقل یک جزئیات لازم است.',

            'details.*.name.required' => 'نام جزئیات گزینه الزامی است.',
            'details.*.name.string'   => 'نام باید به صورت رشته باشد.',
            'details.*.name.max'      => 'نام نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',

            'details.*.price.required' => 'قیمت الزامی است.',
            'details.*.price.numeric'  => 'قیمت باید عدد باشد.',
            'details.*.price.min'      => 'قیمت نمی‌تواند کمتر از صفر باشد.',
            'details.*.price.max'      => 'قیمت بیش از حد بزرگ است.',
        ];
    }
}
