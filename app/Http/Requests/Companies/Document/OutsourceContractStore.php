<?php

namespace App\Http\Requests\Companies\Document;

use Illuminate\Foundation\Http\FormRequest;

class OutsourceContractStore extends FormRequest
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
            'company_name' => [
                'required',
                'string',
                'max:64',
            ],
            'company_id' => [
                'required',
                'uuid'
            ],
            'company_address' => [
                'required',
                'max:191',
            ],
            'representive_name' => [
                'required',
                'max:64',
            ],
            'partner_name' => [
                'required',
                'max:64',
            ],
            'partner_id' => [
                'required',
                'uuid'
            ],
            'partner_address' => [
                'required',
                'max:191',
            ],
            'contract_date' => [
                'required',
                'date_format:Y-m-d',
            ],
            'court' => [
                'required',
                'max:64'
            ],
        ];
    }

    public function attributes()
    {
        return [
            'company_name' => '企業名',
            'company_id' => '企業ID',
            'company_address' => '企業住所',
            'representive_name' => '企業代表者名',
            'partner_name' => 'パートナ名',
            'partner_id' => 'パートナID',
            'partner_address' => 'パートナ住所',
            'contract_date' => '契約締結日',
            'court' => '裁判所'
        ];
    }

    public function messages()
    {
        return [
            'contract_date.date_format' => ':attributeは「yyyy-mm-dd」の形式で入力してください',
        ];
    }
}
