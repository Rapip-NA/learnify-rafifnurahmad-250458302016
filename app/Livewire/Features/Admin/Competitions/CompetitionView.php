<?php

namespace App\Livewire\Features\Admin\Competitions;

use App\Models\Competition;
use Livewire\Component;

class CompetitionView extends Component
{
    public Competition $competition;

    public function mount(Competition $competition)
    {
        $this->competition = $competition;
    }

    public function render()
    {
        return view('livewire.features.admin.competitions.competition-view');
    }
}
