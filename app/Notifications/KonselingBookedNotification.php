<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class KonselingBookedNotification extends Notification
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
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // send both database and email notifications
        return ['database', 'mail'];
    }

    /**
     * Get the array representation of the notification for the database channel.
     *
     * @param  mixed  $notifiable
     * @return array|
     */
    public function toDatabase($notifiable)
    {
        $siswaName = $this->booking->siswa?->nama
            ?? $this->booking->siswa?->user?->name
            ?? 'Siswa';

        return [
            'type' => 'booking_created',
            'booking_id' => $this->booking->id,
            'message' => "Permintaan konseling baru dari {$siswaName} pada tanggal {$this->booking->tanggal}.",
        ];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $siswaName = $this->booking->siswa?->nama
            ?? $this->booking->siswa?->user?->name
            ?? 'Siswa';

        return (new \Illuminate\Notifications\Messages\MailMessage)
                    ->subject('Booking Konseling Baru')
                    ->greeting("Halo {$notifiable->name},")
                    ->line("Anda memperoleh permintaan konseling baru dari {$siswaName} pada tanggal {$this->booking->tanggal}.")
                    ->action('Lihat Detail', url(route('guru.dashboard')))
                    ->line('Terima kasih telah menggunakan layanan kami.');
    }
}
