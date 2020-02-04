<?php

namespace App\Http\Requests\Companies\Document;

use Illuminate\Foundation\Http\FormRequest;

class OutsourceContractUpdateStatus extends FormRequest
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
            'id' => [
                'required',
                'uuid',
            ],
            'status' => [
                'required',
                'in:uncontracted,progress,complete'
            ],
        ];
    }

    public function attributes()
    {
        return [
            'id' => 'ID',
            'status' => 'ステータス',
        ];
    }
}
