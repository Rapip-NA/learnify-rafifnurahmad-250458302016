<?php

namespace App\Livewire\Features\Qualifier;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class Dashboard extends Component
{
    #[Layout('components.layouts.app')]
    #[Title('Qualifier Dashboard')]


    public function render()
    {
        return view('livewire.features.qualifier.dashboard');
    }
}
