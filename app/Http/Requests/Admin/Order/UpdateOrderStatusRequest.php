<?php

namespace App\Http\Requests\Admin\Order;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'status' => 'required|in:pending,paid,failed,cancelled,refunded,processing,shipped,delivered'
        ];
    }

    public function messages()
    {
        return [
            'status.required' => 'وضعیت سفارش الزامی است.',
            'status.in'       => 'وضعیت انتخاب‌شده معتبر نیست.',
        ];
    }

}
