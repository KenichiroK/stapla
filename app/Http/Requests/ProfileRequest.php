<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'nickname'     => 'required',
            'occupations'  => 'required',
            'introduction' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nickname.required'     => '名前 / ニックネームは必須項目です。',
            'occupations.required'  => '職種は必須項目です。',
            'introduction.required' => '自己紹介は必須項目です。',
        ];
    }
}
