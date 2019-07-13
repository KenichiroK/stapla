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
            'companyUser_id' => 'required',
            'project_name'   => 'required',
            'requested_at'   => 'required',
            'deadline_at'    => 'required',
            'tax'            => 'required',
        ];
    }

    public function messages()
    {
        return [
            'companyUser_id.required' => '担当者は必須項目です。',
            'project_name.required'   => '件名は必須項目です。',
            'requested_at.required'   => '請求日は必須項目です。',
            'deadline_at.required'    => '支払い期限は必須項目です。',
            'tax.required'            => '消費税は必須項目です。',
        ];
    }
}
