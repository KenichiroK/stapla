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
            ->subject(Lang::getFromJson('本登録メール'))
            ->line(Lang::getFromJson('クリックして認証してください. {{ $company_user }}'))
            ->action(
                Lang::getFromJson('improを始める'),
                $this->verificationUrl($notifiable)
            )
            ->line(Lang::getFromJson('もしこのメールに覚えが無い場合は破棄してください。'));
            
    }

    protected function verificationUrl($notifiable)
    // $notifiable = 登録されたユーザーの情報が入っている。どこで飛ばしているのかは不明、たぶんModel(Partner.php)の
    // public function sendEmailVerificationNotification()
    // {
    //     $this->notify(new PartnerVerifyEmail);
    // }
    // の $this->notify(new PartnerVerifyEmail); かな？
    {
        // dd($notifiable);
        // return $notifiable->access_key;
        return URL::temporarySignedRoute(
        // ここではURLの有効期限、URLに乗せるデータを規定しているだけで、
        // URLの形自体はweb.phpの
        // Route::middleware('signed')->get('email/verify/{id}','Partners\Auth\VerificationController@verify')->name('partner.verification.verify');
        // で定めている。
            // 'partner.verification.verify', Carbon::now()->addMinutes(60), ['id' => $notifiable->getKey(), 'email' => $notifiable->email, 'access_key' => $notifiable->access_key]
            'partner.firstLogin', Carbon::now()->addMinutes(60), ['id' => $notifiable->getKey(), 'email' => $notifiable->email, 'company_id' => $notifiable->company_id]
            // 'partner.verification.verify'はおそらくnameの指定
        );
    }
}