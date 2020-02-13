<?php

namespace App\Http\Requests\Partners\Document;

use Illuminate\Foundation\Http\FormRequest;

class OutsourceContractUpdateComment extends FormRequest
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
            'comment' => [
                'required',
                'max:3000'
            ],
        ];
    }

    public function attributes()
    {
        return [
            'id' => 'ID',
            'comment' => 'コメント',
        ];
    }

    public function messages()
    {
        return [
            'comment.required' => ':attributeを入力してください',
        ];
    }
}
