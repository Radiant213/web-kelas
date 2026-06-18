<?php

namespace App\Filament\Pages;

use App\Models\GeneralSetting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Filament\Notifications\Notification;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use BackedEnum;

class GeneralSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Pengaturan Umum';
    protected static ?string $title = 'Pengaturan Umum';
    protected string $view = 'filament.pages.general-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = GeneralSetting::first();
        if ($settings) {
            $this->form->fill($settings->attributesToArray());
        }
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)->schema([
                    Section::make('Hero (Halaman Depan)')
                        ->description('Pengaturan gambar banner di halaman utama.')
                        ->schema([
                            FileUpload::make('hero_image')
                                ->label('Hero Image')
                                ->image()
                                ->disk('s3')
                                ->directory('settings')
                                ->columnSpanFull(),
                        ])->columnSpan(1),

                    Section::make('Tentang Kami')
                        ->description('Pengaturan gambar bagian About Us.')
                        ->schema([
                            FileUpload::make('about_image')
                                ->label('About Image')
                                ->image()
                                ->disk('s3')
                                ->directory('settings')
                                ->columnSpanFull(),
                        ])->columnSpan(1),

                    Section::make('Wali Kelas')
                        ->description('Pengaturan foto dan kata mutiara dari wali kelas.')
                        ->schema([
                            FileUpload::make('teacher_image')
                                ->label('Foto Wali Kelas')
                                ->image()
                                ->disk('s3')
                                ->directory('settings')
                                ->columnSpanFull(),
                            Textarea::make('teacher_quote')
                                ->label('Kata-kata Mutiara')
                                ->rows(3)
                                ->columnSpanFull(),
                        ])->columnSpanFull(),
                ])
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        
        $settings = GeneralSetting::first();
        if (!$settings) {
            $settings = new GeneralSetting();
        }
        
        $settings->fill($data);
        $settings->save();

        Notification::make()
            ->success()
            ->title('Settings saved successfully')
            ->send();
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan Pengaturan')
                ->submit('save'),
        ];
    }
}
