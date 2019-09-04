<?php

namespace App\Http\Requests\Partners;

use Illuminate\Foundation\Http\FormRequest;

class PartnerInvoiceRequest extends FormRequest
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
            'name'                  => 'required',
            'zip_code'              => 'required',
            'prefecture'            => 'required',
            'city'                  => 'required',
            'street'                => 'required',
            'tel'                   => 'required',
            'financial_institution' => 'required',
            'branch'                => 'required',
            'deposit_type'          => 'required',
            'account_number'        => 'required',
            'account_holder'        => 'required',
            'mark_image'            => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'                  => "屋号 / 名前は必須項目です。",
            'zip_code.required'              => "郵便番号は必須項目です。",
            'prefecture.required'            => "住所は必須項目です。",
            'city.required'                  => "住所は必須項目です。",
            'tel.required'                   => "電話番号は必須項目です。",
            'financial_institution.required' => "金融機関は必須項目です。",
            'branch.required'                => "支店は必須項目です。",
            'deposit_type.required'          => "預金種類は必須項目です。",
            'account_number.required'        => "口座番号は必須項目です。",
            'account_holder.required'        => "口座名義は必須項目です。",
            'mark_image.required'            => "請求書印は必須項目です。",
        ];
    }
}
