<?php

namespace App\Filament\Resources\Grades\Schemas;

use Filament\Schemas\Schema;

class GradeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('user_id')
                    ->label('Siswa')
                    ->options(\App\Models\Student::pluck('full_name', 'user_id'))
                    ->searchable()
                    ->required(),
                \Filament\Forms\Components\Select::make('subject_id')
                    ->label('Mata Pelajaran')
                    ->options(\App\Models\Subject::pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                \Filament\Forms\Components\TextInput::make('semester')
                    ->label('Semester')
                    ->numeric()
                    ->required(),
                \Filament\Forms\Components\TextInput::make('score')
                    ->label('Nilai')
                    ->numeric()
                    ->required(),
            ]);
    }
}
