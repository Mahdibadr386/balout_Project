<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryStoreRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')->where(function ($query) {
                    return $query->where('parent_id', $this->parent_id);
                }),
            ],

            'slug' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                'unique:categories,slug',
            ],

            'parent_id' => [
                'nullable',
                'integer',
                'exists:categories,id',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'is_active' => [
                'required',
                'boolean',
            ],

            'sort_order' => [
                'required',
                'integer',
                'min:0',
                'max:1000000',
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'وارد کردن نام دسته‌بندی الزامی است.',
            'name.string' => 'نام دسته‌بندی باید یک رشته معتبر باشد.',
            'name.max' => 'نام دسته‌بندی نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
            'name.unique' => 'یک دسته‌بندی با همین نام در این سطح وجود دارد.',

            'slug.required' => 'وارد کردن اسلاگ الزامی است.',
            'slug.string' => 'اسلاگ باید به صورت رشته باشد.',
            'slug.max' => 'طول اسلاگ نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
            'slug.regex' => 'اسلاگ فقط باید شامل حروف کوچک انگلیسی، اعداد و خط تیره باشد.',
            'slug.unique' => 'این اسلاگ قبلاً برای یک دسته‌بندی دیگر استفاده شده است.',

            'parent_id.integer' => 'شناسه والد باید یک عدد باشد.',
            'parent_id.exists' => 'دسته‌بندی والد معتبر نیست.',

            'description.string' => 'توضیحات باید یک متن معتبر باشد.',

            'is_active.required' => 'وضعیت فعال/غیرفعال الزامی است.',
            'is_active.boolean' => 'وضعیت دسته‌بندی باید به صورت صحیح/غلط باشد.',

            'sort_order.required' => 'وارد کردن ترتیب نمایش الزامی است.',
            'sort_order.integer' => 'ترتیب نمایش باید عدد باشد.',
            'sort_order.min' => 'ترتیب نمایش نمی‌تواند عدد منفی باشد.',
            'sort_order.max' => 'ترتیب نمایش بیش از حد بزرگ است.',
        ];
    }

}
