<?php

namespace App\Filament\Resources\FeedbackResource\Pages;

use App\Filament\Resources\FeedbackResource;
use Filament\Actions;
use App\Models\Feedback;
use App\Models\FacilityFeedback;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\CreateAction;
use Illuminate\Database\Eloquent\Model;

class CreateFeedback extends CreateRecord
{
    protected static string $resource = FeedbackResource::class;

    protected static bool $canCreateAnother = false;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Tambahkan user_id langsung ke dalam data
        $data['user_id'] = auth()->id();

        return $data;
    }
}
