<?php

namespace App\Livewire\Features\Admin;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\Competition;
use App\Models\CompetitionParticipant;
use App\Models\ParticipantAnswer;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class Analytics extends Component
{
    #[Layout('components.layouts.app')]
    #[Title('Dashboard Analisis Admin')]

    public $selectedCompetition;
    public $competitions;
    public $scoreDistribution = [];
    public $questionSuccessRates = [];

    public function mount()
    {
        $this->competitions = Competition::orderBy('created_at', 'desc')->get();
        
        if ($this->competitions->isNotEmpty()) {
            $this->selectedCompetition = $this->competitions->first()->id;
            $this->loadAnalyticsData();
        }
    }

    public function updatedSelectedCompetition()
    {
        $this->loadAnalyticsData();
    }

    public function loadAnalyticsData()
    {
        if (!$this->selectedCompetition) {
            return;
        }

        $this->scoreDistribution = $this->getScoreDistribution();
        $this->questionSuccessRates = $this->getQuestionSuccessRate();
    }

    public function getScoreDistribution()
    {
        // Get all participants for the selected competition with their scores
        $participants = CompetitionParticipant::where('competition_id', $this->selectedCompetition)
            ->whereNotNull('finished_at')
            ->get();

        if ($participants->isEmpty()) {
            return [
                'ranges' => [],
                'counts' => [],
            ];
        }

        // Get max score to determine range
        $maxScore = $participants->max('total_score');
        
        // Create score ranges (bins)
        $rangeSize = max(10, ceil($maxScore / 10)); // At least 10 points per range
        $ranges = [];
        $counts = [];

        // Create ranges dynamically based on max score
        for ($i = 0; $i <= $maxScore; $i += $rangeSize) {
            $rangeStart = $i;
            $rangeEnd = min($i + $rangeSize - 1, $maxScore);
            $rangeLabel = "{$rangeStart}-{$rangeEnd}";
            
            $count = $participants->filter(function ($participant) use ($rangeStart, $rangeEnd) {
                return $participant->total_score >= $rangeStart && $participant->total_score <= $rangeEnd;
            })->count();

            $ranges[] = $rangeLabel;
            $counts[] = $count;
        }

        return [
            'ranges' => $ranges,
            'counts' => $counts,
        ];
    }

    public function getQuestionSuccessRate()
    {
        // Get all questions for the selected competition
        $questions = Question::where('competition_id', $this->selectedCompetition)
            ->with(['participantAnswers' => function ($query) {
                $query->whereHas('competitionParticipant', function ($q) {
                    $q->where('competition_id', $this->selectedCompetition);
                });
            }])
            ->get();

        if ($questions->isEmpty()) {
            return [
                'questions' => [],
                'successRates' => [],
            ];
        }

        $questionLabels = [];
        $successRates = [];

        foreach ($questions as $index => $question) {
            // Create a short label for the question
            $questionText = $question->question_text;
            $questionLabel = strlen($questionText) > 50 
                ? 'Q' . ($index + 1) . ': ' . substr($questionText, 0, 47) . '...'
                : 'Q' . ($index + 1) . ': ' . $questionText;

            $totalAnswers = $question->participantAnswers->count();
            $correctAnswers = $question->participantAnswers->where('is_correct', true)->count();

            $successRate = $totalAnswers > 0 
                ? round(($correctAnswers / $totalAnswers) * 100, 2)
                : 0;

            $questionLabels[] = $questionLabel;
            $successRates[] = $successRate;
        }

        return [
            'questions' => $questionLabels,
            'successRates' => $successRates,
        ];
    }

    public function render()
    {
        return view('livewire.features.admin.analytics', [
            'scoreDistribution' => $this->scoreDistribution,
            'questionSuccessRates' => $this->questionSuccessRates,
            'competitions' => $this->competitions,
        ]);
    }
}
