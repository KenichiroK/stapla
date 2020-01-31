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
        if($this->task_status <= config('const.TASK_SUBMIT_SUPERIOR')){
            return [
                // タスク
                'project_id'           => 'bail | required | uuid',
                'task_name'            => 'bail | required | string | max:64',
                'content'              => 'bail | required | string | max:200',
                'task_company_user_id' => 'bail | required | uuid',
                'superior_id'          => 'bail | required | uuid',
                'accounting_id'        => 'bail | required | uuid',
                'started_at'           => 'required',
                'ended_at'             => 'bail | required | after:started_at | after:yesterday',
                'partner_id'           => 'bail | required | uuid',
                'order_price'          => 'bail | required | integer | digits_between:1, 12',
                'delivery_date'        => 'required | after:started_at | after:yesterday',
                // 発注書
                'order_name'           => 'max:64',
                'order_company_user'   => 'max:64',
            ];
        } else{
            return [
                'project_id'           => 'bail | required | uuid',
                'task_company_user_id' => 'bail | required | uuid',
                'superior_id'          => 'bail | required | uuid',
                'accounting_id'        => 'bail | required | uuid',
                'started_at'           => 'required',
                'ended_at'             => 'bail | required | after:started_at | after:yesterday',
            ];
        }
    }

    public function attributes()
    {
        return [
            'yesterday' => '本日',
        ];
    }
}
