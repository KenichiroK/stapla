<?php

namespace App\Http\Requests\Companies;

use Illuminate\Foundation\Http\FormRequest;

class CompanyGeneralRequest extends FormRequest
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
            'representive_name'     => 'required',
            'zip_code'              => 'required',
            'address_prefecture'    => 'required',
            'address_city'          => 'required',
            'address_building'      => 'required',
        ];
    }
}
