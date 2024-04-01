<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PracticalCourseResource\Pages;
use App\Filament\Resources\PracticalCourseResource\RelationManagers;
use App\Models\PracticalCourse;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\User;
use App\Models\Lab;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;


class PracticalCourseResource extends Resource
{
    protected static ?string $model = PracticalCourse::class;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';

    public static function shouldRegisterNavigation(): bool
    {
        if (auth()->user()->role === 'admin') {
            return true;
        } else {
            return false;
        }
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Class Name')
                    ->required()
                    ->maxLength(255),
                DateTimePicker::make('schedule'),
                Select::make('lab_id')
                ->label('Lab')
                ->options(function (): array {
                    return Lab::all()->pluck('name', 'id')->all();
                }),
                Select::make('lecturer_id')
                ->label('Lecturer')
                ->options(function (): array {
                    return User::where('role', 'dosen')->pluck('name', 'id')->all();
                }),
                RichEditor::make('description')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('schedule')->sortable()->searchable(),
                TextColumn::make('lab.name')->searchable(),
                TextColumn::make('lecturer.name')->searchable(),
                TextColumn::make('description')->html()
            ])
            ->filters([
                SelectFilter::make('lecturer_id')->relationship('lecturer', 'name'),
                SelectFilter::make('lab_id')->relationship('lab', 'name')


            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPracticalCourses::route('/'),
            'create' => Pages\CreatePracticalCourse::route('/create'),
            'edit' => Pages\EditPracticalCourse::route('/{record}/edit'),
        ];
    }
}
