<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeedbackResource\Pages;
use App\Filament\Resources\FeedbackResource\Pages\ViewFeedback;
use App\Filament\Resources\FeedbackResource\RelationManagers;
use App\Infolists\Components\StarsEntry;
use App\Models\Feedback;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\PracticalCourse;
use App\Models\FacilityFeedback;
use App\Models\Facility;
// use Yepsua\Filament\Forms\Components\Rating;
// use Yepsua\Filament\Tables\Components\RatingColumn;
use Mokhosh\FilamentRating\Components\Rating;
use Mokhosh\FilamentRating\Columns\RatingColumn;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use App\Services\FuzzyTsukamotoService;
use Filament\Actions\ViewAction;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Mokhosh\FilamentRating\Entries\RatingEntry;

class FeedbackResource extends Resource
{
    protected static ?string $model = Feedback::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-arrow-down';

    public static function form(Form $form): Form
    {
        $facilities = Facility::all()->pluck('name', 'id')->all();
        $formSchema = [
            Select::make('course_id')
                ->label('Mata Kuliah')
                ->options(function (): array {
                    return PracticalCourse::all()->pluck('name', 'id')->all();
                }),
                RichEditor::make('comment')->label('Kesan dan Pesan')->columnSpan('full'),
                Rating::make('rating')
                        ->hidden(fn (string $operation) : bool => $operation == 'create' )
                        ->allowZero()
                        ->label('Overall Rating')
                        ->helperText('Nilai 1-5 untuk keseluruhan fasilitas.'),
        ];
        foreach ($facilities as $facilityId => $facilityName) {
            $facility = Facility::find($facilityId);
            $formSchema[] = Rating::make("rating_$facilityId")
                ->label($facilityName)
                ->allowZero()
                ->hidden(fn (string $operation) : bool => $operation == 'create' )
                ->helperText($facility ? $facility['description'] : "");
        }

        return $form->schema($formSchema);
    }

    public static function table(Table $table): Table
    {
        return $table
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
                TextColumn::make('comment')->html(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // FeedbackResource::getPages()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->recordUrl(null)
            ->defaultSort('created_at', 'desc');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
        ->schema([
            Section::make('Kuisioner User Info')
            ->columns([
                'sm' => 1,
                'xl' => 2,
                '2xl' => 4,
            ])
            ->schema([
                TextEntry::make('user.name')->label('Feedback Created By'),
                TextEntry::make('created_at')->label('Feedback Created By'),
                TextEntry::make('level')->getStateUsing(function ($record) {
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
                TextEntry::make('satisfaction')->getStateUsing(function ($record) {
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
                TextEntry::make('comment')->html(),
            ]),
            Section::make('Laboratorium Practice Info')
            ->columns([
                'sm' => 1,
                'xl' => 2,
                '2xl' => 3,
            ])
            ->schema([
                TextEntry::make('course.name'),
                TextEntry::make('course.lecturer.name')->label('Lecturer'),
                TextEntry::make('course.schedule')->label('Practice Schedule'),
                TextEntry::make('course.description')->label('Description Class')->html(),
                TextEntry::make('course.lab.name')->label('Laboratorium'),
            ]),
            Section::make('Rating Kamu')
            ->schema([
                RepeatableEntry::make('facility_feedback')
                ->schema([
                    TextEntry::make('facility.name'),
                    RatingEntry::make('rating'),
                ])->grid(4),
            ]),

        ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeedback::route('/'),
            'create' => Pages\CreateFeedback::route('/create'),
            'view' => Pages\ViewFeedback::route('/{record}'),
            'edit' => Pages\EditFeedback::route('/{record}/edit'),
        ];
    }
}
