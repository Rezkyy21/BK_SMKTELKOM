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
        return [
            Stat::make('Jadwal Aktif', Jadwal::query()->where('is_active', true)->count())
                ->icon(Heroicon::OutlinedCalendarDays)
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
