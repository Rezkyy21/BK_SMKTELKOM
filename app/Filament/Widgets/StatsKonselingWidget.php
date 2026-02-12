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
        return [
            Stat::make('Total Booking', Booking::query()->count())
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
