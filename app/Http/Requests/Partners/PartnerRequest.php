<?php

namespace App\Http\Requests\Partners;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Prefecture;

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
            'occupations'  => 'string | max:64',
            'introduction' => 'string | max:200',
            'zip_code'     => 'required | numeric | digits:7',
            'prefecture'   => new Prefecture(),
            'city'         => 'required | string | max:64',
            'street'       => 'required | string | max:64',
            'tel'          => 'required | numeric | digits_between:10,11',
        ];
    }
}
