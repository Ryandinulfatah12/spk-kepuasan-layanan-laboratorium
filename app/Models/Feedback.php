<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\PracticalCourse;
use App\Models\FacilityFeedback;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Feedback extends Model
{
    use HasFactory;

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function course(): BelongsTo{
        return $this->belongsTo(PracticalCourse::class, 'course_id', 'id');
    }

    public function facility_feedback(): HasMany{
        return $this->hasMany(FacilityFeedback::class);
    }
}
