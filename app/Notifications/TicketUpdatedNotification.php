<?php


namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class TicketUpdatedNotification extends Notification
{
    use Queueable;

    public function __construct(public string $status) {}

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Ticket Status Updated')
            ->line('The ticket status is now: ' . $this->status);
    }
}