<?php

namespace App\Filament\Resources\PracticalCourseResource\Pages;

use App\Filament\Resources\PracticalCourseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPracticalCourses extends ListRecords
{
    protected static string $resource = PracticalCourseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
