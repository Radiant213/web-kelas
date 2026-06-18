<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('username')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                TextInput::make('password')
                    ->password()
                    ->required(fn ($context) => $context === 'create')
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                    ->dehydrated(fn ($state) => filled($state))
                    ->revealable()
                    ->maxLength(255)
                    ->confirmed()
                    ->helperText('Biarkan kosong jika tidak ingin mengganti password'),
                TextInput::make('password_confirmation')
                    ->password()
                    ->required(fn ($context) => $context === 'create')
                    ->dehydrated(false)
                    ->revealable()
                    ->maxLength(255),
                Select::make('role')
                    ->required()
                    ->options([
                        'student' => 'Student',
                        'teacher' => 'Teacher',
                        'admin' => 'Admin',
                    ])
                    ->default('student')
                    ->native(false),
                
                \Filament\Schemas\Components\Section::make('Student Profile')
                    ->relationship('studentProfile')
                    ->schema([
                        TextInput::make('full_name')->required(),
                        TextInput::make('nickname'),
                        Select::make('gender')
                            ->options([
                                'L' => 'Laki-laki',
                                'P' => 'Perempuan',
                            ]),
                        TextInput::make('place_of_birth'),
                        \Filament\Forms\Components\DatePicker::make('date_of_birth'),
                        TextInput::make('origin_school'),
                        TextInput::make('child_number')->numeric(),
                        TextInput::make('address'),
                        Select::make('position')
                            ->label('Jabatan Kelas')
                            ->options([
                                'Ketua' => 'Ketua Kelas',
                                'Wakil' => 'Wakil Ketua',
                                'Sekertaris' => 'Sekertaris',
                                'Bendahara' => 'Bendahara',
                                'Tim IT' => 'Tim IT',
                                'Tim PDD' => 'Tim PDD',
                                'Anggota' => 'Anggota',
                            ])
                            ->searchable()
                            ->preload(),
                        TextInput::make('bio')->columnSpanFull(),
                    ])
            ]);
    }
}
