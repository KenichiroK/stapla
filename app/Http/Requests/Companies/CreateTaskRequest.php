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
            'project_id'      => 'required | uuid',
            'name'            => 'required | string | max:64',
            'content'         => 'required | string | max:200',
            'company_user_id' => 'required | uuid',
            'superior_id'     => 'required | uuid',
            'accounting_id'   => 'required | uuid',
            'started_at'      => 'required',
            'ended_at'        => 'required | after:started_at',
            'budget'          => 'required | integer | digits_between:1, 12',
            'price'           => 'required | integer | digits_between:1, 12',
            'partner_id'      => 'required | uuid',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'タスク名',
            'content' => 'タスク内容'
        ];
    }
}
