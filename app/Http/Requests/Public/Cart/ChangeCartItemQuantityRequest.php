<?php
namespace App\Http\Requests\Public\Cart;

use Illuminate\Foundation\Http\FormRequest;

class ChangeCartItemQuantityRequest extends FormRequest
{
    public function authorize() { return auth()->check(); }

    public function rules(): array
    {
        return [
            'by' => ['nullable','integer','min:1','max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'by.integer' => 'مقدار تغییر باید عدد صحیح باشد.',
            'by.min' => 'حداقل مقدار تغییر ۱ است.',
            'by.max' => 'مقدار تغییر خیلی بزرگ است.',
        ];
    }
}
