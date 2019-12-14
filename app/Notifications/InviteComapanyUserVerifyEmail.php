<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailNotification;
use Illuminate\Notifications\Messages\MailMessage;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Lang;

class InviteComapanyUserVerifyEmail extends VerifyEmailNotification
{
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable);
        }

        $limit = new Carbon($notifiable->created_at->addHour());
        return (new MailMessage)
            ->subject(Lang::getFromJson('[impro] 企業担当者へ招待されました'))
            ->view('emails.invite.inviteCompanyUser', ['url' => $this->verificationUrl($notifiable), 'limit' => $limit]);
    }


    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'company.register', Carbon::now()->addMinutes(60), [
                'email' => $notifiable->email,
                'company_id' => $notifiable->company_id,
                'invitation_user_id' => $notifiable->invitation_user_id
            ]
        );
    }
}
