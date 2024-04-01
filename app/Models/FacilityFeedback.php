<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Feedback;
use App\Models\Facility;

class FacilityFeedback extends Model
{
    use HasFactory;

    public function feedback(): BelongsTo{
        return $this->belongsTo(Feedback::class, 'feedback_id', 'id');
    }

    public function facility(): BelongsTo{
        return $this->belongsTo(Facility::class, 'facility_id', 'id');
    }
}
