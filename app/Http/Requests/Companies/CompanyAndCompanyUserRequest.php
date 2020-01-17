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
        if($this->request->get('invitation_user_id')) {
            return [
                'name'       => 'required | string | max:64',
                'department' => 'required | string | max:64',
            ];
        } else {
            return [
                'company_name'       => 'required | string | max:64',
                'representive_name'  => 'required | string | max:64',
                'zip_code'           => 'required | numeric | digits:7',
                'address_prefecture' => 'required',
                'address_city'       => 'required | string | max:64',
                'tel'                => 'required | numeric | digits_between:10,11',
                'name'               => 'required | string | max:64',
                'department'         => 'required | string | max:64',
            ];
        }
    }
}
