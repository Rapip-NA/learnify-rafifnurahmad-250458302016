<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Leaderboard extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'competition_id',
        'user_id',
        'score',
        'rank',
    ];

    protected $casts = [
        'updated_at' => 'datetime',
    ];

    public function competition(): BelongsTo
    {
        return $this->belongsTo(Competition::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get position badge/icon for display
     */
    public function getPositionBadgeAttribute(): string
    {
        return match($this->rank) {
            1 => '🥇',
            2 => '🥈',
            3 => '🥉',
            default => "#{$this->rank}"
        };
    }
}
