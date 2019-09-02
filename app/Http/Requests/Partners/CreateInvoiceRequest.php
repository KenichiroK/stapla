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
            'companyUser_id'      => 'required',
            'project_name'        => 'required',
            'requested_at'        => 'required',
            'deadline_at'         => 'required',
            'tax'                 => 'required',
            'item_name'           => 'required_with:item_num,item_unit_price,item_total',
            'item_num'            => 'required_with:item_name,item_unit_price,item_total',
            'item_unit_price'     => 'required_with:item_name,item_num,item_total',
            'item_total'          => 'required_with:item_name,item_num,item_unit_price',
            'expences_name'       => 'required_with:expences_num,expences_unit_price,expences_total',
            'expences_num'        => 'required_with:expences_name,expences_unit_price,expences_total',
            'expences_unit_price' => 'required_with:expences_name,expences_num,expences_total',
            'expences_total'      => 'required_with:expences_name,expences_num,expences_unit_price',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
