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

class AssignedTask extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Task $task, $role)
    {
        $this->task = $task;
        $this->role = $role;
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
        return (new MailMessage)
                    ->subject('[impro] '.$this->task->name.'にアサインされました')
                    ->markdown('emails.assigned_task', [
                        'task'     => $this->task->name,
                        'receiver' => $this->role === config('consts.taskRole.PARTNER') ? Partner::findOrFail($notifiable->id)->name : CompanyUser::findOrFail($notifiable->id)->name,
                        'role'     => $this->role,
                        'url'      => $this->role === config('consts.taskRole.PARTNER') ? url()->route('partner.task.show', ['id' => $this->task->id]) : url()->route('company.task.show', ['id' => $this->task->id])
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
            'task'    => $this->task->name,
            'task_id' => $this->task->id,
            'sender'  => Auth::user()->name,
            'role'    => $this->role
        ];
    }
}
