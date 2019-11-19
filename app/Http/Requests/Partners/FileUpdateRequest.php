<?php

namespace App\Http\Requests\Partners;

use Illuminate\Foundation\Http\FormRequest;

class FileUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'task_id'         => 'required | uuid',
            'deliver_comment' => 'nullable | string | max:1000',
            'deliver_files.*' => 'nullable | max:100000'
        ];
    }
}