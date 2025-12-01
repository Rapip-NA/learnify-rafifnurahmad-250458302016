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
        'essay_answer_text',
        'is_correct',
        'time_spent',
        'answered_at',
        'score_earned',
        'verified_by',
        'validation_status',
        'grading_status',
        'graded_at',
        'grading_notes',
    ];

    protected $casts = [
        'answered_at' => 'datetime',
        'graded_at' => 'datetime',
        'score_earned' => 'decimal:2',
    ];

    /**
     * Check if the answer is pending grading
     */
    public function isPending(): bool
    {
        return $this->grading_status === 'pending';
    }

    /**
     * Scope to get pending grading answers
     */
    public function scopePendingGrading($query)
    {
        return $query->where('grading_status', 'pending');
    }

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
