<?php

namespace App\Filament\Resources\Laporans\Pages;

use App\Filament\Resources\Laporans\LaporanResource;
use App\Models\Booking;
use Filament\Resources\Pages\CreateRecord;

class CreateLaporan extends CreateRecord
{
    protected static string $resource = LaporanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Auto set guru_id from logged in guru
        $guruBk = auth()->user()->guruBk;
        if (!$guruBk) {
            throw new \Exception('User tidak memiliki data Guru BK yang valid');
        }

        $data['guru_id'] = $guruBk->id;
        $data['nama_guru'] = $guruBk->nama;

        // Auto set siswa_id from selected booking
        if (empty($data['siswa_id']) && !empty($data['booking_id'])) {
            $booking = Booking::with(['siswa.classRoom', 'topik', 'jadwal'])->find($data['booking_id']);
            if ($booking && $booking->siswa) {
                $data['siswa_id'] = $booking->siswa_id;
                $data['nama_siswa'] = $booking->siswa->nama;
                $data['nis'] = $booking->siswa->nis;
                $data['kelas'] = $booking->siswa->classRoom?->full_name ?? '-';
                $data['jenis_kelamin'] = $booking->siswa->jenis_kelamin;
                $data['topik'] = $booking->topik?->nama_topik;
                $data['jadwal'] = $booking->jadwal ? $booking->jadwal->hari . ' | ' . substr($booking->jadwal->jam_mulai, 0, 5) . ' - ' . substr($booking->jadwal->jam_selesai, 0, 5) : null;
            } else {
                throw new \Exception('Booking tidak ditemukan atau tidak memiliki data siswa');
            }
        }

        return $data;
    }

    protected function afterCreate(): void
    {
        // After Laporan is created, mark related booking as selesai
        // so siswa bisa melakukan booking baru.
        if (! $this->record->booking_id) {
            return;
        }

        $booking = Booking::find($this->record->booking_id);

        if (! $booking) {
            return;
        }

        // Restore kuota jadwal jika booking disetujui sebelumnya
        if ($booking->status === 'disetujui' && $booking->jadwal) {
            $booking->jadwal->increment('kuota');
        }

        // Mark booking as selesai
        $booking->update(['status' => 'selesai']);

        // Mark booking-related NOTIF as read (untuk menghilangkan toast "Booking Anda Telah Disetujui")
        if ($booking->siswa?->user) {
            $booking->siswa->user->unreadNotifications()
                ->where('data->type', 'booking_status')
                ->where('data->booking_id', $booking->id)
                ->get()
                ->each(fn ($notification) => $notification->markAsRead());
        }
    }
}
