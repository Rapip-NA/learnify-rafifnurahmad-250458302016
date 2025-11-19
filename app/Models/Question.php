<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'competition_id',
        'category_id',
        'question_text',
        'difficulty_level',
        'point_weight',
        'verified_by',
        'validation_status',
    ];

    protected $casts = [
        'point_weight' => 'integer',
    ];

    public function competition(): BelongsTo
    {
        return $this->belongsTo(Competition::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function participantAnswers(): HasMany
    {
        return $this->hasMany(ParticipantAnswer::class);
    }
}
