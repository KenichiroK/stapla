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
            'project_name'     => 'bail | required | string | max:64',
            'project_detail'   => 'bail | required | string | max:200',
            'company_user_id'  => 'required',
            'started_at'       => 'required',
            'ended_at'         => 'bail | required | after_or_equal:started_at',
            'budget'           => 'bail | required | integer | digits_between:1,12',
        ];
    }
}
