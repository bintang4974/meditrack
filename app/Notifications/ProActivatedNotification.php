<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProActivatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Langganan Pro Berhasil Aktif 🎉')
            ->greeting('Halo, ' . $notifiable->name)
            ->line('Terima kasih telah berlangganan Akun Pro!')
            ->line('Akses Pro Anda berlaku selama 30 hari.')
            ->action('Kunjungi Dashboard', url('/dashboard'))
            ->line('Selamat menikmati fitur premium tanpa batas!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Langganan Pro Aktif',
            'message' => 'Akun Pro Anda telah aktif dan berlaku 30 hari ke depan.',
        ];
    }
}
