<?php

namespace App\Notifications\Company\Document;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\Models\Company;
use App\Models\OutsourceContract;

class RequestConfirmOutsourceContract extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Company $company, OutsourceContract $outSourceContract)
    {
        $this->company = $company;
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
            ->subject('企業より契約書の確認依頼がありました')
            ->view('emails.company.document.outsourceContract.requestConfirm', [
                'partnerName' => $notifiable->name,
                'companyName' => $this->company->company_name,
                'url' => url()->route('partner.document.outsourceContracts.edit', ['outsource_contract_id' => $this->outsourceContract->id])
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
