<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Task;
use Auth;
class AcceptRejectTask extends Notification
{
    use Queueable;
    private $task;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Task $task )
    {
        $this->task = $task;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    public function toDatabase($notifiable)
    {
        return [
            'id'=> $this->id,
            'title'=>'Accept_Reject_Task',
            'user'=> Auth::user()->employee->FName.' '.Auth::user()->employee->LName,
            'url'=> 'Receive_Task.index'
        ];
    }
}
