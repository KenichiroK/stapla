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
            'company_user_id'       => 'bail | required | uuid',
            'title'                 => 'required',
            'requested_at'          => 'bail | required | date',
            'deadline_at'           => 'bail | required | date',
            // 'tax'                   => 'bail | required | boolean',
            'item_name.*'           => 'bail | required_with:item_num.*,item_unit_price.*,item_total.*',
            'item_num.*'            => 'bail | required_with:item_name.*,item_unit_price.*,item_total.* | digits_between:1, 10',
            'item_unit_price.*'     => 'bail | required_with:item_name.*,item_num.*,item_total.* | digits_between:1, 10',
            'item_total.*'          => 'bail | required_with:item_name.*,item_num.*,item_unit_price.* | digits_between:1, 10',
            // 'expences_name.*'       => 'bail | required_with:expences_num.*,expences_unit_price.*,expences_total.*',
            'expences_num.*'        => 'bail | nullable | digits_between:1, 10 | required_with:expences_name.*',
            'expences_unit_price.*' => 'bail | nullable | numeric | required_with:expences_name.*',
            'expences_total.*'      => 'bail | nullable | numeric | required_with:expences_name.*',
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
