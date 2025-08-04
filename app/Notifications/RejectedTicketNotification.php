<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class RejectedTicketNotification extends Notification
{
    use Queueable;

    public function __construct(public string $reason) {}

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Ticket Rejected')
            ->line('Your ticket was rejected.')
            ->line('Reason: ' . $this->reason);
    }
}