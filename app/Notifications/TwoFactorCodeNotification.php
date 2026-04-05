<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TwoFactorCodeNotification extends Notification
{
    use Queueable;

    protected $code;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $code)
    {
        $this->code = $code;
    }

    /**
     * Get the notification's delivery channels.
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
        return (new MailMessage)
            ->subject('Kode Verifikasi Two-Factor Authentication')
            ->greeting('Halo, ' . $notifiable->name . '!')
            ->line('Anda telah meminta untuk mengaktifkan Two-Factor Authentication.')
            ->line('Berikut adalah kode verifikasi Anda:')
            ->line('**' . $this->code . '**')
            ->line('Kode ini akan kedaluwarsa dalam 10 menit.')
            ->line('Jika Anda tidak meminta kode ini, abaikan email ini.')
            ->salutation('Terima kasih, ' . config('app.name'));
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'code' => $this->code,
        ];
    }
}
