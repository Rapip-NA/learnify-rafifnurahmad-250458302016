<?php

namespace App\Livewire\Features\Peserta\Competitions;

use Livewire\Component;
use App\Models\Competition;
use App\Models\CompetitionParticipant;
use App\Models\Question;
use App\Models\ParticipantAnswer;
use Illuminate\Support\Facades\DB;

class CompetitionQuiz extends Component
{
    public $competition;
    public $participant;
    public $questions;
    public $currentQuestionIndex = 0;
    public $selectedAnswer = null;
    public $answers = [];
    public $startTime;
    public $isFinished = false;

    public function mount($competitionId)
    {
        $this->competition = Competition::with(['questions.answers', 'questions.category'])
            ->findOrFail($competitionId);

        // Get or create participant
        $this->participant = CompetitionParticipant::firstOrCreate(
            [
                'user_id' => auth()->id(),
                'competition_id' => $competitionId
            ],
            [
                'started_at' => now(),
                'total_score' => 0,
                'progress_percentage' => 0
            ]
        );

        // Get approved questions
        $this->questions = $this->competition->questions()
            ->where('validation_status', 'approved')
            ->with(['answers', 'category'])
            ->get();

        // Load existing answers
        $this->loadExistingAnswers();

        $this->startTime = now();

        // Check if already finished
        if ($this->participant->finished_at) {
            $this->isFinished = true;
        }
    }

    public function loadExistingAnswers()
    {
        $existingAnswers = ParticipantAnswer::where('competition_participant_id', $this->participant->id)
            ->pluck('answer_id', 'question_id')
            ->toArray();

        foreach ($this->questions as $index => $question) {
            if (isset($existingAnswers[$question->id])) {
                $this->answers[$index] = $existingAnswers[$question->id];
            }
        }

        // Set current question to first unanswered
        foreach ($this->questions as $index => $question) {
            if (!isset($this->answers[$index])) {
                $this->currentQuestionIndex = $index;
                break;
            }
        }
    }

    public function getCurrentQuestion()
    {
        return $this->questions[$this->currentQuestionIndex] ?? null;
    }

    public function selectAnswer($answerId)
    {
        $this->selectedAnswer = $answerId;
    }

    public function submitAnswer()
    {
        if (!$this->selectedAnswer) {
            session()->flash('error', 'Pilih jawaban terlebih dahulu!');
            return;
        }

        $question = $this->getCurrentQuestion();
        $answer = $question->answers()->find($this->selectedAnswer);

        if (!$answer) {
            session()->flash('error', 'Jawaban tidak valid!');
            return;
        }

        $timeSpent = now()->diffInSeconds($this->startTime);

        // Save answer
        ParticipantAnswer::updateOrCreate(
            [
                'competition_participant_id' => $this->participant->id,
                'question_id' => $question->id,
            ],
            [
                'answer_id' => $this->selectedAnswer,
                'is_correct' => $answer->is_correct,
                'time_spent' => $timeSpent,
                'validation_status' => 'pending'
            ]
        );

        // Store in local array
        $this->answers[$this->currentQuestionIndex] = $this->selectedAnswer;

        // Update progress
        $this->updateProgress();

        // Reset for next question
        $this->selectedAnswer = null;
        $this->startTime = now();

        session()->flash('success', 'Jawaban berhasil disimpan!');
    }

    public function nextQuestion()
    {
        if ($this->currentQuestionIndex < count($this->questions) - 1) {
            $this->currentQuestionIndex++;

            // Load selected answer if exists
            if (isset($this->answers[$this->currentQuestionIndex])) {
                $this->selectedAnswer = $this->answers[$this->currentQuestionIndex];
            } else {
                $this->selectedAnswer = null;
            }
        }
    }

    public function previousQuestion()
    {
        if ($this->currentQuestionIndex > 0) {
            $this->currentQuestionIndex--;

            // Load selected answer if exists
            if (isset($this->answers[$this->currentQuestionIndex])) {
                $this->selectedAnswer = $this->answers[$this->currentQuestionIndex];
            } else {
                $this->selectedAnswer = null;
            }
        }
    }

    public function goToQuestion($index)
    {
        $this->currentQuestionIndex = $index;

        // Load selected answer if exists
        if (isset($this->answers[$this->currentQuestionIndex])) {
            $this->selectedAnswer = $this->answers[$this->currentQuestionIndex];
        } else {
            $this->selectedAnswer = null;
        }
    }

    public function updateProgress()
    {
        $totalQuestions = count($this->questions);
        $answeredQuestions = count($this->answers);
        $progress = ($answeredQuestions / $totalQuestions) * 100;

        $this->participant->update([
            'progress_percentage' => round($progress, 2)
        ]);

        $this->participant->refresh();
    }

    public function finishCompetition()
    {
        // Check if all questions answered
        if (count($this->answers) < count($this->questions)) {
            session()->flash('error', 'Jawab semua soal terlebih dahulu!');
            return;
        }

        DB::transaction(function () {
            // Calculate total score
            $totalScore = ParticipantAnswer::where('competition_participant_id', $this->participant->id)
                ->where('is_correct', true)
                ->join('questions', 'participant_answers.question_id', '=', 'questions.id')
                ->sum('questions.point_weight');

            // Update participant
            $this->participant->update([
                'finished_at' => now(),
                'total_score' => $totalScore,
                'progress_percentage' => 100
            ]);

            // Update leaderboard
            \App\Models\Leaderboard::updateOrCreate(
                [
                    'competition_id' => $this->competition->id,
                    'user_id' => auth()->id()
                ],
                [
                    'score' => $totalScore,
                    'updated_at' => now()
                ]
            );

            // Recalculate ranks
            $this->updateLeaderboardRanks();
        });

        $this->isFinished = true;
        session()->flash('success', 'Kompetisi selesai! Skor Anda: ' . $this->participant->total_score);
    }

    private function updateLeaderboardRanks()
    {
        $leaderboards = \App\Models\Leaderboard::where('competition_id', $this->competition->id)
            ->orderBy('score', 'desc')
            ->orderBy('updated_at', 'asc')
            ->get();

        foreach ($leaderboards as $index => $leaderboard) {
            $leaderboard->update(['rank' => $index + 1]);
        }
    }

    public function render()
    {
        $currentQuestion = $this->getCurrentQuestion();

        return view('livewire.features.peserta.competitions.competition-quiz', [
            'currentQuestion' => $currentQuestion,
            'totalQuestions' => count($this->questions),
            'answeredCount' => count($this->answers)
        ]);
    }
}
