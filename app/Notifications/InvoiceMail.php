<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoiceMail extends Notification
{
    use Queueable;
    protected $data;
    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $user = $notifiable;
        $data = $this->data;
        // dd($user, $data);
        return (new MailMessage)
            ->greeting("Hello , $user->display_name !")
            ->subject('New Order Have Arrived')
            ->line($data->user->name.' have placed order.')
            ->line("The invoice is : $data->invoiceID")
            ->line("Total Amount: $data->total")
            ->line("Paid Amount : $data->paidAmount")
            ->line("Due Amount : ".($data->total - $data->paidAmount))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
