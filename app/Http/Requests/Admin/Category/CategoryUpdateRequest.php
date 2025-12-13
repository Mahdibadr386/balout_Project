<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('id');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')
                    ->ignore($id)
                    ->where(function ($query) {
                        return $query->where('parent_id', $this->parent_id);
                    }),
            ],

            'slug' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                Rule::unique('categories', 'slug')->ignore($id),
            ],

            'parent_id' => [
                'nullable',
                'integer',
                'exists:categories,id',

                Rule::notIn([$id]),
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
            'name.required' => 'نام دسته‌بندی الزامی است.',
            'name.string'   => 'نام دسته‌بندی باید به صورت متن باشد.',
            'name.max'      => 'نام دسته‌بندی نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
            'name.unique'   => 'این نام در این سطح دسته‌بندی قبلاً استفاده شده است.',

            'slug.required' => 'آدرس URL (slug) الزامی است.',
            'slug.string'   => 'آدرس URL باید به صورت متن باشد.',
            'slug.max'      => 'آدرس URL نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
            'slug.regex'    => 'فرمت آدرس URL معتبر نیست. فقط حروف کوچک انگلیسی، اعداد و خط تیره (-) مجاز است.',
            'slug.unique'   => 'این آدرس URL قبلاً استفاده شده است.',

            'parent_id.nullable' => 'دسته‌بندی والد می‌تواند خالی باشد.',
            'parent_id.integer'  => 'شناسه دسته‌بندی والد باید عدد صحیح باشد.',
            'parent_id.exists'   => 'دسته‌بندی والد انتخاب شده معتبر نیست.',
            'parent_id.not_in'   => 'دسته‌بندی والد نمی‌تواند خود دسته‌بندی فعلی باشد.',

            'description.nullable' => 'توضیحات می‌تواند خالی باشد.',
            'description.string'   => 'توضیحات باید به صورت متن باشد.',

            'is_active.required' => 'وضعیت فعال بودن الزامی است.',
            'is_active.boolean'  => 'وضعیت فعال بودن باید صحیح یا غلط باشد.',

            'sort_order.required' => 'ترتیب نمایش الزامی است.',
            'sort_order.integer'  => 'ترتیب نمایش باید عدد صحیح باشد.',
            'sort_order.min'      => 'ترتیب نمایش نمی‌تواند منفی باشد.',
            'sort_order.max'      => 'ترتیب نمایش نمی‌تواند بیشتر از ۱٬۰۰۰٬۰۰۰ باشد.',
        ];
    }

}
