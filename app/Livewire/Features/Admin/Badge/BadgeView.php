<?php

namespace App\Livewire\Features\Admin\Badge;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\Badge;

class BadgeView extends Component
{
    #[Layout('components.layouts.app')]
    #[Title('Badge Details')]

    public Badge $badge;
    
    public function mount(Badge $badge)
    {
        $this->badge = $badge->load(['users' => function($query) {
            $query->orderBy('user_badges.awarded_at', 'desc');
        }]);
    }

    public function render()
    {
        return view('livewire.features.admin.badge.badge-view');
    }
}
