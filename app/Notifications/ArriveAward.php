<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\EmployeeAward;
use Auth;
class ArriveAward extends Notification
{
    use Queueable;
    private $award;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(EmployeeAward $award)
    {
        $this->award = $award;
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

    public function toDatabase($notifiable)
    {
        return [

            'id'=> $this->id,
            'title'=>'Send_Award',
            'user'=> Auth::user()->employee->FName.' '.Auth::user()->employee->LName,
            'url'=> 'Employee_Awards'

        ];
    }
}
