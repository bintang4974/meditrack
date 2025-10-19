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
    protected $payment;
    public function __construct($payment = null)
    {
        $this->payment = $payment;
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
        $msg = (new MailMessage)
            ->subject('Akun Pro Aktif')
            ->line('Terima kasih, langganan Anda telah aktif.')
            ->line('Order ID: ' . ($this->payment->order_id ?? '-'))
            ->line('Jumlah: Rp' . number_format($this->payment->amount ?? 0, 0, ',', '.'))
            ->line('Masa aktif sampai: ' . ($notifiable->subscription_ends_at?->format('d F Y') ?? '-'));
        return $msg;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Langganan Pro Anda aktif',
            'order_id' => $this->payment->order_id ?? null,
            'amount' => $this->payment->amount ?? null,
        ];
    }
}
