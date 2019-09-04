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
            'task_name'       => 'required',
            'task_content'    => 'required',
            'company_user_id' => 'required',
            'superior_id'     => 'required',
            'accounting_id'   => 'required',
            'started_at_date' => 'required',
            'ended_at_date'   => 'required | after:started_at_date',
            'budget'          => 'required',
            'price'           => 'required',
            'cases'           => 'required | digits:10',
            'partner_id'      => 'required',
            'fee_format'      => 'required',
        ];
    }

    public function messages()
    {
        return [

            'project_id'      => 'プロジェクトを選択してください',
            'task_name'       => 'タスク名を入力してください',
            'task_content'    => 'タスク詳細を入力してください',
            'company_user_id' => '担当者を選択してください',
            'superior_id'     => '上長を選択してください',
            'accounting_id'   => '経理担当を選択してください',
            'started_at'      => '開始日を選択してください',
            'ended_at'        => '終了日を選択してください',
            'budget'          => '予算を入力してください',
            'price'           => '発注単価を入力してください',
            'cases'           => '発注件数を入力してください',
            'partner_id'      => 'パートナーを選択してください',
            'fee_format'      => '報酬形式を選択してください',
        ];
    }
}
