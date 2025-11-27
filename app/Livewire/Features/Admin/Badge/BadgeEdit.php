<?php

namespace App\Livewire\Features\Admin\Badge;

use App\Models\Badge;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Validation\Rule;

class BadgeEdit extends Component
{
    #[Layout('components.layouts.app')]
    #[Title('Edit Badge')]

    public Badge $badge;
    public $name = '';
    public $description = '';
    public $condition = '';
    public $icon = '';
    public $image_url = '';
    public $badge_type = 'achievement';

    // Condition builder fields
    public $condition_type = '';
    public $required_count = 1;
    public $time_percentage = 50;
    public $top_position = 3;

    public function mount(Badge $badge)
    {
        $this->badge = $badge;
        $this->name = $this->badge->name;
        $this->description = $this->badge->description;
        $this->condition = $this->badge->condition;
        $this->icon = $this->badge->icon;
        $this->image_url = $this->badge->image_url;
        $this->badge_type = $this->badge->badge_type;

        // Parse existing condition
        $this->parseCondition();
    }

    protected function parseCondition()
    {
        if (empty($this->condition)) {
            return;
        }

        $conditionData = json_decode($this->condition, true);
        if (!$conditionData || !isset($conditionData['type'])) {
            return;
        }

        $this->condition_type = $conditionData['type'];

        switch ($this->condition_type) {
            case 'perfect_score':
            case 'completion_count':
                $this->required_count = $conditionData['required_count'] ?? 1;
                break;
            case 'speed_completion':
                $this->time_percentage = $conditionData['time_percentage'] ?? 50;
                break;
            case 'top_scorer':
                $this->top_position = $conditionData['top_position'] ?? 3;
                break;
        }
    }

    public function updatedConditionType()
    {
        $this->buildConditionJson();
    }

    public function updatedRequiredCount()
    {
        $this->buildConditionJson();
    }

    public function updatedTimePercentage()
    {
        $this->buildConditionJson();
    }

    public function updatedTopPosition()
    {
        $this->buildConditionJson();
    }

    protected function buildConditionJson()
    {
        if (empty($this->condition_type)) {
            $this->condition = '';
            return;
        }

        $conditionData = ['type' => $this->condition_type];

        switch ($this->condition_type) {
            case 'perfect_score':
            case 'completion_count':
                $conditionData['required_count'] = (int) $this->required_count;
                break;
            case 'speed_completion':
                $conditionData['time_percentage'] = (int) $this->time_percentage;
                break;
            case 'top_scorer':
                $conditionData['top_position'] = (int) $this->top_position;
                break;
        }

        $this->condition = json_encode($conditionData);
    }

    protected function rules()
    {
        return [
            'description' => 'nullable|string',
            'condition' => 'nullable|string',
            'icon' => 'nullable|string|max:10',
            'image_url' => 'nullable|url',
            'badge_type' => 'required|in:achievement,milestone,streak,special',
        ];
    }

    protected $validationAttributes = [
        'name' => 'nama badge',
        'description' => 'deskripsi',
        'condition' => 'kondisi',
        'icon' => 'ikon',
        'image_url' => 'URL gambar',
        'badge_type' => 'tipe badge',
    ];

    public function update()
    {
        $validated = $this->validate();

        // Don't update the name field
        $this->badge->update($validated);

        $this->dispatch('badge-updated');
    }

    public function deleteBadge()
    {
        $this->badge->delete();

        $this->dispatch('badge-deleted');
    }

    public function render()
    {
        return view('livewire.features.admin.badge.badge-edit');
    }
}
