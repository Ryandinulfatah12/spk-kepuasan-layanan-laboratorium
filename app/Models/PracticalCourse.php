<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Lab;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PracticalCourse extends Model
{
    use HasFactory;

    public function lecturer(): BelongsTo{
        return $this->belongsTo(User::class, 'lecturer_id', 'id');
    }
    
    public function lab(): BelongsTo{
        return $this->belongsTo(Lab::class, 'lab_id', 'id');
    }
}
