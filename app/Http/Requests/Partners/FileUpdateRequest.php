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
            'deliver_comment' => 'sometimes | string | max:200',
            'deliver_files.*' => 'sometimes | max:100000'
        ];
    }
}
