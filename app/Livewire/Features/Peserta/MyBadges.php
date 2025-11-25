<?php

namespace App\Livewire\Features\Peserta;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\Badge;
use App\Services\BadgeService;
use Illuminate\Support\Facades\Auth;

class MyBadges extends Component
{
    #[Layout('components.layouts.app')]
    #[Title('My Badges')]

    public function render()
    {
        $user = Auth::user();
        $badgeService = new BadgeService();

        // Get all badges
        $allBadges = Badge::all();

        // Separate earned and locked badges
        $earnedBadgeIds = $user->badges->pluck('id')->toArray();
        
        $earnedBadges = $allBadges->whereIn('id', $earnedBadgeIds)->map(function($badge) use ($user) {
            $pivot = $user->badges->find($badge->id)->pivot;
            $badge->awarded_at = $pivot->awarded_at;
            return $badge;
        })->sortByDesc('awarded_at');

        $lockedBadges = $allBadges->whereNotIn('id', $earnedBadgeIds)->map(function($badge) use ($user, $badgeService) {
            $progress = $badgeService->getBadgeProgress($user, $badge);
            $badge->progress = $progress;
            return $badge;
        });

        return view('livewire.features.peserta.my-badges', [
            'earnedBadges' => $earnedBadges,
            'lockedBadges' => $lockedBadges,
            'totalBadges' => $allBadges->count(),
            'earnedCount' => $earnedBadges->count(),
        ]);
    }
}
