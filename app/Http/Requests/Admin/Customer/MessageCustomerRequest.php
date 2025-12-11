<?php

namespace App\Http\Requests\Admin\Customer;

use Illuminate\Foundation\Http\FormRequest;

class MessageCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'message' => 'required|string|min:3|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'message.required' => 'متن پیام باید پر شود',
            'message.min' => 'متن پیام باید حداقل 3 حرف باشد',
            'message.string' => 'پیام باید به صورت متن باشد',
            'message.max' => 'متن پیام نمی تواند بیشتر از 500 باشد',
        ];
    }
}
