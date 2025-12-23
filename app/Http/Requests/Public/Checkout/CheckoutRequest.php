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
            'branch_id' => ['required_without:address_id', 'exists:branches,id',],
            'address_id' => ['required_without:branch_id', 'exists:user_addresses,id', new AddressBelongsToUser($userId)],
            'send_date' => ['required', 'string'],
            'send_hour' => ['required' , 'integer' , 'exists:times,id'],
            'payment_method' => ['required', 'string'],
            'shipping_method' => ['nullable', 'string'],
            'idempotency_key' => ['nullable', 'string', 'max:128'],
            'discount_code' => ['nullable', 'string', 'max:64'],

        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $branch = $this->input('branch_id');
            $address = $this->input('address_id');


            if ($branch && $address) {
                $validator->errors()->add(
                    'branch_id',
                    'امکان ارسال همزمان شعبه و آدرس وجود ندارد.'
                );
            }

            if (!$branch && !$address) {
                $validator->errors()->add(
                    'branch_id',
                    'وارد کردن یکی از مقادیر شعبه یا آدرس الزامی است.'
                );
            }
        });
    }
    public function messages(): array
    {
        return [
            'branch_id.required_without' => 'وارد کردن یکی از مقادیر شعبه یا آدرس الزامی است.',
            'branch_id.exists' => 'شبعه مورد نظر وجود ندارد',

            'address_id.required_without' => 'وارد کردن یکی از مقادیر شعبه یا آدرس الزامی است.',
            'address_id.required' => 'شناسه آدرس الزامی است.',
            'address_id.exists'   => 'آدرس انتخاب شده معتبر نیست.',

            'send_date.required' => 'تاریخ ارسال را وارد کنید',
            'send_date.string' => 'تاریخ ارسال باید متن یاشد',

            'send_hour.required' => 'ساعت ارسال را وارد کنید',
            'send_hour.integer' => 'ساعت ارسال باید عدد باشد',
            'send_hour.exists' => 'ساعت ارسال معتبر نیست',

            'payment_method.required' => 'روش پرداخت الزامی است.',
            'payment_method.string'   => 'روش پرداخت باید به صورت متن باشد.',

            'shipping_method.nullable' => 'روش ارسال می‌تواند خالی باشد.',
            'shipping_method.string'   => 'روش ارسال باید به صورت متن باشد.',

            'idempotency_key.nullable' => 'کلید یکتایی می‌تواند خالی باشد.',
            'idempotency_key.string'   => 'کلید یکتایی باید به صورت متن باشد.',
            'idempotency_key.max'      => 'کلید یکتایی نمی‌تواند بیشتر از ۱۲۸ کاراکتر باشد.',

            'discount_code.string' => 'کد تخفیف باید به صورت متن باشد.',
            'discount_code.max' => 'کد تخفیف نمی‌تواند بیشتر از ۶۴ کاراکتر باشد.',
            'discount_code.nullable' => 'کد تخفیف می‌تواند خالی باشد.',
        ];
    }
}
