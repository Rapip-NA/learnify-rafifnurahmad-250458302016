<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ParticipantAnswer extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'competition_participant_id',
        'question_id',
        'answer_id',
        'is_correct',
        'time_spent',
        'answered_at',
        'score_earned',
        'verified_by',
        'validation_status',
    ];

    protected $casts = [
        'answered_at' => 'datetime',
        'score_earned' => 'decimal:2',
    ];

    public function competitionParticipant(): BelongsTo
    {
        return $this->belongsTo(CompetitionParticipant::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function answer(): BelongsTo
    {
        return $this->belongsTo(Answer::class);
    }

    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
