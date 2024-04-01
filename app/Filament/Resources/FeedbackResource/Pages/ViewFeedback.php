<?php

namespace App\Filament\Resources\FeedbackResource\Pages;

use App\Filament\Resources\FeedbackResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class ViewFeedback extends ViewRecord
{
    protected static string $resource = FeedbackResource::class;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->searchable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // ...
            ]);
    }
}
