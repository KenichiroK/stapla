<?php

namespace App\Http\Requests\Partners;

use Illuminate\Foundation\Http\FormRequest;

class PartnerRequest extends FormRequest
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
            'name'       => 'required',
            'zip_code'   => 'required',
            'prefecture' => 'required',
            'city'       => 'required',
            'street'     => 'required',
            'tel'        => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name'       => '氏名を入力してください',
            'zip_code'   => '郵便番号を入力してださい',
            'prefecture' => '都道府県を入力してください',
            'city'       => '市町村を入力してください',
            'street'     => '番地を入力してください',
            'tel'        => '電話番号を入力してください',
        ];
    }
}
