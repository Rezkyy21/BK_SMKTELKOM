<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\GuruBk;
use App\Models\Siswa;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;


class StatsKonselingWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected ?string $heading = 'Konseling & Bimbingan';

    protected ?string $description = 'Ringkasan data bimbingan konseling.';

    protected function getStats(): array
    {
        $user = auth()->user();

        // bookings are scoped to the current user if possible
        $bookingQuery = Booking::query();
        if ($user) {
            if ($user->guruBk) {
                // count bookings for this guru's jadwal slots
                $bookingQuery->whereHas('jadwal', function ($q) use ($user) {
                    $q->where('guru_id', $user->guruBk->id);
                });
            } elseif ($user->siswa) {
                // count bookings made by this student
                $bookingQuery->where('siswa_id', $user->siswa->id);
            }
        }

        return [
            Stat::make('Total Booking', $bookingQuery->count())
                ->icon(Heroicon::OutlinedClipboardDocumentList)
                ->color('primary')
                ->description('Janji konseling'),
            Stat::make('Siswa', Siswa::query()->count())
                ->icon(Heroicon::OutlinedUserGroup)
                ->color('info')
                ->description('Siswa terdaftar'),
            Stat::make('Guru BK', GuruBk::query()->count())
                ->icon(Heroicon::OutlinedUserGroup)
                ->color('success')
                ->description('Guru bimbingan konseling'),
                
        ];
    }
}
