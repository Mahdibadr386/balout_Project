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
        return auth()->check();
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
            'name.string' => 'نام محصول باید متن باشد.',
            'name.max' => 'نام محصول نمی‌تواند بیش از ۲۵۵ کاراکتر باشد.',

            'slug.string' => 'اسلاگ باید متن باشد.',
            'slug.max' => 'اسلاگ نمی‌تواند بیش از ۲۵۵ کاراکتر باشد.',
            'slug.unique' => 'این اسلاگ قبلاً استفاده شده است.',

            'description.string' => 'توضیحات باید متن باشد.',

            'price_base.numeric' => 'قیمت پایه باید عدد باشد.',
            'price_base.min' => 'قیمت پایه نمی‌تواند کمتر از صفر باشد.',

            'discount_percentage.integer' => 'درصد تخفیف باید عدد صحیح باشد.',
            'discount_percentage.min' => 'درصد تخفیف نمی‌تواند کمتر از صفر باشد.',
            'discount_percentage.max' => 'درصد تخفیف نمی‌تواند بیش از ۱۰۰ باشد.',

            'unit.string' => 'واحد باید متن باشد.',
            'unit.max' => 'واحد نمی‌تواند بیش از ۵۰ کاراکتر باشد.',

            'quantity.integer' => 'موجودی باید عدد صحیح باشد.',
            'quantity.min' => 'موجودی نمی‌تواند کمتر از صفر باشد.',

            'minimum.integer' => 'حداقل مقدار سفارش باید عدد صحیح باشد.',
            'minimum.min' => 'حداقل مقدار سفارش نمی‌تواند کمتر از صفر باشد.',

            'maximum.integer' => 'حداکثر مقدار سفارش باید عدد صحیح باشد.',
            'maximum.min' => 'حداکثر مقدار سفارش نمی‌تواند کمتر از صفر باشد.',

            'preparation_time.integer' => 'زمان آماده‌سازی باید عدد صحیح باشد.',
            'preparation_time.min' => 'زمان آماده‌سازی نمی‌تواند کمتر از صفر باشد.',

            'available.boolean' => 'وضعیت موجودی باید درست یا نادرست باشد.',

            'rate.numeric' => 'امتیاز باید عدد باشد.',
            'rate.min' => 'امتیاز نمی‌تواند کمتر از صفر باشد.',
            'rate.max' => 'امتیاز نمی‌تواند بیشتر از ۵ باشد.',

            'batch_code.string' => 'کد بچ باید متن باشد.',
            'batch_code.max' => 'کد بچ نمی‌تواند بیش از ۱۰۰ کاراکتر باشد.',

            'matin_code.string' => 'کد متین باید متن باشد.',
            'matin_code.max' => 'کد متین نمی‌تواند بیش از ۱۰۰ کاراکتر باشد.',

            'category_id.exists' => 'دسته‌بندی انتخاب‌شده معتبر نیست.',

            'options.array' => 'گزینه‌ها باید به صورت آرایه ارسال شوند.',
            'options.*.id.required' => 'هر گزینه باید مشخص شود.',
            'options.*.id.exists' => 'گزینه انتخاب شده معتبر نیست.',
            'options.*.detail_id.required' => 'جزئیات هر گزینه باید مشخص شود.',
            'options.*.detail_id.exists' => 'جزئیات انتخاب شده معتبر نیست.',

            'images.array' => 'تصاویر باید در قالب آرایه ارسال شوند.',
            'images.max' => 'حداکثر تعداد تصاویر قابل ارسال ۵ عدد است.',

            'images.*.file' => 'هر تصویر باید یک فایل معتبر باشد.',
            'images.*.mimes' => 'فرمت تصویر فقط باید JPG، JPEG، PNG یا WEBP باشد.',
            'images.*.max' => 'حجم هر تصویر نباید بیشتر از ۲ مگابایت باشد.',
            'images.*.dimensions' => 'ابعاد هر تصویر باید حداقل ۳۰۰ در ۳۰۰ پیکسل باشد.',


            'remove_images.array' => 'لیست تصاویر حذف‌شونده باید به صورت آرایه ارسال شود.',
            'remove_images.*.integer' => 'شناسه تصویر نامعتبر است.',
            'remove_images.*.exists' => 'تصویری با این شناسه یافت نشد.',
        ];
    }

}
