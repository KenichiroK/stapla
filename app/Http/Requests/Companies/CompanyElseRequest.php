<?php

namespace App\Http\Requests\Companies;

use Illuminate\Foundation\Http\FormRequest;

class CompanyElseRequest extends FormRequest
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
            'approval_setting'   => 'required | in:"1", "0"',
            'income_tax_setting' => 'required | in:"1", "0"',
            'remind_setting'     => 'required | in:"1", "0"',
        ];
    }
}
