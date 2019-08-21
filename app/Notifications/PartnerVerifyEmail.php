<?php

namespace App\Notifications;

use App\Models\CompanyUser;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailNotification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Lang;

class PartnerVerifyEmail extends VerifyEmailNotification
{
    public function toMail($notifiable)
    {
        if(static::$toMailCallback){
            return call_user_func(static::$toMailCallback, $notifiable);
        }

         return (new MailMessage)
            ->subject(Lang::getFromJson('招待メール'))
            ->line(Lang::getFromJson('クリックしてimproへ登録してください.'))
            ->action(
                Lang::getFromJson('improを始める'),
                $this->verificationUrl($notifiable)
            )
            ->line(Lang::getFromJson('もしこのメールに覚えが無い場合は破棄してください。'));
    }

    protected function verificationUrl($notifiable)
    {
        // return $partnerAuth = Auth::user();
        // $company_id = CompanyUser::where('auth_id', $auth->id)->first()->company_id;

        return URL::temporarySignedRoute(
            'partner.verification.verify', Carbon::now()->addMinutes(60), ['id' => $notifiable->getKey(),]
            // 'partner.verification.verify', Carbon::now()->addMinutes(60), ['id' => $notifiable->getKey(), 'company_id' => $company_id , ]
        );
    }
}
