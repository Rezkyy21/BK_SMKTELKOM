<?php

namespace App\Filament\Widgets;

use App\Models\Jadwal;
use App\Models\Materi;
use App\Models\Topik;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsKontenWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 2;

    protected ?string $heading = 'Jadwal & Konten';

    protected ?string $description = 'Jadwal konseling dan materi.';

    protected function getStats(): array
    {
        $user = auth()->user();

        $jadwalQuery = Jadwal::query()->where('is_active', true);
        if ($user && $user->guruBk) {
            $jadwalQuery->where('guru_id', $user->guruBk->id);
        } else {
            // non-guru users shouldn't see global jadwal count
            $jadwalQuery->whereRaw('1 = 0');
        }

        return [
           Stat::make('Jadwal Aktif', Jadwal::count())
                ->icon(Heroicon::OutlinedCalendar)
                ->color('warning')
                ->description('Slot jadwal tersedia'),
            Stat::make('Materi', Materi::query()->count())
                ->icon(Heroicon::OutlinedBookOpen)
                ->color('primary')
                ->description('Materi publish + draft'),
            Stat::make('Topik', Topik::query()->where('is_active', true)->count())
                ->icon(Heroicon::OutlinedClipboardDocumentList)
                ->color('success')
                ->description('Topik konseling aktif'),
        ];
    }
}
