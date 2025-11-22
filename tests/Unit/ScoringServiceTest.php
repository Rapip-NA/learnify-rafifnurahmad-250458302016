<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\ScoringService;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Competition;
use App\Models\CompetitionParticipant;
use App\Models\ParticipantAnswer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScoringServiceTest extends TestCase
{
    use RefreshDatabase;

    private ScoringService $scoringService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->scoringService = new ScoringService();
    }

    public function test_correct_answer_with_full_speed_bonus(): void
    {
        // Setup: competition with 20% bonus, 30s threshold
        $competition = Competition::factory()->create([
            'speed_bonus_enabled' => true,
            'speed_bonus_percentage' => 20.00,
            'speed_bonus_time_threshold' => 30,
            'penalty_enabled' => false,
        ]);

        $question = Question::factory()->create([
            'competition_id' => $competition->id,
            'point_weight' => 100,
        ]);

        $answer = Answer::factory()->create([
            'question_id' => $question->id,
            'is_correct' => true,
        ]);

        // Test: answer in 0 seconds = full bonus
        $score = $this->scoringService->calculateAnswerScore($answer, $question, $competition, 0);
        
        $this->assertEquals(120.00, $score); // 100 + 20% = 120
    }

    public function test_correct_answer_with_partial_speed_bonus(): void
    {
        $competition = Competition::factory()->create([
            'speed_bonus_enabled' => true,
            'speed_bonus_percentage' => 20.00,
            'speed_bonus_time_threshold' => 30,
        ]);

        $question = Question::factory()->create([
            'point_weight' => 100,
        ]);

        $answer = Answer::factory()->create([
            'question_id' => $question->id,
            'is_correct' => true,
        ]);

        // Test: answer in 15 seconds (50% of threshold) = 50% bonus
        $score = $this->scoringService->calculateAnswerScore($answer, $question, $competition, 15);
        
        $this->assertEquals(110.00, $score); // 100 + 10 (50% of 20) = 110
    }

    public function test_correct_answer_without_speed_bonus(): void
    {
        $competition = Competition::factory()->create([
            'speed_bonus_enabled' => true,
            'speed_bonus_percentage' => 20.00,
            'speed_bonus_time_threshold' => 30,
        ]);

        $question = Question::factory()->create([
            'point_weight' => 100,
        ]);

        $answer = Answer::factory()->create([
            'question_id' => $question->id,
            'is_correct' => true,
        ]);

        // Test: answer in 40 seconds (over threshold) = no bonus
        $score = $this->scoringService->calculateAnswerScore($answer, $question, $competition, 40);
        
        $this->assertEquals(100.00, $score); // base score only
    }

    public function test_correct_answer_with_bonus_disabled(): void
    {
        $competition = Competition::factory()->create([
            'speed_bonus_enabled' => false,
        ]);

        $question = Question::factory()->create([
            'point_weight' => 100,
        ]);

        $answer = Answer::factory()->create([
            'question_id' => $question->id,
            'is_correct' => true,
        ]);

        // Test: bonus disabled, even if answered fast
        $score = $this->scoringService->calculateAnswerScore($answer, $question, $competition, 5);
        
        $this->assertEquals(100.00, $score); // base score only
    }

    public function test_wrong_answer_with_penalty_enabled(): void
    {
        $competition = Competition::factory()->create([
            'penalty_enabled' => true,
            'penalty_percentage' => 10.00,
        ]);

        $question = Question::factory()->create([
            'point_weight' => 100,
        ]);

        $answer = Answer::factory()->create([
            'question_id' => $question->id,
            'is_correct' => false,
        ]);

        // Test: wrong answer with penalty
        $score = $this->scoringService->calculateAnswerScore($answer, $question, $competition, 10);
        
        $this->assertEquals(-10.00, $score); // -10% of 100
    }

    public function test_wrong_answer_with_penalty_disabled(): void
    {
        $competition = Competition::factory()->create([
            'penalty_enabled' => false,
        ]);

        $question = Question::factory()->create([
            'point_weight' => 100,
        ]);

        $answer = Answer::factory()->create([
            'question_id' => $question->id,
            'is_correct' => false,
        ]);

        // Test: wrong answer without penalty
        $score = $this->scoringService->calculateAnswerScore($answer, $question, $competition, 10);
        
        $this->assertEquals(0.00, $score); // no score, no penalty
    }

    public function test_total_score_calculation(): void
    {
        $user = User::factory()->create();
        $competition = Competition::factory()->create();
        $participant = CompetitionParticipant::factory()->create([
            'user_id' => $user->id,
            'competition_id' => $competition->id,
        ]);

        // Create multiple answers with different scores
        ParticipantAnswer::factory()->create([
            'competition_participant_id' => $participant->id,
            'score_earned' => 120.00, // correct with bonus
        ]);

        ParticipantAnswer::factory()->create([
            'competition_participant_id' => $participant->id,
            'score_earned' => 100.00, // correct without bonus
        ]);

        ParticipantAnswer::factory()->create([
            'competition_participant_id' => $participant->id,
            'score_earned' => -10.00, // wrong with penalty
        ]);

        $totalScore = $this->scoringService->calculateTotalScore($participant);
        
        $this->assertEquals(210.00, $totalScore); // 120 + 100 - 10 = 210
    }

    public function test_total_score_never_negative(): void
    {
        $user = User::factory()->create();
        $competition = Competition::factory()->create();
        $participant = CompetitionParticipant::factory()->create([
            'user_id' => $user->id,
            'competition_id' => $competition->id,
        ]);

        // Create only wrong answers with penalties
        ParticipantAnswer::factory()->create([
            'competition_participant_id' => $participant->id,
            'score_earned' => -10.00,
        ]);

        ParticipantAnswer::factory()->create([
            'competition_participant_id' => $participant->id,
            'score_earned' => -5.00,
        ]);

        $totalScore = $this->scoringService->calculateTotalScore($participant);
        
        $this->assertEquals(0.00, $totalScore); // Never negative
    }

    public function test_speed_bonus_calculation_linear_decrease(): void
    {
        // Test: Linear decrease from max bonus to 0
        $baseScore = 100;
        $bonusPercentage = 20;
        $threshold = 30;

        // At 0 seconds: 100% of bonus
        $bonus = $this->scoringService->calculateSpeedBonus(0, $threshold, $baseScore, $bonusPercentage);
        $this->assertEquals(20.00, $bonus);

        // At 15 seconds (50% of threshold): 50% of bonus
        $bonus = $this->scoringService->calculateSpeedBonus(15, $threshold, $baseScore, $bonusPercentage);
        $this->assertEquals(10.00, $bonus);

        // At 30 seconds (threshold): 0% bonus
        $bonus = $this->scoringService->calculateSpeedBonus(30, $threshold, $baseScore, $bonusPercentage);
        $this->assertEquals(0.00, $bonus);

        // Over threshold: 0% bonus
        $bonus = $this->scoringService->calculateSpeedBonus(45, $threshold, $baseScore, $bonusPercentage);
        $this->assertEquals(0.00, $bonus);
    }
}
