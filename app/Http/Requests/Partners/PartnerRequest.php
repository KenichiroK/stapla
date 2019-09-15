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
            'name'         => 'required | string | max:64',
            'name'         => 'required | string | max:64',
            'occupations'  => 'max:64',
            'zip_code'     => 'required | numeric | digits:7',
            'prefecture'   => 'required',
            'city'         => 'required | string | max:64',
            'street'       => 'required | string | max:64',
            'tel'          => 'required | numeric | digits_between:10,11',
        ];
    }
}
