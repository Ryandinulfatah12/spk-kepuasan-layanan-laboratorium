<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Feedback;
use App\Models\User;
use App\Models\PracticalCourse;


class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 2;
    protected static ?string $pollingInterval = '10s';
    protected function getStats(): array
    {
        // Hitung jumlah pengguna dengan peran 'dosen'
        $countDosen = User::where('role', 'dosen')->count();

        // Hitung jumlah pengguna dengan peran 'other'
        $countOther = User::where('role', 'other')->count();
        $totalFeedback = Feedback::count();
        $totalClass = PracticalCourse::count();

        return [
            Card::make('Total Feedback', $totalFeedback),
                // ->descriptionIcon('heroicon-s-trending-up'),
            Card::make('Active Practice Lab', $totalClass),
            Card::make('Total Dosen', $countDosen),
            Card::make('Total Mahasiswa', $countOther),
                // ->descriptionIcon('heroicon-s-trending-down'),
                // ->descriptionIcon('heroicon-s-trending-up'),
        ];
    }

    public static function canView(): bool
    {
        if (auth()->user()->role === 'admin') {
            return true;
        } else {
            return false;
        }
    }
}
