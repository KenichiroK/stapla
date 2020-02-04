<?php

namespace App\Notifications\Partner\Document;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\Models\Company;
use App\Models\Partner;
use App\Models\OutsourceContract;

class UpdateCommentOutsourceContract extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Company $company, Partner $partner, OutsourceContract $outSourceContract)
    {
        $this->company = $company;
        $this->partner = $partner;
        $this->outsourceContract = $outSourceContract;
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
            ->subject('契約書の提出が差し戻しされました')
            ->view('emails.partner.document.outsourceContract.updateComment', [
                'partnerName' => $this->partner->name,
                'companyName' => $this->company->company_name,
                'comment' => $this->outsourceContract->comment,
                'companyUserName' => $notifiable->name,
                'url' => url()->route('company.document.outsourceContracts.preview', ['outsource_contract_id' => $this->outsourceContract->id])
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
