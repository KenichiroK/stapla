<?php

namespace App\Http\Requests\Partners;

use Illuminate\Foundation\Http\FormRequest;

class CreateInvoiceRequest extends FormRequest
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
            'company_user_id'       => 'required | uuid',
            'title'                 => 'required',
            'requested_at'          => 'required | date',
            'deadline_at'           => 'required | date',
            'tax'                   => 'required | boolean',
            'item_name.*'           => 'required_with:item_num.*,item_unit_price.*,item_total.*',
            'item_num.*'            => 'required_with:item_name.*,item_unit_price.*,item_total.*',
            'item_unit_price.*'     => 'required_with:item_name.*,item_num.*,item_total.*',
            'item_total.*'          => 'required_with:item_name.*,item_num.*,item_unit_price.*',
            'expences_name.*'       => 'required_with:expences_num.*,expences_unit_price.*,expences_total.*',
            'expences_num.*'        => 'required_with:expences_name.*,expences_unit_price.*,expences_total.*',
            'expences_unit_price.*' => 'required_with:expences_name.*,expences_num.*,expences_total.*',
            'expences_total.*'      => 'required_with:expences_name.*,expences_num.*,expences_unit_price.*',
            'amount'                => 'lte:task_taxIncludedBudget'

        ];
    }

    public function messages()
    {
        return [
            'amount.lte' => '請求額はタスクの予算内で作成して下さい。', 
        ];
    }

    public function attributes()
    {
        return [
            'title'                  => '件名',
            'item_name.*'            => 'タスク品目',
            'item_num.*'             => 'タスク数',
            'item_unit_price.*'      => 'タスク単価',
            'item_total.*'           => 'タスク合計金額',
            'expences_name.*'        => '経費品目',
            'expences_num.*'         => '経費数',
            'expences_unit_price.*'  => '経費単価',
            'expences_total.*'       => '経費合計金額',
        ];
    }
}
