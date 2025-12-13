<?php

namespace App\Http\Requests\Admin\Product;

use App\Rules\Option\OptionCategoryMatch;
use App\Rules\Option\OptionDetailBelongsToOptionAndCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $product = $this->route('product');

        return [

            'name' => 'sometimes|string|max:255',
            'slug' => ['sometimes','string','max:255', Rule::unique('products','slug')->ignore($this->route('id'))],
            'description' => 'nullable|string',
            'price_base' => 'sometimes|numeric|min:0',
            'discount_percentage' => 'nullable|integer|min:0|max:100',
            'unit' => 'nullable|string|max:50',
            'quantity' => 'nullable|integer|min:0',
            'minimum' => 'nullable|integer|min:0',
            'maximum' => 'nullable|integer|min:0',
            'preparation_time' => 'nullable|integer|min:0',
            'available' => 'nullable|boolean',
            'rate' => 'nullable|numeric|min:0|max:5',
            'batch_code' => 'nullable|string|max:100',
            'matin_code' => 'nullable|string|max:100',
            'category_id' => 'nullable|exists:categories,id',
            'options' => ['nullable', 'array', new OptionCategoryMatch($this->category_id ?? $product->category_id)],
            'options.*.id' => ['required', 'exists:options,id'],
            'options.*.detail_id' => ['required', 'array'],
            'options.*.detail_id.*' => [
                'required',
                'exists:option_details,id',
                new OptionDetailBelongsToOptionAndCategory(),
            ],
            'images' => ['nullable', 'array', 'max:5'],
            'images.*' => ['file', 'mimes:jpg,jpeg,png,webp', 'max:2048', 'dimensions:min_width=300,min_height=300'],
            'remove_images' => ['nullable', 'array'],
            'remove_images.*' => ['integer', 'exists:media,id'],
        ];
    }


    public function messages()
    {
        return [
            'name.sometimes' => 'نام محصول گاهی ارسال می‌شود.',
            'name.string'    => 'نام محصول باید به صورت متن باشد.',
            'name.max'       => 'نام محصول نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',

            'slug.sometimes' => 'آدرس URL (slug) گاهی ارسال می‌شود.',
            'slug.string'    => 'آدرس URL باید به صورت متن باشد.',
            'slug.max'       => 'آدرس URL نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
            'slug.unique'    => 'این آدرس URL قبلاً برای محصول دیگری استفاده شده است.',

            'description.nullable' => 'توضیحات می‌تواند خالی باشد.',
            'description.string'   => 'توضیحات باید به صورت متن باشد.',

            'price_base.sometimes' => 'قیمت پایه گاهی ارسال می‌شود.',
            'price_base.numeric'   => 'قیمت پایه باید عدد باشد.',
            'price_base.min'       => 'قیمت پایه نمی‌تواند منفی باشد.',

            'discount_percentage.nullable' => 'درصد تخفیف می‌تواند خالی باشد.',
            'discount_percentage.integer'  => 'درصد تخفیف باید عدد صحیح باشد.',
            'discount_percentage.min'      => 'درصد تخفیف نمی‌تواند منفی باشد.',
            'discount_percentage.max'      => 'درصد تخفیف نمی‌تواند بیشتر از ۱۰۰ باشد.',

            'unit.nullable' => 'واحد محصول می‌تواند خالی باشد.',
            'unit.string'   => 'واحد محصول باید به صورت متن باشد.',
            'unit.max'      => 'واحد محصول نمی‌تواند بیشتر از ۵۰ کاراکتر باشد.',

            'quantity.nullable' => 'موجودی می‌تواند خالی باشد.',
            'quantity.integer'  => 'موجودی باید عدد صحیح باشد.',
            'quantity.min'      => 'موجودی نمی‌تواند منفی باشد.',

            'minimum.nullable' => 'حداقل سفارش می‌تواند خالی باشد.',
            'minimum.integer'  => 'حداقل سفارش باید عدد صحیح باشد.',
            'minimum.min'      => 'حداقل سفارش نمی‌تواند منفی باشد.',

            'maximum.nullable' => 'حداکثر سفارش می‌تواند خالی باشد.',
            'maximum.integer'  => 'حداکثر سفارش باید عدد صحیح باشد.',
            'maximum.min'      => 'حداکثر سفارش نمی‌تواند منفی باشد.',

            'preparation_time.nullable' => 'زمان آماده‌سازی می‌تواند خالی باشد.',
            'preparation_time.integer'  => 'زمان آماده‌سازی باید عدد صحیح باشد.',
            'preparation_time.min'      => 'زمان آماده‌سازی نمی‌تواند منفی باشد.',

            'available.nullable' => 'وضعیت در دسترس بودن می‌تواند خالی باشد.',
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

            'category_id.nullable' => 'شناسه دسته‌بندی می‌تواند خالی باشد.',
            'category_id.exists'   => 'دسته‌بندی انتخاب شده معتبر نیست.',

            'options.nullable' => 'گزینه‌ها می‌توانند خالی باشند.',
            'options.array'    => 'گزینه‌ها باید به صورت آرایه باشند.',

            'options.*.id.required' => 'شناسه گزینه الزامی است.',
            'options.*.id.exists'   => 'شناسه گزینه معتبر نیست.',

            'options.*.detail_id.required' => 'جزئیات گزینه الزامی است.',
            'options.*.detail_id.array'    => 'جزئیات گزینه باید به صورت آرایه باشد.',

            'options.*.detail_id.*.required' => 'شناسه جزئیات گزینه الزامی است.',
            'options.*.detail_id.*.exists'   => 'جزئیات گزینه انتخاب شده معتبر نیست.',

            'images.nullable' => 'تصاویر می‌توانند خالی باشند.',
            'images.array'    => 'تصاویر باید به صورت آرایه باشند.',
            'images.max'      => 'حداکثر ۵ تصویر مجاز است.',

            'images.*.file'       => 'هر مورد باید فایل باشد.',
            'images.*.mimes'      => 'فرمت تصاویر فقط jpg، jpeg، png یا webp مجاز است.',
            'images.*.max'        => 'حجم هر تصویر نمی‌تواند بیشتر از ۲ مگابایت (۲۰۴۸ کیلوبایت) باشد.',
            'images.*.dimensions' => 'ابعاد هر تصویر باید حداقل ۳۰۰×۳۰۰ پیکسل باشد.',

            'remove_images.nullable' => 'لیست تصاویر برای حذف می‌تواند خالی باشد.',
            'remove_images.array'    => 'لیست تصاویر برای حذف باید آرایه باشد.',

            'remove_images.*.integer' => 'شناسه تصویر برای حذف باید عدد صحیح باشد.',
            'remove_images.*.exists'  => 'تصویر انتخاب شده برای حذف معتبر نیست.',
        ];
    }

}
