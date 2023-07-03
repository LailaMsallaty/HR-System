<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Employee;
class ArriveLeave extends Notification
{
    use Queueable;
    private $employee;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Employee $employee )
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

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [

            'id'=> $this->id,
            'title'=>'Receive_Leave',
            'user'=> $this->employee->FName.' '.$this->employee->LName,
            'url'=> 'Employee_Leave_Requests'

        ];
    }
}
