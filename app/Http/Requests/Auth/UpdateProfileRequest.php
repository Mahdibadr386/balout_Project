<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        $userId = optional($this->user())->id;

        return [
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'name_en' => 'required|string|max:255',
            'tel' => 'required|string|max:11|unique:users,tel,' . $userId,
            'national_code' => 'required|string|max:10|unique:users,national_code,' . $userId,
            'description' => 'nullable|string|max:2000',
            'password' => 'nullable|string|min:6|max:255',
            'birth_date' => 'nullable|date|before:today',
            'marriage_date' => 'nullable|date|before_or_equal:today',
            'addresses' => 'nullable|array',
            'addresses.*.address' => 'required_with:addresses|string|max:1000',
            'addresses.*.city_id' => 'nullable|integer|exists:cities,id',
            'addresses.*.tel' => 'nullable|string|max:11',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.string' => 'نام باید یک رشته معتبر باشد.',
            'first_name.max' => 'نام نمی‌تواند بیش از ۲۵۵ کاراکتر باشد.',

            'last_name.string' => 'نام خانوادگی باید یک رشته معتبر باشد.',
            'last_name.max' => 'نام خانوادگی نمی‌تواند بیش از ۲۵۵ کاراکتر باشد.',

            'name_en.required' => 'نام انگلیسی الزامی است.',
            'name_en.string' => 'نام انگلیسی باید یک رشته معتبر باشد.',
            'name_en.max' => 'نام انگلیسی نمی‌تواند بیش از ۲۵۵ کاراکتر باشد.',

            'tel.string' => 'شماره تلفن باید یک رشته معتبر باشد.',
            'tel.max' => 'شماره تلفن نمی‌تواند بیش از 11 کاراکتر باشد.',
            'tel.unique' => 'این شماره تلفن قبلا ثبت شده است.',

            'national_code.required' => 'کد ملی الزامی است.',
            'national_code.string' => 'کد ملی باید یک رشته معتبر باشد.',
            'national_code.max' => 'کد ملی نمی‌تواند بیش از 10 کاراکتر باشد.',
            'national_code.unique' => 'این کد ملی در دسترس نمی باشد',

            'description.string' => 'توضیحات باید یک متن معتبر باشد.',
            'description.max' => 'توضیحات نمی‌تواند بیش از ۲۰۰۰ کاراکتر باشد.',

            'password.string' => 'رمز عبور باید یک رشته معتبر باشد.',
            'password.min' => 'رمز عبور باید حداقل ۶ کاراکتر باشد.',
            'password.max' => 'رمز عبور نمی‌تواند بیش از ۲۵۵ کاراکتر باشد.',

            'birth_date.date' => 'تاریخ تولد معتبر نمی‌باشد.',
            'birth_date.before' => 'تاریخ تولد نمی‌تواند در آینده باشد.',

            'marriage_date.date' => 'تاریخ ازدواج معتبر نمی‌باشد.',
            'marriage_date.before_or_equal' => 'تاریخ ازدواج نمی‌تواند بعد از امروز باشد.',

            'addresses.array' => 'آدرس‌ها باید به صورت آرایه ارسال شوند.',

            'addresses.*.address.required_with' => 'آدرس نمی‌تواند خالی باشد.',
            'addresses.*.address.string' => 'آدرس باید یک متن معتبر باشد.',
            'addresses.*.address.max' => 'آدرس نمی‌تواند بیش از ۱۰۰۰ کاراکتر باشد.',

            'addresses.*.city_id.integer' => 'شناسه شهر معتبر نمی‌باشد.',
            'addresses.*.city_id.exists' => 'شهر انتخاب شده وجود ندارد.',

            'addresses.*.tel.string' => 'شماره تلفن آدرس باید یک رشته معتبر باشد.',
            'addresses.*.tel.max' => 'شماره تلفن آدرس نمی‌تواند بیش از 11 کاراکتر باشد.',
        ];
    }

}
