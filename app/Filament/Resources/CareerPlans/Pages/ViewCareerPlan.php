<?php

namespace App\Filament\Resources\CareerPlans\Pages;

use App\Filament\Resources\CareerPlans\CareerPlanResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Actions\Action;

class ViewCareerPlan extends ViewRecord
{
    protected static string $resource = CareerPlanResource::class;

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Siswa')
                    ->schema([
                        TextEntry::make('student_name')->label('Nama Siswa'),
                        TextEntry::make('nis')->label('NIS'),
                       TextEntry::make('user.siswa.classRoom.full_name')
                        ->label('Kelas')
                        ->placeholder('-'),
                        TextEntry::make('graduation_year')->label('Tahun Kelulusan'),
                    ])
                    ->columns(2),

                Section::make('Detail Rencana Kuliah')
                    ->schema([
                        TextEntry::make('campus_name')->label('Nama Kampus'),
                        TextEntry::make('study_program')->label('Program Studi'),
                        TextEntry::make('entrance_year')->label('Tahun Masuk'),
                        TextEntry::make('target_university')->label('Universitas Tujuan'),
                        TextEntry::make('target_major')->label('Jurusan Tujuan'),
                    ])
                    ->columns(2)
                    ->hidden(fn ($record) => $record->category !== 'kuliah'),

                Section::make('Detail Rencana Kerja')
                    ->schema([
                        TextEntry::make('target_company')->label('Perusahaan Tujuan'),
                        TextEntry::make('target_position')->label('Posisi Tujuan'),
                        TextEntry::make('accepted_year')->label('Tahun Penerimaan'),
                    ])
                    ->columns(2)
                    ->hidden(fn ($record) => $record->category !== 'kerja'),

                Section::make('Detail Rencana Usaha')
                    ->schema([
                        TextEntry::make('business_type')->label('Jenis Usaha'),
                        TextEntry::make('business_name')->label('Nama Usaha'),
                        TextEntry::make('established_year')->label('Tahun Pendirian'),
                        TextEntry::make('business_idea')->label('Ide Usaha')->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->hidden(fn ($record) => $record->category !== 'usaha'),

                Section::make('Keterangan Lainnya')
                    ->schema([
                        TextEntry::make('description')->label('Deskripsi')->columnSpanFull(),
                    ])
                    ->hidden(fn ($record) => $record->category !== 'lainnya'),

                Section::make('Status')
                    ->schema([
                        TextEntry::make('status')->label('Status'),
                        TextEntry::make('submitted_at')->label('Waktu Submit')->dateTime(),
                    ])
                    ->columns(2),
            ]);
    }
    protected function getHeaderActions(): array
{
    return [
        Action::make('back')
            ->label('Kembali')
            ->url($this->getResource()::getUrl('index'))
            ->color('gray'),
    ];
}
}