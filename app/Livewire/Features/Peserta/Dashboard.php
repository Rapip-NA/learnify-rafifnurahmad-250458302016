<?php

namespace App\Livewire\Features\Peserta;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class Dashboard extends Component
{
    #[Layout('components.layouts.app')]
    #[Title('Peserta Dashboard')]

    public function render()
    {
        return view('livewire.features.peserta.dashboard');
    }
}
