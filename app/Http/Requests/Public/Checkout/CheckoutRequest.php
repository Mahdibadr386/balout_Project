<?php
namespace App\Http\Requests\Public\Checkout;

use App\Rules\User\AddressBelongsToUser;
use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = auth()->id();
        return [
            'address_id' => ['required', 'exists:user_addresses,id' , new AddressBelongsToUser(($userId)),],
            'payment_method' => ['required', 'string'],
            'shipping_method' => ['nullable', 'string'],
            'idempotency_key' => ['nullable', 'string', 'max:128'],
        ];
    }

    public function messages(): array
    {
        return [
            'address_id.required' => 'شناسه آدرس الزامی است.',
            'address_id.exists'   => 'آدرس انتخاب شده معتبر نیست.',

            'payment_method.required' => 'روش پرداخت الزامی است.',
            'payment_method.string'   => 'روش پرداخت باید به صورت متن باشد.',

            'shipping_method.nullable' => 'روش ارسال می‌تواند خالی باشد.',
            'shipping_method.string'   => 'روش ارسال باید به صورت متن باشد.',

            'idempotency_key.nullable' => 'کلید یکتایی می‌تواند خالی باشد.',
            'idempotency_key.string'   => 'کلید یکتایی باید به صورت متن باشد.',
            'idempotency_key.max'      => 'کلید یکتایی نمی‌تواند بیشتر از ۱۲۸ کاراکتر باشد.',
        ];
    }
}
