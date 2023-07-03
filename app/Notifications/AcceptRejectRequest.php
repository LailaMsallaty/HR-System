<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\EmployeeRequests;
use Auth;
class AcceptRejectRequest extends Notification
{
    use Queueable;

    private $reply;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(EmployeeRequests $reply)
    {
        $this->reply = $reply;
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
            'title'=>'Accept_Reject_Request',
            'user'=> Auth::user()->employee->FName.' '.Auth::user()->employee->LName,
            'url'=> 'Send_Request.index'

        ];
    }
}
