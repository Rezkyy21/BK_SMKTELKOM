<?php

namespace App\Filament\Resources\ClassRooms\Pages;

use App\Filament\Resources\ClassRooms\ClassRoomResource;
use Filament\Actions\CreateAction;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ListRecords;
use App\Models\Major;
use App\Models\AcademicYear;
use App\Models\ClassRoom;
use Filament\Notifications\Notification;

class ListClassRooms extends ListRecords
{
    protected static string $resource = ClassRoomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            Action::make('addMultipleClasses')
                ->label('Tambah Kelas Massal')
                ->icon('heroicon-o-plus-circle')
                ->color('success')
                ->form([
                    Select::make('grade_level')
                        ->label('Tingkat')
                        ->options([
                            10 => '10',
                            11 => '11',
                            12 => '12',
                        ])
                        ->required(),
                    Select::make('major_id')
                        ->label('Jurusan')
                        ->options(Major::pluck('name', 'id'))
                        ->required(),
                    Select::make('academic_year_id')
                        ->label('Tahun Ajaran')
                        ->options(AcademicYear::pluck('name', 'id'))
                        ->required(),
                    TextInput::make('jumlah_tambah')
                        ->label('Tambah Berapa Kelas')
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(10)
                        ->default(1)
                        ->required(),
                ])
                ->action(function (array $data) {
                    $grade = $data['grade_level'];
                    $majorId = $data['major_id'];
                    $academicYearId = $data['academic_year_id'];
                    $count = $data['jumlah_tambah'];

                    $major = Major::find($majorId);
                    if (!$major) {
                        Notification::make()
                            ->title('Error')
                            ->body('Jurusan tidak ditemukan')
                            ->danger()
                            ->send();
                        return;
                    }

                    // Find the last class number for this grade and major
                    $lastClass = ClassRoom::where('grade_level', $grade)
                        ->where('major_id', $majorId)
                        ->where('academic_year_id', $academicYearId)
                        ->orderByRaw("CAST(SUBSTRING_INDEX(name, '-', -1) AS UNSIGNED) DESC")
                        ->first();

                    $lastNumber = 0;
                    if ($lastClass) {
                        // Extract number from name like "10 RPL-7" -> 7
                        $parts = explode('-', $lastClass->name);
                        if (count($parts) > 1) {
                            $lastNumber = (int) end($parts);
                        }
                    }

                    $classes = [];
                    for ($i = 1; $i <= $count; $i++) {
                        $newNumber = $lastNumber + $i;
                        $name = $grade . ' ' . $major->name . '-' . $newNumber;

                        // Check for duplicate
                        if (ClassRoom::where('grade_level', $grade)
                            ->where('major_id', $majorId)
                            ->where('name', (string)$newNumber)
                            ->where('academic_year_id', $academicYearId)
                            ->exists()) {
                            Notification::make()
                                ->title('Error')
                                ->body("Kelas {$grade} {$major->name}-{$newNumber} sudah ada")
                                ->danger()
                                ->send();
                            return;
                        }

                        $classes[] = [
                            'name' => (string)$newNumber,
                            'grade_level' => $grade,
                            'major_id' => $majorId,
                            'academic_year_id' => $academicYearId,
                        ];
                    }

                    ClassRoom::insert($classes);

                    Notification::make()
                        ->title('Berhasil')
                        ->body("{$count} kelas berhasil ditambahkan")
                        ->success()
                        ->send();

                    $this->redirect($this->getResource()::getUrl('index'));
                }),
        ];
    }
}
