<?php

namespace App\Http\Requests\Companies;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Prefecture;

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
            'representive_name'     => 'required | string | max:6',
            'zip_code'              => 'required | numeric | digits:7',
            'address_prefecture'    => new Prefecture(),
            'address_city'          => 'required | string | max:6',
            'address_building'      => 'max:64',
        ];
    }
}
