<?php

namespace App\Livewire\Features\Peserta\Competitions;

use Livewire\Component;
use App\Models\Competition;
use App\Models\CompetitionParticipant;
use App\Models\ParticipantAnswer;

class CompetitionResult extends Component
{
    public $competition;
    public $participant;
    public $answers;
    public $correctAnswers;
    public $wrongAnswers;

    public function mount($competitionId)
    {
        $this->competition = Competition::findOrFail($competitionId);

        $this->participant = CompetitionParticipant::where('user_id', auth()->id())
            ->where('competition_id', $competitionId)
            ->firstOrFail();

        $this->answers = ParticipantAnswer::where('competition_participant_id', $this->participant->id)
            ->with(['question.category', 'question.answers', 'answer'])
            ->get();

        $this->correctAnswers = $this->answers->where('is_correct', true)->count();
        $this->wrongAnswers = $this->answers->where('is_correct', false)->count();
    }

    public function render()
    {
        return view('livewire.features.peserta.competitions.competition-result');
    }
}
