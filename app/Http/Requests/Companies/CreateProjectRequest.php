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
            'project_name'     => 'required',
            'project_detail'   => 'required',
            'company_user_id'  => 'required',
            'superior_id'      => 'required',
            'accounting_id'    => 'required',
            'partner_id'       => 'required',
            'started_at'       => 'required',
            'ended_at'         => 'required | after:started_at',
            'budget'           => 'required | digits:10',
            'budget'           => 'required',
        ];
    }

    public function messages()
    {
        return [
            'project_name.required'     => 'プロジェクト名を入力してください',
            'project_detail.required'   => 'プロジェクト詳細を入力してください',
            'company_user_id.required'  => '担当者を選択してください',
            'superior_id.required'      => '上長を選択してください',
            'accounting_id.required'    => '経理を選択してください',
            'partner_id.required'       => 'パートナーを選択してください',
            'started_at.required'       => '開始日を選択してください',
            'ended_at.required'         => '終了日を正しく選択してください',
            'budget.required'           => '予算を入力してください',
        ];
    }
}
