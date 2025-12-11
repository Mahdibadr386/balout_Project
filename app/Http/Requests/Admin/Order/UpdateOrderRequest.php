<?php

namespace App\Http\Requests\Admin\Order;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->hasRole('super_admin');
    }
    public function rules(): array
    {
        return [
            'user_id'      => 'required|exists:users,id',
            'address_id'   => 'required|exists:user_addresses,id',
            'product_id' => 'required', 'integer', 'exists:products,id',
            'quantity'   => 'nullable', 'integer', 'min:1',
            'payment_method' => 'required', 'string',
            'shipping_method' => 'nullable', 'string',
            'idempotency_key' => 'nullable', 'string', 'max:128',

            'options' => 'nullable', 'array',
            'options.*.option_id'        => 'required_with:options', 'integer', 'exists:options,id',
            'options.*.option_detail_id' => 'required_with:options', 'integer', 'exists:option_details,id',

            'messages' => 'nullable', 'array',
            'messages.*.option_id'  => 'required_with:messages', 'integer', 'exists:options,id',
            'messages.*.message'    => 'required_with:messages', 'string', 'max:255',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'کاربر الزامی است.',
            'user_id.exists' => 'کاربر انتخاب شده معتبر نیست.',

            'address_id.required' => 'آدرس الزامی است.',
            'address_id.exists' => 'آدرس انتخاب شده معتبر نیست.',

            'product_id.required' => 'محصول الزامی است.',
            'product_id.integer' => 'شناسه محصول باید عدد باشد.',
            'product_id.exists' => 'محصول انتخاب شده موجود نیست.',

            'quantity.integer' => 'تعداد باید عدد صحیح باشد.',
            'quantity.min' => 'تعداد باید حداقل ۱ باشد.',

            'payment_method.required' => 'روش پرداخت الزامی است.',
            'payment_method.string' => 'روش پرداخت باید رشته باشد.',

            'shipping_method.string' => 'روش ارسال باید رشته باشد.',

            'idempotency_key.string' => 'کلید ای‌دمپوتنت باید رشته باشد.',
            'idempotency_key.max' => 'کلید ای‌دمپوتنت نمی‌تواند بیشتر از ۱۲۸ کاراکتر باشد.',

            'options.array' => 'گزینه‌ها باید به صورت آرایه ارسال شوند.',
            'options.*.option_id.required_with' => 'شناسه گزینه برای هر گزینه الزامی است.',
            'options.*.option_id.integer' => 'شناسه گزینه باید عدد باشد.',
            'options.*.option_id.exists' => 'گزینه انتخاب شده موجود نیست.',
            'options.*.option_detail_id.required_with' => 'شناسه جزئیات گزینه برای هر گزینه الزامی است.',
            'options.*.option_detail_id.integer' => 'شناسه جزئیات گزینه باید عدد باشد.',
            'options.*.option_detail_id.exists' => 'جزئیات گزینه انتخاب شده موجود نیست.',

            'messages.array' => 'پیام‌ها باید به صورت آرایه ارسال شوند.',
            'messages.*.option_id.required_with' => 'شناسه گزینه برای هر پیام الزامی است.',
            'messages.*.option_id.integer' => 'شناسه گزینه باید عدد باشد.',
            'messages.*.option_id.exists' => 'گزینه انتخاب شده برای پیام موجود نیست.',
            'messages.*.message.required_with' => 'متن پیام برای هر پیام الزامی است.',
            'messages.*.message.string' => 'متن پیام باید رشته باشد.',
            'messages.*.message.max' => 'متن پیام نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
        ];
    }

}
