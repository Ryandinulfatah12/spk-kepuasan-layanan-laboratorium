<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\FeedbackResource\Pages\ViewFeedback;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Services\FuzzyTsukamotoService;
use App\Models\Feedback;
use App\Models\FacilityFeedback;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;


class LatestFeedback extends BaseWidget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';
    protected static ?string $pollingInterval = '10s';

    public function table(Table $table): Table
    {
        return $table
        ->query(
            Feedback::where('user_id', auth()->user()->id)->latest()

            // if (auth()->user()->role !== 'admin') {
            //     Feedback::where('user_id', auth()->user()->id)
            //                             ->whereYear('created_at', date('Y'))->get();
            // } else {
            //     Feedback::whereYear('created_at', date('Y'))->get();
            // }

            )
            ->columns([
                TextColumn::make('user.name')->searchable(),
                TextColumn::make('course.name')->searchable(),
                TextColumn::make('course.lab.name')->searchable(),
                TextColumn::make('level')->getStateUsing(function ($record) {
                    // Ambil data dari tabel FacilityFeedback
                    $facilityFeedbacks = FacilityFeedback::where('feedback_id', $record->id)->get();

                    // Inisialisasi array untuk menyimpan nilai rating
                    $ratings = [];

                    // Masukkan nilai rating dari $record->rating ke dalam array
                    $ratings[] = $record->rating;

                    // Iterasi melalui data FacilityFeedback dan masukkan nilai rating ke dalam array
                    foreach ($facilityFeedbacks as $facilityFeedback) {
                        $ratings[] = $facilityFeedback->rating;
                    }
                    return (new FuzzyTsukamotoService())->calculateSatisfactionArray($ratings);
                }),
                TextColumn::make('satisfaction')->getStateUsing(function ($record) {
                    // Ambil data dari tabel FacilityFeedback
                    $facilityFeedbacks = FacilityFeedback::where('feedback_id', $record->id)->get();

                    // Inisialisasi array untuk menyimpan nilai rating
                    $ratings = [];

                    // Masukkan nilai rating dari $record->rating ke dalam array
                    $ratings[] = $record->rating;

                    // Iterasi melalui data FacilityFeedback dan masukkan nilai rating ke dalam array
                    foreach ($facilityFeedbacks as $facilityFeedback) {
                        $ratings[] = $facilityFeedback->rating;
                    }
                    $satisfaction = (new FuzzyTsukamotoService())->calculateSatisfactionArray($ratings);
                    return (new FuzzyTsukamotoService())->satisfactionLevel($satisfaction);
                })
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'Average' => 'warning',
                    'Excellent' => 'success',
                    'Poor' => 'danger',
                }),
            ])
            ->actions([
                // ViewFeedback::route('/{record}'),
            ]);
    }
}
// protected int | string | array $columnSpan = 'full';
