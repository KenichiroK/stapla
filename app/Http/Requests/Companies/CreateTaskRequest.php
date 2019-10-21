<?php

namespace App\Http\Requests\Companies;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
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
            'project_id'      => 'required',
            'task_name'       => 'required | string | max:64',
            'task_content'    => 'required | string | max:200',
            'company_user_id' => 'required',
            'superior_id'     => 'required',
            'accounting_id'   => 'required',
            'started_at'      => 'required',
            'ended_at'        => 'required | after:started_at',
            'budget'          => 'required | integer | digits_between:1, 12',
            'price'           => 'required | integer | digits_between:1, 12',
            // 'cases'           => 'required | integer | digits_between:1, 10',
            'partner_id'      => 'required',
            // 'fee_format'      => 'required',
        ];
    }

    public function messages()
    {
        return [
            // 
        ];
    }
}
