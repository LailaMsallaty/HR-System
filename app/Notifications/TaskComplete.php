<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Employee;

class TaskComplete extends Notification
{
    use Queueable;
    private $employee;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
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
            'title'=>'Receive_Task',
            'user'=> $this->employee->FName.' '.$this->employee->LName,
            'url'=> 'Send_Task.index'
        ];
    }
}
