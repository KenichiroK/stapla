<?php

namespace App\Http\Requests\Companies;

use Illuminate\Foundation\Http\FormRequest;

class CreatePurchaseOrderRequest extends FormRequest
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
            'task_name'            => 'required',
            'task_ended_at'        => 'required',
            // 'task_delivery_format' => 'required',
            // 'companyUser_id'       => 'required',
        ];
    }

    public function messages()
    {
        return [
            'task_id'              => "タスクを選択してください。",
            'task_name'            => "タスク名を入力してください。",
            'task_ended_at'        => "納品日を選択してください。",
            // 'task_delivery_format' => "納品日を選択してください。",
            // 'companyUser_id'       => "担当者を選択してください。",
            'partner_id'           => "パートナーを選択してください。",
        ];
    }
}
