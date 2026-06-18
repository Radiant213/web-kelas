<?php

namespace App\Filament\Resources\ClassStructures;

use App\Filament\Resources\ClassStructures\Pages\ManageClassStructures;
use App\Models\ClassStructure;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use App\Models\User;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ClassStructureResource extends Resource
{
    protected static ?string $model = ClassStructure::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $modelLabel = 'Struktur Kelas';
    protected static ?string $pluralModelLabel = 'Struktur Kelas';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('student_username')
                    ->label('Siswa / Pengurus')
                    ->options(\App\Models\Student::pluck('full_name', 'username'))
                    ->searchable(),
                TextInput::make('role')
                    ->required(),
                TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student_username')
                    ->searchable(),
                TextColumn::make('role')
                    ->searchable(),
                TextColumn::make('order')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageClassStructures::route('/'),
        ];
    }
}
