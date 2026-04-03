<?php

namespace App\Filament\Resources\CareerPlans\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class CareerPlanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Always visible core fields
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Select::make('category')
                    ->options(['kuliah' => 'Kuliah', 'kerja' => 'Kerja', 'usaha' => 'Usaha', 'lainnya' => 'Lainnya'])
                    ->live()
                    ->required(),
                TextInput::make('student_name'),
                TextInput::make('nis'),
                TextInput::make('class_name'),
                TextInput::make('graduation_year')
                    ->numeric(),

                // Kuliah-specific fields
                TextInput::make('campus_name')
                    ->hidden(fn (Get $get) => $get('category') !== 'kuliah'),
                TextInput::make('study_program')
                    ->hidden(fn (Get $get) => $get('category') !== 'kuliah'),
                TextInput::make('entrance_year')
                    ->numeric()
                    ->hidden(fn (Get $get) => $get('category') !== 'kuliah'),
                TextInput::make('target_university')
                    ->hidden(fn (Get $get) => $get('category') !== 'kuliah'),
                TextInput::make('target_major')
                    ->hidden(fn (Get $get) => $get('category') !== 'kuliah'),

                // Kerja-specific fields
                TextInput::make('target_company')
                    ->hidden(fn (Get $get) => $get('category') !== 'kerja'),
                TextInput::make('target_position')
                    ->hidden(fn (Get $get) => $get('category') !== 'kerja'),
                TextInput::make('accepted_year')
                    ->numeric()
                    ->hidden(fn (Get $get) => $get('category') !== 'kerja'),

                // Usaha-specific fields
                TextInput::make('business_type')
                    ->hidden(fn (Get $get) => $get('category') !== 'usaha'),
                TextInput::make('business_name')
                    ->hidden(fn (Get $get) => $get('category') !== 'usaha'),
                TextInput::make('established_year')
                    ->numeric()
                    ->hidden(fn (Get $get) => $get('category') !== 'usaha'),
                Textarea::make('business_idea')
                    ->columnSpanFull()
                    ->hidden(fn (Get $get) => $get('category') !== 'usaha'),

                // Lainnya-specific field
                Textarea::make('description')
                    ->columnSpanFull()
                    ->hidden(fn (Get $get) => $get('category') !== 'lainnya'),

                // Status and submission fields (always visible)
                Select::make('status')
                    ->options(['draft' => 'Draft', 'submitted' => 'Submitted'])
                    ->default('draft')
                    ->required(),
                DateTimePicker::make('submitted_at'),
            ]);
    }
}
