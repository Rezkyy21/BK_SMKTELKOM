<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingDiterimaNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Booking $booking)
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
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $guru = $this->booking->guruBk;
        $waLink = $guru->no_whatsapp
            ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $guru->no_whatsapp)
            : null;

        return (new MailMessage)
            ->subject('Booking Konseling Kamu Diterima!')
            ->greeting('Halo, ' . $notifiable->name . '!')
            ->line('Booking konseling kamu telah **diterima** oleh ' . $guru->nama . '.')
            ->line('Kamu bisa menghubungi guru BK via WhatsApp untuk mengatur tempat dan waktu.')
            ->when($waLink, fn($mail) => $mail->action('Chat via WhatsApp', $waLink))
            ->line('Terima kasih telah menggunakan layanan Web Konseling SMK Telkom Purwokerto.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        $guru = $this->booking->guruBk;
        $waLink = $guru->no_whatsapp
            ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $guru->no_whatsapp) . '?text=Halo ' . urlencode($guru->nama) . ', saya ingin mengkonfirmasi jadwal konseling.'
            : null;

        return [
            'type'       => 'booking_status',
            'message'    => 'Booking konseling kamu telah disetujui oleh ' . $guru->nama . '.',
            'booking_id' => $this->booking->id,
            'guru_nama'  => $guru->nama,
            'wa_link'    => $waLink,
        ];
    }
}
