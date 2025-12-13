<?php
namespace App\Http\Requests\Public\Cart;

use App\Rules\Option\OptionBelongsToProduct;
use App\Rules\Option\OptionDetailBelongsToOption;
use Illuminate\Foundation\Http\FormRequest;

class AddCartItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
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
            ],

            'messages.*.message' => ['required_with:messages', 'string', 'max:255'],
        ];

    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'شناسه محصول الزامی است.',
            'product_id.integer'  => 'شناسه محصول باید عدد صحیح باشد.',
            'product_id.exists'   => 'محصول انتخاب شده معتبر نیست.',

            'quantity.nullable' => 'تعداد می‌تواند خالی باشد.',
            'quantity.integer'  => 'تعداد باید عدد صحیح باشد.',
            'quantity.min'      => 'تعداد باید حداقل ۱ باشد.',

            'options.nullable' => 'گزینه‌ها می‌توانند خالی باشند.',
            'options.array'    => 'گزینه‌ها باید به صورت آرایه باشند.',

            'options.*.option_id.required_with' => 'شناسه گزینه الزامی است.',
            'options.*.option_id.integer'       => 'شناسه گزینه باید عدد صحیح باشد.',
            'options.*.option_id.exists'        => 'گزینه انتخاب شده معتبر نیست.',

            'options.*.option_detail_id.required_with' => 'شناسه جزئیات گزینه الزامی است.',
            'options.*.option_detail_id.integer'       => 'شناسه جزئیات گزینه باید عدد صحیح باشد.',
            'options.*.option_detail_id.exists'        => 'جزئیات گزینه انتخاب شده معتبر نیست.',

            'messages.nullable' => 'پیام‌ها می‌توانند خالی باشند.',
            'messages.array'    => 'پیام‌ها باید به صورت آرایه باشند.',

            'messages.*.option_id.required_with' => 'شناسه گزینه برای پیام الزامی است.',
            'messages.*.option_id.integer'       => 'شناسه گزینه برای پیام باید عدد صحیح باشد.',
            'messages.*.option_id.exists'        => 'گزینه مربوط به پیام معتبر نیست.',

            'messages.*.message.required_with' => 'متن پیام الزامی است.',
            'messages.*.message.string'        => 'متن پیام باید به صورت متن باشد.',
            'messages.*.message.max'           => 'متن پیام نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
        ];
    }
}
