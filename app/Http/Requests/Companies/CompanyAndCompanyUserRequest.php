<?php

namespace App\Http\Requests\Companies;

use Illuminate\Foundation\Http\FormRequest;

class CompanyAndCompanyUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_name'       => 'required',
            'representive_name'  => 'required',
            'zip_code'           => 'required',
            'address_prefecture' => 'required',
            'address_city'       => 'required',
            'tel'                => 'required',
            'name'               => 'required',
            'department'         => 'required',
        ];
    }

    public function messages()
    {
        return [
            'company_name'       => '企業名は必須項目です。',
            'representive_name'  => '代表者は必須項目です。',
            'zip_code'           => '郵便番号は必須項目です。',
            'address_prefecture' => '都道府県は必須項目です。',
            'address_city'       => '住所は必須項目です。',
            'tel'                => '電話番号は必須項目です。',
            'name'               => '名前は必須項目です。',
            'department'         => '担当は必須項目です。',
        ];
    }
}
