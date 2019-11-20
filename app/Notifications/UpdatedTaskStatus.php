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
    public function __construct(Task $task, $status, $receiverIsPartner, $needAction, $prevStatus = null, $nextActionUser = null)
    {
        $this->task              = $task;
        $this->status            = $status;
        $this->receiverIsPartner = $receiverIsPartner;
        $this->needAction        = $needAction;
        $this->prevStatus        = $prevStatus;
        $this->nextActionUser    = $nextActionUser;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', DatabaseChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return $this->needAction
            ? (new MailMessage)
                ->subject('[impro] 確認依頼 : '.$this->task->name)
                ->markdown('emails.updated_task_status', [
                    'task'     => $this->task->name,
                    'receiver' => $this->receiverIsPartner ? Partner::findOrFail($notifiable->id)->name : CompanyUser::findOrFail($notifiable->id)->name,
                    'url'      => $this->receiverIsPartner ? url()->route('partner.task.show', ['id' => $this->task->id]) : url()->route('company.task.show', ['id' => $this->task->id])
                ])
            : (new MailMessage)
                ->subject('[impro] '.$this->task->name.'のステータスが変更されました。')
                ->markdown('emails.updated_task_status_non_action', [
                    'task'             => $this->task->name,
                    'next_status'      => $this->status,
                    'receiver'         => $this->receiverIsPartner ? Partner::findOrFail($notifiable->id)->name : CompanyUser::findOrFail($notifiable->id)->name,
                    'url'              => $this->receiverIsPartner ? url()->route('partner.task.show', ['id' => $this->task->id]) : url()->route('company.task.show', ['id' => $this->task->id]),
                    'prev_status'      => $this->prevStatus,
                    'next_action_user' => $this->nextActionUser,
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
