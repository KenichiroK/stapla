<?php

namespace App\Http\Requests\Companies;

use Illuminate\Foundation\Http\FormRequest;

class CreateProjectRequest extends FormRequest
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
            'project_name'     => 'required | string | max:64',
            'project_detail'   => 'required | string | max:200',
            'company_user_id'  => 'required',
            'superior_id'      => 'required',
            'accounting_id'    => 'required',
            'partner_id'       => 'required',
            'started_at'       => 'required',
            'ended_at'         => 'required | after:started_at',
            'budget'           => 'required | integer | digits_between:1,12',
        ];
    }
}
