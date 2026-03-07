<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class KonselingStatusNotification extends Notification
{
    use Queueable;

    public Booking $booking;

    /**
     * Create a new notification instance.
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toDatabase($notifiable)
    {
        $status = $this->booking->status;
        $statusText = $status === 'disetujui' ? 'diterima' : ($status === 'ditolak' ? 'ditolak' : $status);

        return [
            'type' => 'booking_status',
            'booking_id' => $this->booking->id,
            'status' => $status,
            'message' => "Booking konseling Anda telah {$statusText}.",
        ];
    }

    /**
     * Mail representation.
     */
    public function toMail($notifiable)
    {
        $status = $this->booking->status;
        $statusText = $status === 'disetujui' ? 'diterima' : ($status === 'ditolak' ? 'ditolak' : $status);

        return (new \Illuminate\Notifications\Messages\MailMessage)
                    ->subject('Status Booking Konseling')
                    ->greeting("Halo {$notifiable->name},")
                    ->line("Booking konseling Anda telah {$statusText}.")
                    ->action('Lihat di Dashboard', url(route('siswa.konseling')))
                    ->line('Terima kasih telah menggunakan layanan kami.');
    }
}
