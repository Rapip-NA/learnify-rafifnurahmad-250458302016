\u003c?php

namespace App\\Livewire\\Features\\Admin;

use App\\Models\\ParticipantAnswer;
use App\\Models\\Competition;
use App\\Models\\CompetitionParticipant;
use Livewire\\Component;
use Livewire\\WithPagination;

class EssayGrading extends Component
{
    use WithPagination;

    public $selectedCompetitionId;
    public $gradingAnswerId;
    public $gradingScore;
    public $gradingNotes;
    public $maxScore;

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        // Auto-select first competition with pending essays
        $firstCompetition = Competition::whereHas('questions', function($query) {
            $query->where('question_type', 'essay');
        })->first();
        
        if ($firstCompetition) {
            $this->selectedCompetitionId = $firstCompetition->id;
        }
    }

    public function selectAnswer($answerId, $maxPoints)
    {
        $this->gradingAnswerId = $answerId;
        $this->maxScore = $maxPoints;
        $this->gradingScore = null;
        $this->gradingNotes = '';
    }

    public function gradeAnswer()
    {
        $this->validate([
            'gradingScore' => 'required|numeric|min:0|max:' . $this->maxScore,
            'gradingNotes' => 'nullable|string|max:1000',
        ]);

        $answer = ParticipantAnswer::find($this->gradingAnswerId);
        
        if ($answer && $answer->grading_status === 'pending') {
            $answer->update([
                'score_earned' => $this->gradingScore,
                'grading_status' => 'graded',
                'graded_at' => now(),
                'grading_notes' => $this->gradingNotes,
                'verified_by' => auth()->id(),
            ]);

            // Update total score for participant
            $this->updateParticipantScore($answer->competition_participant_id);

            session()->flash('message', 'Essay graded successfully.');
            $this->reset(['gradingAnswerId', 'gradingScore', 'gradingNotes', 'maxScore']);
        }
    }

    protected function updateParticipantScore($participantId)
    {
        $participant = CompetitionParticipant::find($participantId);
        
        if ($participant) {
            // Calculate total score from all graded answers
            $totalScore = ParticipantAnswer::where('competition_participant_id', $participantId)
                ->where(function($query) {
                    $query->where('grading_status', 'graded')
                          ->orWhere('grading_status', 'not_applicable');
                })
                ->sum('score_earned');

            $participant->update(['total_score' => $totalScore]);

            // Update leaderboard if exists
            $leaderboard = $participant->competition->leaderboards()
                ->where('user_id', $participant->user_id)
                ->first();

            if ($leaderboard) {
                $leaderboard->update(['score' => $totalScore]);
            }
        }
    }

    public function render()
    {
        $competitions = Competition::whereHas('questions', function($query) {
            $query->where('question_type', 'essay');
        })->withCount(['questions' => function($query) {
            $query->where('question_type', 'essay');
        }])->get();

        $pendingAnswers = collect();
        
        if ($this->selectedCompetitionId) {
            $pendingAnswers = ParticipantAnswer::with([
                'competitionParticipant.user',
                'question'
            ])
            ->whereHas('question', function($query) {
                $query->where('competition_id', $this->selectedCompetitionId)
                      ->where('question_type', 'essay');
            })
            ->where('grading_status', 'pending')
            ->orderBy('created_at', 'asc')
            ->paginate(10);
        }

        return view('livewire.features.admin.essay-grading', [
            'competitions' => $competitions,
            'pendingAnswers' => $pendingAnswers,
        ]);
    }
}
