<?php

namespace App\Livewire\Features\Admin;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\User;
use App\Models\Competition;
use App\Models\Question;
use App\Models\CompetitionParticipant;
use App\Models\ParticipantAnswer;

class Dashboard extends Component
{
    #[Layout('components.layouts.app')]
    #[Title('Admin Dashboard')]

    public function getDashboardData()
    {
        // System Statistics
        $totalUsers = User::count();
        $totalCompetitions = Competition::count();
        $totalQuestions = Question::count();
        $totalParticipations = CompetitionParticipant::count();
        
        // Competition by Status
        $competitionsByStatus = [
            'draft' => Competition::where('status', 'draft')->count(),
            'active' => Competition::where('status', 'active')->count(),
            'inactive' => Competition::where('status', 'inactive')->count(),
        ];
        
        // Top 5 Competitions by Participation
        $topCompetitions = Competition::withCount('participants')
            ->having('participants_count', '>', 0)
            ->orderBy('participants_count', 'desc')
            ->take(5)
            ->get();
        
        // Top 5 Active Competitions for Chart
        $topActiveCompetitions = Competition::where('status', 'active')
            ->withCount('participants')
            ->having('participants_count', '>', 0)
            ->orderBy('participants_count', 'desc')
            ->take(5)
            ->get();
        
        // Recent Competitions
        $recentCompetitions = Competition::with('creator')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // User Breakdown by Role
        $usersByRole = [
            'peserta' => User::where('role', 'peserta')->count(),
            'qualifier' => User::where('role', 'qualifier')->count(),
            'admin' => User::where('role', 'admin')->count(),
        ];
        
        // Format data for charts
        $usersByRoleChart = [
            'labels' => ['Peserta', 'Qualifier', 'Admin'],
            'values' => [
                $usersByRole['peserta'],
                $usersByRole['qualifier'],
                $usersByRole['admin'],
            ],
        ];
        
        $topActiveCompetitionsChart = [
            'labels' => $topActiveCompetitions->pluck('title')->toArray(),
            'values' => $topActiveCompetitions->pluck('participants_count')->toArray(),
        ];
        
        // Performance Metrics
        $completedParticipations = CompetitionParticipant::whereNotNull('finished_at')->count();
        $totalScore = CompetitionParticipant::whereNotNull('finished_at')->sum('total_score');
        $avgScore = $completedParticipations > 0 ? round($totalScore / $completedParticipations, 2) : 0;
        $completionRate = $totalParticipations > 0 
            ? round(($completedParticipations / $totalParticipations) * 100, 1) 
            : 0;
        
        // Active Users (participated in last 30 days)
        $activeUsers = CompetitionParticipant::where('started_at', '>=', now()->subDays(30))
            ->distinct('user_id')
            ->count('user_id');
        
        // Total Answers Submitted
        $totalAnswers = ParticipantAnswer::count();
        
        return [
            'stats' => [
                'totalUsers' => $totalUsers,
                'totalCompetitions' => $totalCompetitions,
                'totalQuestions' => $totalQuestions,
                'totalParticipations' => $totalParticipations,
            ],
            'competitionsByStatus' => $competitionsByStatus,
            'topCompetitions' => $topCompetitions,
            'recentCompetitions' => $recentCompetitions,
            'usersByRole' => $usersByRole,
            'usersByRoleChart' => $usersByRoleChart,
            'topActiveCompetitionsChart' => $topActiveCompetitionsChart,
            'metrics' => [
                'avgScore' => $avgScore,
                'completionRate' => $completionRate,
                'activeUsers' => $activeUsers,
                'totalAnswers' => $totalAnswers,
            ],
        ];
    }

    public function render()
    {
        $dashboardData = $this->getDashboardData();
        
        return view('livewire.features.admin.dashboard', $dashboardData);
    }
}
