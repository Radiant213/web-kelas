<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class StudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('full_name')
                    ->required(),
                TextInput::make('place_of_birth')
                    ->required(),
                DatePicker::make('date_of_birth')
                    ->required(),
                TextInput::make('origin_school')
                    ->required(),
                Textarea::make('address')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('city'),
                TextInput::make('child_number')
                    ->required()
                    ->numeric(),
                TextInput::make('nickname'),
                Select::make('gender')
                    ->options(['L' => 'L', 'P' => 'P']),
                TextInput::make('photo'),
                Textarea::make('bio')
                    ->columnSpanFull(),
                Toggle::make('is_completed')
                    ->required(),
                TextInput::make('github_url')
                    ->url(),
                TextInput::make('instagram_url')
                    ->url(),
                TextInput::make('tiktok_url')
                    ->url(),
                Textarea::make('programming_languages')
                    ->columnSpanFull(),
            ]);
    }
}
