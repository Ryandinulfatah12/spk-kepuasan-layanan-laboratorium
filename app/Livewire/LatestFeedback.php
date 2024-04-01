<?php

namespace App\Livewire;

use App\Models\Feedback;
use Filament\Tables;
use Mokhosh\FilamentRating\Components\Rating;
use Mokhosh\FilamentRating\Columns\RatingColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Services\FuzzyTsukamotoService;

class LatestFeedback extends BaseWidget
{
    protected function getTableQuery(): Builder
    {
        return Feedback::query()->latest();
    }
 
    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('user.name')->searchable(),
            TextColumn::make('course.name')->searchable(),
            TextColumn::make('course.lab.name')->searchable(),
            TextColumn::make('rating')->sortable()->searchable(),
            RatingColumn::make('rating'),
            TextColumn::make('level')->getStateUsing(function ($record) {
                $satisfaction = (new FuzzyTsukamotoService())->calculateSatisfaction($record->rating);
                return (new FuzzyTsukamotoService())->satisfactionLevel($satisfaction);
            })
        ];
    }
}
