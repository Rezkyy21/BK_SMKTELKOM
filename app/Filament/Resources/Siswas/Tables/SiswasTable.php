<?php

namespace App\Filament\Resources\Siswas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\FileUpload;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SiswaImport;

class SiswasTable
{
    public static function configure(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('nis')->label('NIS')->searchable()->sortable(),
            TextColumn::make('nama')->label('Nama')->searchable()->sortable(),
            TextColumn::make('user.email')->label('Email')->searchable()->sortable(),
            BadgeColumn::make('user.status_akun')->label('Status')->colors([
                'success' => 'aktif',
                'danger' => 'nonaktif',
            ])->sortable(),
           TextColumn::make('classRoom.full_name')
                ->label('Kelas')
                ->sortable()
                ->placeholder('-'),

          TextColumn::make('academicYear.name')
                ->label('Tahun Ajaran')
                ->sortable()
                ->placeholder('-'),
        ])
        ->filters([
            SelectFilter::make('status_akun')
                ->label('Status Akun')
                ->options([
                    'aktif' => 'Aktif',
                    'nonaktif' => 'Nonaktif',
                ])
                ->query(function (Builder $query, $data) {
                    if (!$data['value']) {
                        return $query;
                    }

                    return $query->whereHas('user', function ($q) use ($data) {
                        $q->where('status_akun', $data['value']);
                    });
                }),
        ])
        ->recordActions([
            EditAction::make(),
            Action::make('deactivate')
                ->label('Nonaktifkan')
                ->requiresConfirmation()
                ->visible(fn($record) => $record->user?->status_akun === 'aktif')
                ->action(fn($record) => $record->user?->update(['status_akun' => 'nonaktif'])),

            Action::make('activate')
                ->label('Aktifkan')
                ->requiresConfirmation()
                ->visible(fn($record) => $record->user?->status_akun === 'nonaktif')
                ->action(fn($record) => $record->user?->update(['status_akun' => 'aktif'])),
        ])
        ->toolbarActions([
            Action::make('download_template')
                ->label('Download Template')
                ->url(route('filament.siswa.template')),

            Action::make('import_siswa')
                ->label('Import Siswa')
                ->form([
                    FileUpload::make('file')
                        ->disk('local')
                        ->directory('imports')
                        ->required(),
                ])
                ->action(function (array $data) {
                    if (empty($data['file'])) {
                        return;
                    }

                    $path = $data['file'];

                    Excel::import(new SiswaImport(), $path);
                }),

            BulkActionGroup::make([
                DeleteBulkAction::make(),
            ]),
        ]);
}
}
