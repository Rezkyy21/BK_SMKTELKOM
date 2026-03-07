<?php

namespace App\Filament\Resources\CareerPlans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CareerPlansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // always-visible core fields
                TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('category')
                    ->badge()
                    ->searchable(),
                TextColumn::make('student_name')
                    ->searchable(),
                TextColumn::make('nis')
                    ->searchable(),
                TextColumn::make('class_name')
                    ->searchable(),
                TextColumn::make('graduation_year')
                    ->numeric()
                    ->sortable(),

                // kuliah-specific
                TextColumn::make('campus_name')
                    ->searchable()
                    ->visible(fn ($record) => $record && $record->category === 'kuliah'),
                TextColumn::make('study_program')
                    ->searchable()
                    ->visible(fn ($record) => $record && $record->category === 'kuliah'),
                TextColumn::make('entrance_year')
                    ->numeric()
                    ->sortable()
                    ->visible(fn ($record) => $record && $record->category === 'kuliah'),
                TextColumn::make('target_university')
                    ->searchable()
                    ->visible(fn ($record) => $record && $record->category === 'kuliah'),
                TextColumn::make('target_major')
                    ->searchable()
                    ->visible(fn ($record) => $record && $record->category === 'kuliah'),

                // kerja-specific
                TextColumn::make('target_company')
                    ->searchable()
                    ->visible(fn ($record) => $record && $record->category === 'kerja'),
                TextColumn::make('target_position')
                    ->searchable()
                    ->visible(fn ($record) => $record && $record->category === 'kerja'),
                TextColumn::make('accepted_year')
                    ->numeric()
                    ->sortable()
                    ->visible(fn ($record) => $record && $record->category === 'kerja'),

                // usaha-specific
                TextColumn::make('business_type')
                    ->searchable()
                    ->visible(fn ($record) => $record && $record->category === 'usaha'),
                TextColumn::make('business_name')
                    ->searchable()
                    ->visible(fn ($record) => $record && $record->category === 'usaha'),
                TextColumn::make('established_year')
                    ->numeric()
                    ->sortable()
                    ->visible(fn ($record) => $record && $record->category === 'usaha'),

                // generic 
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('submitted_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                // summary column showing relevant fields when filter off
                TextColumn::make('summary')
                    ->label('Detail')
                    ->formatStateUsing(fn ($record) => !$record ? '-' : match ($record->category) {
                        'kuliah' => ($record->campus_name ?? '-') . ' | ' . ($record->study_program ?? '-') . ' | masuk:' . ($record->entrance_year ?? '-') . ' | tujuan:' . ($record->target_university ?? '-') . ' (' . ($record->target_major ?? '-') . ')',
                        'kerja' => ($record->target_company ?? '-') . ' | ' . ($record->target_position ?? '-') . ' | diterima:' . ($record->accepted_year ?? '-'),
                        'usaha' => ($record->business_type ?? '-') . ' | ' . ($record->business_name ?? '-') . ' | berdiri:' . ($record->established_year ?? '-'),
                        default => '-',
                    })
                    ->wrap(),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->options([
                        'kuliah' => 'Kuliah',
                        'kerja' => 'Kerja',
                        'usaha' => 'Usaha',
                        'lainnya' => 'Lainnya',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
