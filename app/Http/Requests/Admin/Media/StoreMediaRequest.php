<?php

namespace App\Http\Requests\Admin\Media;

use Illuminate\Foundation\Http\FormRequest;

class StoreMediaRequest extends FormRequest
{

    public function authorize(): bool
    {
        return auth()->check();
    }


    public function rules(): array
    {
        return [
            'file' => [
                'required',
                'file',
                'max:10240',
                'mimes:jpg,jpeg,png,webp,mp4,mov,avi'
            ],
            'type' => [
                'required',
                'in:image,video'
            ],
            'collection_name' => [
                'required',
                'string',
                'max:100',
                'regex:/^[a-zA-Z0-9_-]+$/u'
            ],
            'order_column' => [
                'nullable',
                'integer',
                'min:1',
                'max:100000'
            ],
            'alt' => [
                'nullable',
                'string'
            ],
            'duration' => [
                'nullable',
                'integer',
                'min:1',
                'max:1800'
            ],
        ];
    }


    public function messages(): array
    {
        return [
            'file.required' => 'انتخاب فایل رسانه الزامی است.',
            'file.file' => 'فایل ارسال شده معتبر نیست.',
            'file.max' => 'حجم فایل نباید بیشتر از ۱۰ مگابایت باشد.',
            'file.mimes' => 'فرمت فایل نامعتبر است.',

            'type.required' => 'نوع رسانه باید مشخص شود.',
            'type.in' => 'نوع رسانه فقط می‌تواند تصویر یا ویدیو باشد.',

            'collection_name.required' => 'نام مجموعه رسانه الزامی است.',
            'collection_name.regex' => 'نام مجموعه فقط می‌تواند شامل حروف، اعداد، خط فاصله و زیرخط باشد.',

            'order_column.integer' => 'ترتیب نمایش باید عدد صحیح باشد.',
            'order_column.min' => 'مقدار ترتیب نمی‌تواند کوچکتر از ۱ باشد.',
            'order_column.max' => 'مقدار ترتیب نمی‌تواند بزرگتر از ۱۰۰۰۰۰ باشد.',

            'alt.string' => 'جمله جایگزین باید به صورت متن باشد .',

            'duration.integer' => 'مدت زمان باید عدد صحیح باشد.',
            'duration.min' => 'مدت زمان نمی‌تواند کمتر از ۱ ثانیه باشد.',
            'duration.max' => 'مدت زمان ویدیو نباید بیشتر از ۳۰ دقیقه باشد.',
        ];
    }
}
