<?php

namespace App\Livewire\Features\Peserta\Competitions;

use App\Models\Competition;
use App\Models\CompetitionParticipant;
use Livewire\Component;

class CompetitionList extends Component
{
    public function render()
    {
        // Fetch draft competitions (upcoming, not yet started)
        $draftCompetitions = Competition::where('status', 'draft')
            ->with(['questions' => function ($q) {
                $q->where('validation_status', 'approved');
            }])
            ->orderBy('start_date', 'asc')
            ->get();

        // Fetch active competitions (currently ongoing)
        $activeCompetitions = Competition::where('status', 'active')
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->with(['questions' => function ($q) {
                $q->where('validation_status', 'approved');
            }])
            ->orderBy('start_date', 'asc')
            ->get();

        // Fetch inactive competitions (past end date or manually closed)
        $inactiveCompetitions = Competition::where(function ($query) {
                $query->where('status', 'inactive')
                      ->orWhereDate('end_date', '<', now());
            })
            ->with(['questions' => function ($q) {
                $q->where('validation_status', 'approved');
            }])
            ->orderBy('end_date', 'desc')
            ->get();

        $myParticipations = CompetitionParticipant::where('user_id', auth()->id())
            ->pluck('competition_id')
            ->toArray();

        // Get completed competitions (where finished_at is not null)
        $completedCompetitions = CompetitionParticipant::where('user_id', auth()->id())
            ->whereNotNull('finished_at')
            ->pluck('competition_id')
            ->toArray();

        return view('livewire.features.peserta.competitions.competition-list', [
            'draftCompetitions' => $draftCompetitions,
            'activeCompetitions' => $activeCompetitions,
            'inactiveCompetitions' => $inactiveCompetitions,
            'myParticipations' => $myParticipations,
            'completedCompetitions' => $completedCompetitions,
        ]);
    }

    public function startCompetition($competitionId)
    {
        $competition = Competition::findOrFail($competitionId);

        // Check if already participating
        $participant = CompetitionParticipant::where('user_id', auth()->id())
            ->where('competition_id', $competitionId)
            ->first();

        if (! $participant) {
            $participant = CompetitionParticipant::create([
                'user_id' => auth()->id(),
                'competition_id' => $competitionId,
                'started_at' => now(),
                'total_score' => 0,
                'progress_percentage' => 0,
            ]);
        }

        return redirect()->route('peserta.competitions.quiz', $competitionId);

        // return view('livewire.features.peserta.competitions.competition-list');
    }
}
