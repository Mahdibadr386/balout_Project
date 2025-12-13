<?php

namespace App\Http\Requests\Public\Feedback;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFeedbackRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Here, you can check if the user is logged in or has permissions to leave feedback.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'product_id' => [
                'required',
                'integer',
                'exists:products,id',
            ],
            'comment' => [
                'required',
                'string',
                'min:5',
                'max:1000',
            ],
            'rate' => [
                'required',
                'integer',
                'between:1,5',
            ],

        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'product_id.required' => 'شناسه محصول الزامی است.',
            'product_id.integer'  => 'شناسه محصول باید عدد صحیح باشد.',
            'product_id.exists'   => 'محصول انتخاب شده معتبر نیست.',

            'comment.required' => 'متن نظر الزامی است.',
            'comment.string'   => 'متن نظر باید به صورت متن باشد.',
            'comment.min'      => 'متن نظر باید حداقل ۵ کاراکتر باشد.',
            'comment.max'      => 'متن نظر نمی‌تواند بیشتر از ۱۰۰۰ کاراکتر باشد.',

            'rate.required'    => 'امتیاز الزامی است.',
            'rate.integer'     => 'امتیاز باید عدد صحیح باشد.',
            'rate.between'     => 'امتیاز باید بین ۱ تا ۵ باشد.',
        ];
    }

}
