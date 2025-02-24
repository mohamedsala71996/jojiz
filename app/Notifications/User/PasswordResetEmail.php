<?php

namespace App\Notifications\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordResetEmail extends Notification
{
    use Queueable;
    public $user;
    public $password_reset;
    /**
     * Create a new notification instance.
     */
    public function __construct($user,$password_reset)
    {
        $this->user = $user;
        $this->password_reset = $password_reset;
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
        $user = $this->user;
        $password_reset = $this->password_reset;

        return (new MailMessage)
                    ->greeting("Hello ".$user->fullname." !")
                    ->subject("Verification Code (Password Reset)")
                    ->line('You trying to reset your password.')
                    ->line("Here is your OTP " . $password_reset->code)
                    ->action('Verify', route('user.otp.verify.form',$password_reset->token))
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
