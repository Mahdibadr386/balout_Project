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
        return auth()->check();
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
            'product_id.integer' => 'شناسه محصول باید عدد باشد.',
            'product_id.exists' => 'محصول انتخاب شده وجود ندارد.',
            'user_id.required' => 'شناسه کاربر الزامی است.',
            'user_id.integer' => 'شناسه کاربر باید عدد باشد.',
            'user_id.exists' => 'کاربر انتخاب شده وجود ندارد.',
            'comment.required' => 'متن نظر الزامی است.',
            'comment.string' => 'متن نظر باید رشته باشد.',
            'comment.min' => 'متن نظر باید حداقل :min کاراکتر باشد.',
            'comment.max' => 'متن نظر نمی‌تواند بیشتر از :max کاراکتر باشد.',
            'rate.required' => 'امتیاز محصول الزامی است.',
            'rate.integer' => 'امتیاز باید عدد باشد.',
            'rate.between' => 'امتیاز باید بین :min تا :max باشد.',
        ];
    }

}
