<?php

namespace App\Livewire\Features\Peserta\Competitions;

use Livewire\Component;
use App\Models\Competition;
use App\Models\CompetitionParticipant;

class CompetitionList extends Component
{
    public function render()
    {
        $competitions = Competition::where('status', 'active')
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->with(['questions' => function($q) {
                $q->where('validation_status', 'approved');
            }])
            ->get();

        $myParticipations = CompetitionParticipant::where('user_id', auth()->id())
            ->pluck('competition_id')
            ->toArray();

        return view('livewire.features.peserta.competitions.competition-list', [
            'competitions' => $competitions,
            'myParticipations' => $myParticipations
        ]);
    }

    public function startCompetition($competitionId)
    {
        $competition = Competition::findOrFail($competitionId);

        // Check if already participating
        $participant = CompetitionParticipant::where('user_id', auth()->id())
            ->where('competition_id', $competitionId)
            ->first();

        if (!$participant) {
            $participant = CompetitionParticipant::create([
                'user_id' => auth()->id(),
                'competition_id' => $competitionId,
                'started_at' => now(),
                'total_score' => 0,
                'progress_percentage' => 0
            ]);
        }

        return redirect()->route('competition.quiz', $competitionId);

        // return view('livewire.features.peserta.competitions.competition-list');
    }
}
