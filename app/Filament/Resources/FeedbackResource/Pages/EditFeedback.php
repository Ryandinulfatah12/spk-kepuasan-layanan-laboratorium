<?php

namespace App\Filament\Resources\FeedbackResource\Pages;

use App\Filament\Resources\FeedbackResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\FacilityFeedback;
use Illuminate\Database\Eloquent\Model;

class EditFeedback extends EditRecord
{
    protected static string $resource = FeedbackResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $facilityFeedbacks = [];

        // Loop melalui data untuk memisahkan rating
        foreach ($data as $key => $value) {
            // Periksa jika kunci memiliki pola 'rating_X'
            if (strpos($key, 'rating_') === 0) {
                // Ambil ID fasilitas dari kunci
                $facilityId = substr($key, strlen('rating_'));

                // Masukkan entri baru ke dalam array facilityFeedbacks
                $facilityFeedbacks[] = [
                    'facility_id' => $facilityId,
                    'rating' => $value,
                ];

                // Hapus kunci rating dari data
                unset($data[$key]);
            }
        }

        FacilityFeedback::where('feedback_id',$record->id)->delete();

        foreach ($facilityFeedbacks as $dataFacilityFeedback) {
            // Simpan detail fasilitas ke dalam database
            $newFacilityFeedback = new FacilityFeedback();
            $newFacilityFeedback->feedback_id = $record->id;
            $newFacilityFeedback->facility_id = $dataFacilityFeedback['facility_id'];
            $newFacilityFeedback->rating = $dataFacilityFeedback['rating'];
            $newFacilityFeedback->save();
        }

        $record->update($data);

        return $record;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
