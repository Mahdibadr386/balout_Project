<?php

namespace App\Http\Requests\Admin\Product;

use App\Rules\Option\OptionCategoryMatch;

use App\Rules\Option\OptionDetailBelongsToOptionAndCategory;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'description' => 'nullable|string',
            'price_base' => 'required|numeric|min:0',
            'discount_percentage' => 'nullable|integer|min:0|max:100',
            'unit' => 'required|string|max:50',
            'quantity' => 'required|integer|min:0',
            'minimum' => 'required|integer|min:0',
            'maximum' => 'required|integer|min:0',
            'preparation_time' => 'required|integer|min:0',
            'available' => 'required|boolean',
            'rate' => 'nullable|numeric|min:0|max:5',
            'batch_code' => 'nullable|string|max:100',
            'matin_code' => 'nullable|string|max:100',
            'category_id' => 'required|exists:categories,id',
            'options' => ['nullable', 'array', new OptionCategoryMatch($this->category_id)],
            'options.*.id' => 'exists:options,id',
            'options.*.detail_id' => ['required', 'exists:option_details,id', new OptionDetailBelongsToOptionAndCategory()],
            'images' => ['required', 'array', 'min:1', 'max:5'],
            'images.*' => ['required', 'file', 'mimes:jpg,jpeg,png,webp', 'max:2048', 'prohibited_if:images.*.size,0'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'نام محصول الزامی است.',
            'name.string'   => 'نام محصول باید به صورت متن باشد.',
            'name.max'      => 'نام محصول نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',

            'slug.required' => 'آدرس URL (slug) الزامی است.',
            'slug.string'   => 'آدرس URL باید به صورت متن باشد.',
            'slug.max'      => 'آدرس URL نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
            'slug.unique'   => 'این آدرس URL قبلاً برای محصول دیگری استفاده شده است.',

            'description.nullable' => 'توضیحات می‌تواند خالی باشد.',
            'description.string'   => 'توضیحات باید به صورت متن باشد.',

            'price_base.required' => 'قیمت پایه الزامی است.',
            'price_base.numeric'  => 'قیمت پایه باید عدد باشد.',
            'price_base.min'      => 'قیمت پایه نمی‌تواند منفی باشد.',

            'discount_percentage.nullable' => 'درصد تخفیف می‌تواند خالی باشد.',
            'discount_percentage.integer'  => 'درصد تخفیف باید عدد صحیح باشد.',
            'discount_percentage.min'      => 'درصد تخفیف نمی‌تواند منفی باشد.',
            'discount_percentage.max'      => 'درصد تخفیف نمی‌تواند بیشتر از ۱۰۰ باشد.',

            'unit.required' => 'واحد محصول الزامی است.',
            'unit.string'   => 'واحد محصول باید به صورت متن باشد.',
            'unit.max'      => 'واحد محصول نمی‌تواند بیشتر از ۵۰ کاراکتر باشد.',

            'quantity.required' => 'موجودی الزامی است.',
            'quantity.integer'  => 'موجودی باید عدد صحیح باشد.',
            'quantity.min'      => 'موجودی نمی‌تواند منفی باشد.',

            'minimum.required' => 'حداقل سفارش الزامی است.',
            'minimum.integer'  => 'حداقل سفارش باید عدد صحیح باشد.',
            'minimum.min'      => 'حداقل سفارش نمی‌تواند منفی باشد.',

            'maximum.required' => 'حداکثر سفارش الزامی است.',
            'maximum.integer'  => 'حداکثر سفارش باید عدد صحیح باشد.',
            'maximum.min'      => 'حداکثر سفارش نمی‌تواند منفی باشد.',

            'preparation_time.required' => 'زمان آماده‌سازی الزامی است.',
            'preparation_time.integer'  => 'زمان آماده‌سازی باید عدد صحیح باشد.',
            'preparation_time.min'      => 'زمان آماده‌سازی نمی‌تواند منفی باشد.',

            'available.required' => 'وضعیت در دسترس بودن الزامی است.',
            'available.boolean'  => 'وضعیت در دسترس بودن باید صحیح یا غلط باشد.',

            'rate.nullable' => 'امتیاز می‌تواند خالی باشد.',
            'rate.numeric'  => 'امتیاز باید عدد باشد.',
            'rate.min'      => 'امتیاز نمی‌تواند کمتر از ۰ باشد.',
            'rate.max'      => 'امتیاز نمی‌تواند بیشتر از ۵ باشد.',

            'batch_code.nullable' => 'کد بچ می‌تواند خالی باشد.',
            'batch_code.string'   => 'کد بچ باید به صورت متن باشد.',
            'batch_code.max'      => 'کد بچ نمی‌تواند بیشتر از ۱۰۰ کاراکتر باشد.',

            'matin_code.nullable' => 'کد متین می‌تواند خالی باشد.',
            'matin_code.string'   => 'کد متین باید به صورت متن باشد.',
            'matin_code.max'      => 'کد متین نمی‌تواند بیشتر از ۱۰۰ کاراکتر باشد.',

            'category_id.required' => 'شناسه دسته‌بندی الزامی است.',
            'category_id.exists'   => 'دسته‌بندی انتخاب شده معتبر نیست.',

            'options.nullable' => 'گزینه‌ها می‌توانند خالی باشند.',
            'options.array'    => 'گزینه‌ها باید به صورت آرایه باشند.',

            'options.*.id.exists' => 'شناسه گزینه معتبر نیست.',

            'options.*.detail_id.required' => 'شناسه جزئیات گزینه الزامی است.',
            'options.*.detail_id.exists'   => 'جزئیات گزینه انتخاب شده معتبر نیست.',

            'images.required' => 'آپلود حداقل یک تصویر الزامی است.',
            'images.array'    => 'تصاویر باید به صورت آرایه باشند.',
            'images.min'      => 'حداقل یک تصویر باید آپلود شود.',
            'images.max'      => 'حداکثر ۵ تصویر مجاز است.',

            'images.*.required'      => 'هر تصویر الزامی است.',
            'images.*.file'          => 'هر مورد باید فایل باشد.',
            'images.*.mimes'         => 'فرمت تصاویر فقط jpg، jpeg، png یا webp مجاز است.',
            'images.*.max'           => 'حجم هر تصویر نمی‌تواند بیشتر از ۲ مگابایت (۲۰۴۸ کیلوبایت) باشد.',
            'images.*.prohibited_if' => 'فایل خالی مجاز نیست.',
        ];
    }

}
