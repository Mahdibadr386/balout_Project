<?php

namespace App\Http\Requests\Public\Address;

use App\Rules\User\DistrictBelongsToCitySolitary;
use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
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
        $cityId = $this->input('city_id');

        return [
            'address' => 'required_with:addresses|string|max:1000',
            'city_id' => 'nullable|integer|exists:cities,id',
            'district_id' => ['nullable', 'integer', new DistrictBelongsToCitySolitary($cityId)],
            'tel' => 'nullable|string|max:11',
        ];
    }


    public function messages()
    {
        return [
            'address.required_with' => 'آدرس الزامی است.',
            'address.string'        => 'آدرس باید به صورت متن باشد.',
            'address.max'           => 'آدرس نمی‌تواند بیشتر از ۱۰۰۰ کاراکتر باشد.',

            'city_id.nullable' => 'شناسه شهر می‌تواند خالی باشد.',
            'city_id.integer'  => 'شناسه شهر باید عدد صحیح باشد.',
            'city_id.exists'   => 'شهر انتخاب شده معتبر نیست.',

            'district_id.nullable' => 'شناسه ناحیه می‌تواند خالی باشد.',
            'district_id.integer'  => 'شناسه ناحیه باید عدد صحیح باشد.',
            'district_id.exists'   => 'ناحیه انتخاب شده معتبر نیست.',

            'tel.nullable' => 'شماره تلفن آدرس می‌تواند خالی باشد.',
            'tel.string'   => 'شماره تلفن آدرس باید به صورت متن باشد.',
            'tel.max'      => 'شماره تلفن آدرس نمی‌تواند بیشتر از ۱۱ کاراکتر باشد.',
        ];
    }
}
