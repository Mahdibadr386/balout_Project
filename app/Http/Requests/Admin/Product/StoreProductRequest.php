<?php

namespace App\Http\Requests\Admin\Product;

use App\Rules\Option\OptionCategoryMatch;

use App\Rules\Option\OptionDetailBelongsToOptionAndCategory;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
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
            'name.string' => 'نام محصول باید متن باشد.',
            'name.max' => 'نام محصول نمی‌تواند بیش از ۲۵۵ کاراکتر باشد.',

            'slug.required' => 'اسلاگ محصول الزامی است.',
            'slug.string' => 'اسلاگ باید متن باشد.',
            'slug.max' => 'اسلاگ نمی‌تواند بیش از ۲۵۵ کاراکتر باشد.',
            'slug.unique' => 'این اسلاگ قبلاً استفاده شده است.',

            'description.string' => 'توضیحات باید متن باشد.',

            'price_base.required' => 'قیمت پایه الزامی است.',
            'price_base.numeric' => 'قیمت پایه باید عدد باشد.',
            'price_base.min' => 'قیمت پایه نمی‌تواند کمتر از صفر باشد.',

            'discount_percentage.integer' => 'درصد تخفیف باید عدد صحیح باشد.',
            'discount_percentage.min' => 'درصد تخفیف نمی‌تواند کمتر از صفر باشد.',
            'discount_percentage.max' => 'درصد تخفیف نمی‌تواند بیش از ۱۰۰ باشد.',

            'unit.required' => 'واحد محصول الزامی است.',
            'unit.string' => 'واحد باید متن باشد.',
            'unit.max' => 'واحد نمی‌تواند بیش از ۵۰ کاراکتر باشد.',

            'quantity.required' => 'موجودی محصول الزامی است.',
            'quantity.integer' => 'موجودی باید عدد صحیح باشد.',
            'quantity.min' => 'موجودی نمی‌تواند کمتر از صفر باشد.',

            'minimum.required' => 'حداقل مقدار سفارش الزامی است.',
            'minimum.integer' => 'حداقل مقدار باید عدد صحیح باشد.',
            'minimum.min' => 'حداقل مقدار نمی‌تواند کمتر از صفر باشد.',

            'maximum.required' => 'حداکثر مقدار سفارش الزامی است.',
            'maximum.integer' => 'حداکثر مقدار باید عدد صحیح باشد.',
            'maximum.min' => 'حداکثر مقدار نمی‌تواند کمتر از صفر باشد.',

            'preparation_time.required' => 'زمان آماده‌سازی الزامی است.',
            'preparation_time.integer' => 'زمان آماده‌سازی باید عدد صحیح باشد.',
            'preparation_time.min' => 'زمان آماده‌سازی نمی‌تواند کمتر از صفر باشد.',

            'available.required' => 'وضعیت موجودی الزامی است.',
            'available.boolean' => 'وضعیت موجودی باید درست یا نادرست باشد.',

            'rate.numeric' => 'امتیاز باید عدد باشد.',
            'rate.min' => 'امتیاز نمی‌تواند کمتر از صفر باشد.',
            'rate.max' => 'امتیاز نمی‌تواند بیشتر از ۵ باشد.',

            'batch_code.string' => 'کد بچ باید متن باشد.',
            'batch_code.max' => 'کد بچ نمی‌تواند بیش از ۱۰۰ کاراکتر باشد.',

            'matin_code.string' => 'کد متین باید متن باشد.',
            'matin_code.max' => 'کد متین نمی‌تواند بیش از ۱۰۰ کاراکتر باشد.',

            'category_id.required' => 'انتخاب دسته‌بندی الزامی است.',
            'category_id.exists' => 'دسته‌بندی انتخاب‌شده معتبر نیست.',

            'options.array' => 'ساختار گزینه‌ها معتبر نیست.',
            'options.*.exists' => 'یکی از گزینه‌های انتخاب‌شده وجود ندارد یا معتبر نیست.',

            'images.required' => 'ارسال حداقل یک تصویر برای محصول اجباری است.',
            'images.array' => 'تصاویر باید در قالب آرایه ارسال شوند.',
            'images.min' => 'حداقل یک تصویر باید ارسال شود.',
            'images.max' => 'حداکثر تعداد مجاز تصاویر ۵ عدد است.',

            'images.*.required' => 'ارسال هر تصویر الزامی است.',
            'images.*.file' => 'هر آیتم تصاویر باید یک فایل معتبر باشد.',
            'images.*.mimes' => 'تنها فرمت‌های JPG, JPEG, PNG و WEBP مجاز هستند.',
            'images.*.max' => 'حجم هر تصویر نباید بیش از ۲ مگابایت باشد.',
        ];
    }

}
