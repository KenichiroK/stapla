<?php

namespace App\Http\Requests\Companies;

use Illuminate\Foundation\Http\FormRequest;

class TaskPreviewRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'project_id'           => 'bail | required | uuid',
            'task_name'            => 'bail | required | string | max:64',
            'content'              => 'bail | required | string | max:200',
            'task_company_user_id' => 'bail | required | uuid',
            'superior_id'          => 'bail | required | uuid',
            'accounting_id'        => 'bail | required | uuid',
            'started_at'           => 'required',
            'ended_at'             => 'bail | required | after:started_at',
            'budget'               => 'bail | required | integer | digits_between:1, 12',
            'order_price'          => 'bail | required | integer | digits_between:1, 12',
            'partner_id'           => 'bail | required | uuid',
            'task_name'            => 'bail | required | string | max:64',
            'delivery_date'        => 'required',
        ];
    }
}
