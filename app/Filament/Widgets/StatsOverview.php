<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Announcement;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Siswa', Student::count())
                ->description('Jumlah siswa terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),
            Stat::make('Total Mata Pelajaran', Subject::count())
                ->description('Mata pelajaran aktif')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('primary'),
            Stat::make('Total Pengumuman', Announcement::count())
                ->description('Pengumuman yang dibuat')
                ->descriptionIcon('heroicon-m-megaphone')
                ->color('warning'),
        ];
    }
}
