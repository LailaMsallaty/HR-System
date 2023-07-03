<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Auth;
use App\EmpPunishment;

class ReceivePunishment extends Notification
{
    use Queueable;
    private $punishment;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(EmpPunishment  $punishment)
    {
        $this->punishment = $punishment;
    }

    public function via($notifiable)
    {
        return ['database'];
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */

    public function toDatabase($notifiable)
    {
        return [
            //'data' => $this->details['body']
            'id'=> $this->id,
            'title'=>'Receive_Punishment',
            'user'=> Auth::user()->employee->FName.' '.Auth::user()->employee->LName,
            'url'=> 'Employee_punishment.index'
        ];
    }
}
