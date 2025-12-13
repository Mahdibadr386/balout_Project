<?php
namespace App\Http\Requests\Public\Cart;

use Illuminate\Foundation\Http\FormRequest;

class ChangeCartItemQuantityRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'by' => ['nullable','integer','min:1','max:20'],
        ];
    }

    public function messages(): array
    {
        return [
            'by.nullable' => 'فیلد ترتیب‌بندی می‌تواند خالی باشد.',
            'by.integer'  => 'فیلد ترتیب‌بندی باید عدد صحیح باشد.',
            'by.min'      => 'مقدار ترتیب‌بندی باید حداقل ۱ باشد.',
            'by.max'      => 'مقدار ترتیب‌بندی نمی‌تواند بیشتر از ۲۰ باشد.',
        ];
    }
}
