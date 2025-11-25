<?php

namespace App\Services;

use App\Models\User;
use App\Models\Badge;
use App\Models\UserBadge;
use App\Models\CompetitionParticipant;
use Illuminate\Support\Facades\DB;

class BadgeService
{
    /**
     * Check all badge conditions for a user and award eligible badges
     */
    public function checkAndAwardBadges(User $user): array
    {
        $awardedBadges = [];

        // Get all badges
        $badges = Badge::all();

        foreach ($badges as $badge) {
            // Skip if user already has this badge
            if ($user->badges()->where('badge_id', $badge->id)->exists()) {
                continue;
            }

            // Parse badge condition
            $condition = json_decode($badge->condition, true);
            
            if (!$condition || !isset($condition['type'])) {
                continue;
            }

            // Check if user meets the condition
            $meetsCondition = false;

            switch ($condition['type']) {
                case 'first_completion':
                    $meetsCondition = $this->checkFirstCompletion($user);
                    break;
                
                case 'perfect_score':
                    $meetsCondition = $this->checkPerfectScore($user, $condition['required_count'] ?? 1);
                    break;
                
                case 'completion_count':
                    $meetsCondition = $this->checkCompletionCount($user, $condition['required_count'] ?? 1);
                    break;
                
                case 'speed_completion':
                    $meetsCondition = $this->checkSpeedCompletion($user, $condition['time_percentage'] ?? 50);
                    break;
                
                case 'top_scorer':
                    $meetsCondition = $this->checkTopScorer($user, $condition['top_position'] ?? 3);
                    break;
            }

            // Award badge if condition is met
            if ($meetsCondition) {
                $this->awardBadge($user, $badge);
                $awardedBadges[] = $badge;
            }
        }

        return $awardedBadges;
    }

    /**
     * Check if user completed their first competition
     */
    protected function checkFirstCompletion(User $user): bool
    {
        return CompetitionParticipant::where('user_id', $user->id)
            ->whereNotNull('finished_at')
            ->exists();
    }

    /**
     * Check if user completed N competitions with perfect score
     */
    protected function checkPerfectScore(User $user, int $requiredCount): bool
    {
        // Get total possible score for each competition and compare with user's score
        $perfectScoreCount = CompetitionParticipant::where('user_id', $user->id)
            ->whereNotNull('finished_at')
            ->get()
            ->filter(function ($participant) {
                // Get total possible score for the competition
                $totalPossibleScore = $participant->competition->questions()->sum('point_weight');
                
                // Check if participant's score equals total possible score
                return $totalPossibleScore > 0 && $participant->total_score >= $totalPossibleScore;
            })
            ->count();

        return $perfectScoreCount >= $requiredCount;
    }

    /**
     * Check if user completed N competitions (any score)
     */
    protected function checkCompletionCount(User $user, int $requiredCount): bool
    {
        $completionCount = CompetitionParticipant::where('user_id', $user->id)
            ->whereNotNull('finished_at')
            ->count();

        return $completionCount >= $requiredCount;
    }

    /**
     * Check if user completed any competition in less than X% of time limit
     */
    protected function checkSpeedCompletion(User $user, int $timePercentage): bool
    {
        $speedCompletions = CompetitionParticipant::where('user_id', $user->id)
            ->whereNotNull('finished_at')
            ->whereNotNull('started_at')
            ->get()
            ->filter(function ($participant) use ($timePercentage) {
                $timeLimit = $participant->competition->duration_seconds;
                if (!$timeLimit) {
                    return false;
                }

                $timeTaken = $participant->finished_at->diffInSeconds($participant->started_at);
                $allowedTime = ($timeLimit * $timePercentage) / 100;

                return $timeTaken <= $allowedTime;
            });

        return $speedCompletions->count() > 0;
    }

    /**
     * Check if user achieved top N position in any competition
     */
    protected function checkTopScorer(User $user, int $topPosition): bool
    {
        // Get all competitions user participated in
        $participations = CompetitionParticipant::where('user_id', $user->id)
            ->whereNotNull('finished_at')
            ->get();

        foreach ($participations as $participation) {
            // Get user's rank in this competition
            $rank = CompetitionParticipant::where('competition_id', $participation->competition_id)
                ->whereNotNull('finished_at')
                ->where('total_score', '>', $participation->total_score)
                ->count() + 1;

            if ($rank <= $topPosition) {
                return true;
            }
        }

        return false;
    }

    /**
     * Award a badge to a user
     */
    public function awardBadge(User $user, Badge $badge): UserBadge
    {
        return UserBadge::firstOrCreate(
            [
                'user_id' => $user->id,
                'badge_id' => $badge->id,
            ],
            [
                'awarded_at' => now(),
            ]
        );
    }

    /**
     * Get user's progress toward a specific badge
     */
    public function getBadgeProgress(User $user, Badge $badge): array
    {
        $condition = json_decode($badge->condition, true);
        
        if (!$condition || !isset($condition['type'])) {
            return ['current' => 0, 'required' => 0, 'percentage' => 0];
        }

        $current = 0;
        $required = 0;

        switch ($condition['type']) {
            case 'first_completion':
                $required = 1;
                $current = CompetitionParticipant::where('user_id', $user->id)
                    ->whereNotNull('finished_at')
                    ->exists() ? 1 : 0;
                break;
            
            case 'perfect_score':
                $required = $condition['required_count'] ?? 1;
                $current = CompetitionParticipant::where('user_id', $user->id)
                    ->whereNotNull('finished_at')
                    ->get()
                    ->filter(function ($participant) {
                        $totalPossibleScore = $participant->competition->questions()->sum('point_weight');
                        return $totalPossibleScore > 0 && $participant->total_score >= $totalPossibleScore;
                    })
                    ->count();
                break;
            
            case 'completion_count':
                $required = $condition['required_count'] ?? 1;
                $current = CompetitionParticipant::where('user_id', $user->id)
                    ->whereNotNull('finished_at')
                    ->count();
                break;
            
            case 'speed_completion':
            case 'top_scorer':
                // These are one-time achievements
                $required = 1;
                $current = 0; // Would need to check if achieved
                break;
        }

        $percentage = $required > 0 ? min(100, round(($current / $required) * 100, 2)) : 0;

        return [
            'current' => $current,
            'required' => $required,
            'percentage' => $percentage,
        ];
    }
}
