<?php
namespace App\Http\Requests\Public\Checkout;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'address_id' => ['required', 'exists:user_addresses,id'],
            'payment_method' => ['required', 'string'],
            'shipping_method' => ['nullable', 'string'],
            'idempotency_key' => ['nullable', 'string', 'max:128'],
        ];
    }

    public function messages(): array
    {
        return [
            'address_id.required' => 'لطفاً آدرس ارسال سفارش را انتخاب کنید.',
            'address_id.exists'   => 'آدرس انتخاب‌شده معتبر نیست یا در حساب شما وجود ندارد.',

            'payment_method.required' => 'روش پرداخت الزامی است.',
            'payment_method.string'   => 'نوع پرداخت باید به‌صورت رشته‌ای ارسال شود.',

            'shipping_method.string'  => 'روش ارسال باید به‌صورت رشته‌ای باشد.',

            'idempotency_key.string'  => 'کلید یکتا باید به‌صورت رشته‌ای ارسال شود.',
            'idempotency_key.max'     => 'کلید یکتا نمی‌تواند بیش از ۱۲۸ کاراکتر باشد.',
        ];
    }
}
