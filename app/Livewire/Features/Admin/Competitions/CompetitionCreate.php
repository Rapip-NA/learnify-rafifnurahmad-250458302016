<?php

namespace App\Livewire\Features\Admin\Competitions;

use App\Models\Competition;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CompetitionCreate extends Component
{
    public $title;
    public $description;
    public $start_date;
    public $end_date;
    public $status = 'draft';

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'status' => 'required|in:draft,active,inactive'
    ];

    public function save()
    {
        $this->validate();

        Competition::create([
            'title' => $this->title,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('admin.competitions.index')->with('competition-created', true);
    }

    public function render()
    {
        return view('livewire.features.admin.competitions.competition-create');
    }
}
