<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Competition extends Model
{
    use HasFactory;

    protected $fillable = [
        'uid',
        'title',
        'description',
        'start_date',
        'end_date',
        'status',
        'created_by',
        'speed_bonus_enabled',
        'speed_bonus_percentage',
        'speed_bonus_time_threshold',
        'penalty_enabled',
        'penalty_percentage',
        'duration_seconds',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'speed_bonus_enabled' => 'boolean',
        'penalty_enabled' => 'boolean',
        'speed_bonus_percentage' => 'decimal:2',
        'penalty_percentage' => 'decimal:2',
    ];

    /**
     * Boot method to auto-generate UID
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($competition) {
            if (empty($competition->uid)) {
                $competition->uid = self::generateUniqueUid();
            }
        });
    }

    /**
     * Generate unique UID
     */
    private static function generateUniqueUid(): string
    {
        do {
            $uid = (string) \Illuminate\Support\Str::uuid();
        } while (self::where('uid', $uid)->exists());

        return $uid;
    }

    /**
     * Get the route key for the model (use uid instead of id)
     */
    public function getRouteKeyName(): string
    {
        return 'uid';
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function competitionParticipants(): HasMany
    {
        return $this->hasMany(CompetitionParticipant::class);
    }

    public function participants(): HasMany
    {
        return $this->hasMany(CompetitionParticipant::class);
    }

    public function leaderboards(): HasMany
    {
        return $this->hasMany(Leaderboard::class);
    }

    /**
     * Check if competition has expired (end_date has passed)
     */
    public function isExpired(): bool
    {
        return $this->end_date < now();
    }

    /**
     * Scope to get expired competitions
     */
    public function scopeExpired($query)
    {
        return $query->where('end_date', '<', now());
    }

    /**
     * Scope to get active and not expired competitions
     */
    public function scopeActiveAndNotExpired($query)
    {
        return $query->where('status', 'active')
            ->where('end_date', '>=', now());
    }
}
