<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'answer_text',
        'is_correct',
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function participantAnswers(): HasMany
    {
        return $this->hasMany(ParticipantAnswer::class);
    }
}
