<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;

class UserProfile extends Component
{
    #[Layout('components.layouts.app')]

    public function render()
    {
        $user = auth()->user();
        
        // Get user badges with badge details
        $badges = $user->userBadges()
            ->with('badge')
            ->orderBy('awarded_at', 'desc')
            ->get();
        
        // Get completed competitions
        $completedCompetitions = $user->competitionParticipants()
            ->with('competition')
            ->whereNotNull('finished_at')
            ->orderBy('finished_at', 'desc')
            ->get();
        
        // Calculate statistics
        $totalBadges = $badges->count();
        $totalCompletedCompetitions = $completedCompetitions->count();
        $averageScore = $completedCompetitions->avg('total_score') ?? 0;
        
        return view('livewire.user-profile', [
            'user' => $user,
            'badges' => $badges,
            'completedCompetitions' => $completedCompetitions,
            'totalBadges' => $totalBadges,
            'totalCompletedCompetitions' => $totalCompletedCompetitions,
            'averageScore' => round($averageScore, 2),
        ]);
    }
}
