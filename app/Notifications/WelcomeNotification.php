<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public string $message = null)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => __('ui.welcome_notification_title'),
            'message' => $this->message ?? __('ui.welcome_notification_message'),
            'type' => 'info',
            'action_url' => route('dashboard'),
            'action_text' => __('ui.go_to_dashboard')
        ];
    }
}
