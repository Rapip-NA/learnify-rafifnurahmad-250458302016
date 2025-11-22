<?php

namespace App\Services;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Competition;
use App\Models\CompetitionParticipant;

class ScoringService
{
    /**
     * Calculate score for a single answer
     * 
     * @param Answer $answer
     * @param Question $question
     * @param Competition $competition
     * @param int $timeSpent Time spent in seconds
     * @return float
     */
    public function calculateAnswerScore(
        Answer $answer,
        Question $question,
        Competition $competition,
        int $timeSpent
    ): float {
        $baseScore = $question->point_weight ?? 0;
        
        // Wrong answer
        if (!$answer->is_correct) {
            if ($competition->penalty_enabled) {
                $penalty = $baseScore * ($competition->penalty_percentage / 100);
                return -$penalty;
            }
            return 0;
        }
        
        // Correct answer - calculate with speed bonus
        $speedBonus = 0;
        if ($competition->speed_bonus_enabled) {
            $speedBonus = $this->calculateSpeedBonus(
                $timeSpent,
                $competition->speed_bonus_time_threshold,
                $baseScore,
                $competition->speed_bonus_percentage
            );
        }
        
        return $baseScore + $speedBonus;
    }
    
    /**
     * Calculate speed bonus based on time spent
     * Linear decrease from max bonus to 0 as time approaches threshold
     * 
     * @param int $timeSpent Time spent in seconds
     * @param int $threshold Time threshold in seconds
     * @param float $baseScore Base score for the question
     * @param float $bonusPercentage Maximum bonus percentage
     * @return float
     */
    public function calculateSpeedBonus(
        int $timeSpent,
        int $threshold,
        float $baseScore,
        float $bonusPercentage
    ): float {
        if ($timeSpent >= $threshold || $threshold <= 0) {
            return 0;
        }
        
        // Linear bonus: full bonus at 0 seconds, 0 bonus at threshold
        $speedRatio = 1 - ($timeSpent / $threshold);
        $bonus = $baseScore * ($bonusPercentage / 100) * $speedRatio;
        
        return max(0, $bonus);
    }
    
    /**
     * Calculate total score for a participant
     * 
     * @param CompetitionParticipant $participant
     * @return float
     */
    public function calculateTotalScore(CompetitionParticipant $participant): float
    {
        $totalScore = $participant->participantAnswers()
            ->sum('score_earned');
        
        return max(0, $totalScore); // Never return negative total score
    }
    
    /**
     * Recalculate and update all scores for a participant
     * Useful for re-scoring when competition settings change
     * 
     * @param CompetitionParticipant $participant
     * @return void
     */
    public function recalculateParticipantScores(CompetitionParticipant $participant): void
    {
        $competition = $participant->competition;
        
        foreach ($participant->participantAnswers as $participantAnswer) {
            $answer = $participantAnswer->answer;
            $question = $participantAnswer->question;
            
            $scoreEarned = $this->calculateAnswerScore(
                $answer,
                $question,
                $competition,
                $participantAnswer->time_spent
            );
            
            $participantAnswer->update(['score_earned' => $scoreEarned]);
        }
        
        // Update total score
        $totalScore = $this->calculateTotalScore($participant);
        $participant->update(['total_score' => $totalScore]);
    }
}
