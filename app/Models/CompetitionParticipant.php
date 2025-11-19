<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CompetitionParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'competition_id',
        'started_at',
        'finished_at',
        'total_score',
        'progress_percentage',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function competition(): BelongsTo
    {
        return $this->belongsTo(Competition::class);
    }

    public function participantAnswers(): HasMany
    {
        return $this->hasMany(ParticipantAnswer::class);
    }
}
