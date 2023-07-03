<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\EmployeeSalary;
use App\Employee;
use Auth;
class SlipPaid extends Notification
{
    use Queueable;
    public $slip_id;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($slip_id)
    {
        $this->slip_id = $slip_id;
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
    // public function toMail($notifiable)
    // {
    //     $url = 'http://127.0.0.1:8000/print_slip/'.$this->slip_id;

    //     return (new MailMessage)
    //     ->greeting('Hello!')
    //     ->line('One of your Slips has been paid!')
    //     ->action('View Slip', $url)
    //     ->line('Thank you for using our Application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [

            //'data' => $this->details['body']
            'id'=> $this->id,
            'title'=>'Pay_Salary',
            'user'=> Auth::user()->employee->FName.' '.Auth::user()->employee->LName,
            'url'=> 'employeesalary.index'
        ];
    }
}
