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
    public $duration_hours = 0;
    public $duration_minutes = 30;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'status' => 'required|in:draft,active,inactive',
        'duration_hours' => 'required|integer|min:0|max:23',
        'duration_minutes' => 'required|integer|min:0|max:59'
    ];

    public function save()
    {
        $this->validate();

        // Convert duration to seconds
        $durationSeconds = ($this->duration_hours * 3600) + ($this->duration_minutes * 60);

        // Validation: Duration must be at least 1 minute
        if ($durationSeconds < 60) {
            $this->addError('duration_minutes', 'Duration must be at least 1 minute.');
            return;
        }

        Competition::create([
            'title' => $this->title,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
            'created_by' => Auth::id(),
            'duration_seconds' => $durationSeconds,
        ]);

        return redirect()->route('admin.competitions.index')->with('competition-created', true);
    }

    public function render()
    {
        return view('livewire.features.admin.competitions.competition-create');
    }
}
