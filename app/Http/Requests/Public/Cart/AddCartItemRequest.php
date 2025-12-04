<?php
namespace App\Http\Requests\Public\Cart;

use App\Rules\Option\OptionBelongsToProduct;
use App\Rules\Option\OptionDetailBelongsToOption;
use Illuminate\Foundation\Http\FormRequest;

class AddCartItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity'   => ['nullable', 'integer', 'min:1'],

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
                new OptionBelongsToProduct($this->input('product_id')),
            ],

            'messages.*.message' => ['required_with:messages', 'string', 'max:255'],
        ];

    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'شناسه محصول ضروری است.',
            'product_id.exists' => 'محصول مورد نظر یافت نشد.',
            'quantity.integer' => 'تعداد باید عدد صحیح باشد.',
            'quantity.min' => 'تعداد باید حداقل ۱ باشد.',
            'options.array' => 'گزینه‌ها باید به صورت آرایه ارسال شوند.',
            'options.*.option_id.required_with' => 'شناسه گزینه لازم است.',
            'options.*.option_detail_id.required_with' => 'شناسه مقدار گزینه لازم است.',
            'options.*.option_id.exists' => 'گزینهٔ ارسالی معتبر نیست.',
            'options.*.option_detail_id.exists' => 'مقدار گزینهٔ ارسالی معتبر نیست.',
            'messages.array' => 'پیام‌ها باید به صورت آرایه ارسال شوند.',
            'messages.*.option_id.required_with' => 'شناسه گزینه پیام لازم است.',
            'messages.*.message.required_with' => 'متن پیام لازم است.',
            'messages.*.option_id.exists' => 'گزینهٔ پیام معتبر نیست.',
        ];
    }
}
