<?php

namespace App\Http\Requests\Partners;

use Illuminate\Foundation\Http\FormRequest;

class PartnerNotificationRequest extends FormRequest
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
            'email_notification' => 'required',
            'daily_mail'         => 'required',
            'slack'              => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email_notification.required' => '通知メールの受信の設定は必須項目です。',
            'daily_mail.required'         => 'デイリーメールの受信の設定は必須項目です。',
            'slack.required'              => 'slack連携の設定は必須項目です。',
        ];
    }
}
