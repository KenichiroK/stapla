<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\Models\CompanyUser;

class RegisteredCompanyUser extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    // NOTE: 招待を送ったCompanyUser情報
    public function __construct(CompanyUser $companyUser)
    {
        $this->invitationUser = $companyUser;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->replyTo($notifiable->email, $notifiable->name)
            ->subject('[impro] '. $this->invitationUser->name. 'さんが担当者として登録完了しました')
            ->markdown('emails.invite.registeredCompanyUser', [
                'companyUserName' => $notifiable->name,
                'invitationUser' => $this->invitationUser,
                'url' => url()->route('company.setting.userSetting.create')
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * 
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
