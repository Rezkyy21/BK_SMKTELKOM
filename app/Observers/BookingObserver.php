<?php

namespace App\Observers;

use App\Models\Booking;
use App\Notifications\KonselingBookedNotification;
use App\Notifications\KonselingStatusNotification;

class BookingObserver
{
    /**
     * Handle the Booking "created" event.
     */
    public function created(Booking $booking): void
    {
        // notify guru associated with the jadwal
        if ($booking->jadwal && $booking->jadwal->guru && $booking->jadwal->guru->user) {
            $guruUser = $booking->jadwal->guru->user;
            $guruUser->notify(new KonselingBookedNotification($booking));
        }
    }

    /**
     * Handle the Booking "updated" event.
     */
    public function updated(Booking $booking): void
    {
        if ($booking->isDirty('status')) {
            $old = $booking->getOriginal('status');
            $new = $booking->status;

            // Send notification when status changes to disetujui or ditolak
            if (in_array($new, ['disetujui', 'ditolak']) && $old === 'menunggu') {
                // Load siswa relationship with user
                $booking->load('siswa.user');
                
                if ($booking->siswa && $booking->siswa->user) {
                    \Log::info("Sending notification to siswa user: {$booking->siswa->user->id} for booking {$booking->id}");
                    $booking->siswa->user->notify(new KonselingStatusNotification($booking));
                } else {
                    \Log::error("Failed to get siswa user for booking {$booking->id}");
                }
            }

            // When booking is approved, reduce jadwal quota
            if ($new === 'disetujui' && $old !== 'disetujui') {
                if ($booking->jadwal) {
                    $booking->jadwal->decrement('kuota');
                }
            }

            // When booking is rejected/cancelled, restore jadwal quota
            if (in_array($new, ['ditolak', 'dibatalkan']) && $old === 'disetujui') {
                if ($booking->jadwal) {
                    $booking->jadwal->increment('kuota');
                }
            }
        }
    }
}
