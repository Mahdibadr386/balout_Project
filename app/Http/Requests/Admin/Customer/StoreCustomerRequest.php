<?php

namespace App\Http\Requests\Admin\Customer;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'name_en' => 'required|string|max:255',
            'tel' => 'required|string|max:11|unique:users,tel,',
            'national_code' => 'required|string|max:10|unique:users,national_code,',
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
            'first_name.required' => 'نام الزامی است.',
            'first_name.string'   => 'نام باید به صورت متن باشد.',
            'first_name.max'      => 'نام نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',

            'last_name.nullable' => 'نام خانوادگی می‌تواند خالی باشد.',
            'last_name.string'   => 'نام خانوادگی باید به صورت متن باشد.',
            'last_name.max'      => 'نام خانوادگی نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',

            'name_en.required' => 'نام لاتین الزامی است.',
            'name_en.string'   => 'نام لاتین باید به صورت متن باشد.',
            'name_en.max'      => 'نام لاتین نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',

            'tel.required' => 'شماره موبایل الزامی است.',
            'tel.string'   => 'شماره موبایل باید به صورت متن باشد.',
            'tel.max'      => 'شماره موبایل نمی‌تواند بیشتر از ۱۱ کاراکتر باشد.',
            'tel.unique'   => 'این شماره موبایل قبلاً ثبت شده است.',

            'national_code.required' => 'کد ملی الزامی است.',
            'national_code.string'   => 'کد ملی باید به صورت متن باشد.',
            'national_code.max'      => 'کد ملی نمی‌تواند بیشتر از ۱۰ کاراکتر باشد.',
            'national_code.unique'   => 'این کد ملی قبلاً ثبت شده است.',

            'description.nullable' => 'توضیحات می‌تواند خالی باشد.',
            'description.string'   => 'توضیحات باید به صورت متن باشد.',
            'description.max'      => 'توضیحات نمی‌تواند بیشتر از ۲۰۰۰ کاراکتر باشد.',

            'password.nullable' => 'رمز عبور می‌تواند خالی باشد.',
            'password.string'   => 'رمز عبور باید به صورت متن باشد.',
            'password.min'      => 'رمز عبور باید حداقل ۶ کاراکتر باشد.',
            'password.max'      => 'رمز عبور نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',

            'birth_date.nullable' => 'تاریخ تولد می‌تواند خالی باشد.',
            'birth_date.date'     => 'تاریخ تولد باید یک تاریخ معتبر باشد.',
            'birth_date.before'   => 'تاریخ تولد نمی‌تواند امروز یا پس از امروز باشد.',

            'marriage_date.nullable'     => 'تاریخ ازدواج می‌تواند خالی باشد.',
            'marriage_date.date'         => 'تاریخ ازدواج باید یک تاریخ معتبر باشد.',
            'marriage_date.before_or_equal' => 'تاریخ ازدواج نمی‌تواند پس از امروز باشد.',

            'addresses.nullable' => 'آدرس‌ها می‌توانند خالی باشند.',
            'addresses.array'    => 'آدرس‌ها باید به صورت آرایه باشند.',

            'addresses.*.address.required_with' => 'آدرس الزامی است.',
            'addresses.*.address.string'        => 'آدرس باید به صورت متن باشد.',
            'addresses.*.address.max'           => 'آدرس نمی‌تواند بیشتر از ۱۰۰۰ کاراکتر باشد.',

            'addresses.*.city_id.nullable' => 'شناسه شهر می‌تواند خالی باشد.',
            'addresses.*.city_id.integer'  => 'شناسه شهر باید عدد صحیح باشد.',
            'addresses.*.city_id.exists'   => 'شهر انتخاب شده معتبر نیست.',

            'addresses.*.tel.nullable' => 'شماره تلفن آدرس می‌تواند خالی باشد.',
            'addresses.*.tel.string'   => 'شماره تلفن آدرس باید به صورت متن باشد.',
            'addresses.*.tel.max'      => 'شماره تلفن آدرس نمی‌تواند بیشتر از ۱۱ کاراکتر باشد.',
        ];
    }
}
