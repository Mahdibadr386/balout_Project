<?php

namespace App\Http\Requests\Admin\Order;

use App\Rules\Option\OptionBelongsToProduct;
use App\Rules\Option\OptionDetailBelongsToOption;
use App\Rules\User\AddressBelongsToUser;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->hasRole('super_admin');
    }

    public function rules(): array
    {
        return [
            'user_id'      => 'required|exists:users,id',
            'address_id'   => ['required','exists:user_addresses,id' ,  new AddressBelongsToUser($this->input('user_id'))],
            'product_id'   => 'required|integer|exists:products,id',
            'quantity'     => 'nullable|integer|min:1',
            'payment_method' => 'required|string',
            'shipping_method' => 'nullable|string',
            'idempotency_key' => 'nullable|string|max:128',

            'options' => ['nullable', 'array'],

            'options.*.option_id' => [
                'required_with:options',
                'integer',
                'exists:options,id',
                new OptionBelongsToProduct($this->input('product_id')),
            ],

            'options.*.option_detail_id' => [
                'required_with:options',
                'integer',
                'exists:option_details,id',
                new OptionDetailBelongsToOption(),
            ],

            'messages' => ['nullable', 'array'],

            'messages.*.option_id' => [
                'required_with:messages',
                'integer',
                'exists:options,id',
            ],

            'messages.*.message' => ['required_with:messages', 'string', 'max:255'],
        ];

    }

    public function messages()
    {
        return [
            'product_id.required' => 'محصول انتخاب نشده است.',
            'product_id.integer' => 'شناسه محصول معتبر نیست.',
            'product_id.exists' => 'محصول انتخاب‌شده وجود ندارد.',

            'quantity.integer' => 'تعداد باید عدد صحیح باشد.',
            'quantity.min' => 'تعداد نمی‌تواند کمتر از ۱ باشد.',

            'options.array' => 'گزینه‌ها باید به صورت آرایه ارسال شوند.',
            'options.*.option_id.required_with' => 'شناسه گزینه الزامی است.',
            'options.*.option_id.integer' => 'شناسه گزینه باید عدد باشد.',
            'options.*.option_id.exists' => 'گزینه انتخاب‌شده وجود ندارد.',
            'options.*.option_id.option_belongs_to_product' => 'گزینه انتخاب‌شده به این محصول تعلق ندارد.',

            'options.*.option_detail_id.required_with' => 'جزئیات گزینه الزامی است.',
            'options.*.option_detail_id.integer' => 'شناسه جزئیات گزینه باید عدد باشد.',
            'options.*.option_detail_id.exists' => 'جزئیات گزینه انتخاب‌شده وجود ندارد.',
            'options.*.option_detail_id.option_detail_belongs_to_option' => 'جزئیات گزینه به گزینه مربوطه تعلق ندارد.',

            'messages.array' => 'پیام‌ها باید به صورت آرایه ارسال شوند.',
            'messages.*.option_id.required_with' => 'شناسه گزینه برای پیام الزامی است.',
            'messages.*.option_id.integer' => 'شناسه گزینه برای پیام باید عدد باشد.',
            'messages.*.option_id.exists' => 'گزینه انتخاب‌شده برای پیام وجود ندارد.',
            'messages.*.option_id.option_belongs_to_product' => 'گزینه انتخاب‌شده برای پیام به این محصول تعلق ندارد.',

            'messages.*.message.required_with' => 'متن پیام الزامی است.',
            'messages.*.message.string' => 'متن پیام باید رشته باشد.',
            'messages.*.message.max' => 'متن پیام نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
        ];

    }

}
