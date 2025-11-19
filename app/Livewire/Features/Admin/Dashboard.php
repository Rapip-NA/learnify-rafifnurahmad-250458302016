<?php

namespace App\Livewire\Features\Admin;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class Dashboard extends Component
{
    #[Layout('components.layouts.app')]
    #[Title('Admin Dashboard')]

    public function render()
    {
        return view('livewire.features.admin.dashboard');
    }
}
