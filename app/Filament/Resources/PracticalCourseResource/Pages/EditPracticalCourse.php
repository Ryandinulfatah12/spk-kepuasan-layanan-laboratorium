<?php

namespace App\Filament\Resources\PracticalCourseResource\Pages;

use App\Filament\Resources\PracticalCourseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPracticalCourse extends EditRecord
{
    protected static string $resource = PracticalCourseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
