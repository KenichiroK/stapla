<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailNotification;
use Illuminate\Notifications\Messages\MailMessage;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Lang;

class UserVerifyEmail extends VerifyEmailNotification
{
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable);
        }

        $limit = new Carbon($notifiable->created_at->addHour());
        return (new MailMessage)
            ->subject(Lang::getFromJson('[impro] 仮登録完了のお知らせ'))
            ->view('emails.invite.inviteCompanyUser', ['url' => $this->verificationUrl($notifiable), 'limit' => $limit]);
    }

    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'company.register', Carbon::now()->addMinutes(60), ['email' => $notifiable->email]
        );
    }
}
