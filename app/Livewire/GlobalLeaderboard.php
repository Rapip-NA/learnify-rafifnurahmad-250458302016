<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class GlobalLeaderboard extends Component
{
    public $limit = 50;
    public $refreshInterval = 5000; // 5 seconds for global leaderboard
    public $showAll = false;

    public function toggleShowAll()
    {
        $this->showAll = !$this->showAll;
        $this->limit = $this->showAll ? 1000 : 50;
    }

    public function getLeaderboardProperty()
    {
        return User::select('users.id', 'users.name', 'users.email')
            ->join('leaderboards', 'users.id', '=', 'leaderboards.user_id')
            ->selectRaw('SUM(leaderboards.score) as total_score')
            ->selectRaw('COUNT(DISTINCT leaderboards.competition_id) as competitions_count')
            ->selectRaw('MAX(leaderboards.updated_at) as last_activity')
            ->groupBy('users.id', 'users.name', 'users.email')
            ->orderByDesc('total_score')
            ->orderBy('last_activity', 'asc') // Earlier finisher wins on tie
            ->limit($this->limit)
            ->get()
            ->map(function ($user, $index) {
                $user->rank = $index + 1;
                $user->position_badge = match($user->rank) {
                    1 => '🥇',
                    2 => '🥈',
                    3 => '🥉',
                    default => "#{$user->rank}"
                };
                return $user;
            });
    }

    public function getTotalParticipantsProperty()
    {
        return User::join('leaderboards', 'users.id', '=', 'leaderboards.user_id')
            ->distinct('users.id')
            ->count('users.id');
    }

    public function render()
    {
        return view('livewire.global-leaderboard', [
            'leaderboard' => $this->leaderboard,
            'totalParticipants' => $this->totalParticipants,
        ]);
    }
}
