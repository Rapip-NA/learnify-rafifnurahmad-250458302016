<?php

namespace App\Livewire\Features\Admin\Competitions;

use Livewire\Component;
use App\Models\Competition;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class CompetitionIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    #[Layout('components.layouts.app')]

    public $search = '';
    public $statusFilter = '';

    protected $queryString = ['search', 'statusFilter'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $competition = Competition::find($id);
        
        if ($competition) {
            $competition->delete();
            $this->dispatch('competition-deleted');
        }
    }

    public function render()
    {
        $competitions = Competition::query()
            ->with('creator')
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->orderBy('start_date', 'desc')
            ->paginate(10);

        return view('livewire.features.admin.competitions.competition-index', [
            'competitions' => $competitions
        ]);
    }
}
