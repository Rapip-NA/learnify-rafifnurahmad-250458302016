<?php

namespace App\Livewire\Features\Admin\Competitions;

use Livewire\Component;
use App\Models\Competition;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class CompetitionIndex extends Component
{
    use WithPagination;

    #[Layout('components.layouts.app')]

    public $search = '';
    public $statusFilter = '';
    public $deleteId;

    protected $queryString = ['search', 'statusFilter'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    public function delete()
    {
        if ($this->deleteId) {
            Competition::find($this->deleteId)->delete();
            session()->flash('message', 'Competition deleted successfully.');
            $this->deleteId = null;
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
