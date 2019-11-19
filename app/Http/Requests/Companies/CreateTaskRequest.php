<?php

namespace App\Http\Requests\Companies;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        switch ($this->input('temporarySaveOrPreview')){
            case 'toTemporarySave';
            case 'toTemporaryUpdate';
                return [
                    'project_id'      => 'bail | required | uuid',
                    'name'            => 'bail | required | string | max:64',
                    'content'         => 'nullable | bail | string | max:200',
                    'company_user_id' => 'nullable | uuid',
                    'superior_id'     => 'nullable | uuid',
                    'accounting_id'   => 'nullable | uuid',
                    'budget'          => 'nullable | bail | integer | digits_between:1, 12',
                    'price'           => 'nullable | bail | integer | digits_between:1, 12',
                    'partner_id'      => 'nullable | uuid',
                ];
            break;

            case 'toPreview';
                return [
                    'project_id'      => 'bail | required | uuid',
                    'name'            => 'bail | required | string | max:64',
                    'content'         => 'bail | required | string | max:200',
                    'company_user_id' => 'bail | required | uuid',
                    'superior_id'     => 'bail | required | uuid',
                    'accounting_id'   => 'bail | required | uuid',
                    'started_at'      => 'required',
                    'ended_at'        => 'bail | required | after:started_at',
                    'budget'          => 'bail | required | integer | digits_between:1, 12',
                    'price'           => 'bail | required | integer | digits_between:1, 12',
                    'partner_id'      => 'bail | required | uuid',
                ];
            break;
        }
    }

    public function attributes()
    {
        return [
            'name' => 'タスク名',
            'content' => 'タスク内容'
        ];
    }
}
