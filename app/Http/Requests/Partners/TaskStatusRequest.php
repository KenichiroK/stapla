<?php

namespace App\Http\Requests\Partners;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PartnerTaskStatus;

class TaskStatusRequest extends FormRequest
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
            'task_id' => 'required | uuid',
            'status'  => new PartnerTaskStatus(),
        ];
    }

    public function messages()
    {
        return [
            'task_id.required' => '問題が発生しました。時間を置いて再度お試しください。',
            'task_id.uuid'     => '問題が発生しました。時間を置いて再度お試しください。',
        ];
    }
}
