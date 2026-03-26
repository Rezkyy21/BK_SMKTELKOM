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
public ?string $alasan;

    /**
     * Create a new notification instance.
     */
   public function __construct(Booking $booking, $alasan = null)
{
    $this->booking = $booking;
    $this->alasan = $alasan;
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

    $mail = (new \Illuminate\Notifications\Messages\MailMessage)
        ->subject('Status Booking Konseling')
        ->greeting("Halo {$notifiable->name},")
        ->line("Booking konseling Anda telah {$statusText}.");

    if ($status === 'ditolak' && $this->alasan) {
        $mail->line("Alasan penolakan: {$this->alasan}");
    }

    return $mail
        ->action('Lihat di Dashboard', url(route('siswa.konseling')))
        ->line('Terima kasih telah menggunakan layanan kami.');
}
}
