<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Channels\DatabaseChannel;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

use App\Models\Task;
use App\Models\CompanyUser;
use App\Models\Partner;

class UpdatedTaskStatus extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Task $task, $status, $sendMail, $receiverIsPartner)
    {
        $this->task              = $task;
        $this->status            = $status;
        $this->sendMail          = $sendMail;
        $this->receiverIsPartner = $receiverIsPartner;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return $this->sendMail ? ['mail', DatabaseChannel::class] : [DatabaseChannel::class];
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
                    ->subject('[impro] 確認依頼 : '.$this->task->name)
                    ->markdown('emails.updated_task_status', [
                        'task'     => $this->task->name,
                        'receiver' => $this->receiverIsPartner ? Partner::findOrFail($notifiable->id)->name : CompanyUser::findOrFail($notifiable->id)->name,
                        'url'      => $this->receiverIsPartner ? url()->route('partner.task.show', ['id' => $this->task->id]) : url()->route('company.task.show', ['id' => $this->task->id])
                    ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return DatabaseMessage
     */
    public function toDatabase($notifiable)
    {
        return [
            'task'              => $this->task->name,
            'task_id'           => $this->task->id,
            'sender'            => Auth::user()->name,
            'status'            => $this->status,
            'receiverIsPartner' => $this->receiverIsPartner
        ];
    }
}
