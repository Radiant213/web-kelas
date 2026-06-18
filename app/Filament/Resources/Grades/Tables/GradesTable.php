<?php

namespace App\Filament\Resources\Grades\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class GradesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('user.studentProfile.full_name')
                    ->label('Siswa')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('subject.name')
                    ->label('Mata Pelajaran')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('semester')
                    ->label('Semester')
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('score')
                    ->label('Nilai')
                    ->sortable(),
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('user_id')
                    ->label('Filter Siswa')
                    ->options(\App\Models\Student::pluck('full_name', 'user_id'))
                    ->searchable(),
                \Filament\Tables\Filters\SelectFilter::make('semester')
                    ->label('Filter Semester')
                    ->options([
                        1 => 'Semester 1',
                        2 => 'Semester 2',
                        3 => 'Semester 3',
                        4 => 'Semester 4',
                        5 => 'Semester 5',
                        6 => 'Semester 6',
                    ]),
            ])
            ->groups([
                \Filament\Tables\Grouping\Group::make('semester')
                    ->label('Semester')
                    ->collapsible(),
            ])
            ->defaultGroup('semester')
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
