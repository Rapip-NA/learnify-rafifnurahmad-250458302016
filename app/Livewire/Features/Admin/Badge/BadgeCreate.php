<?php

namespace App\Livewire\Features\Admin\Badge;

use App\Models\Badge;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class BadgeCreate extends Component
{
    #[Layout('components.layouts.app')]
    #[Title('Create Badge')]

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

    protected $rules = [
        'name' => 'required|string|max:255|unique:badges,name',
        'description' => 'nullable|string',
        'condition' => 'nullable|string',
        'icon' => 'nullable|string|max:10',
        'image_url' => 'nullable|url',
        'badge_type' => 'required|in:achievement,milestone,streak,special',
    ];

    protected $validationAttributes = [
        'name' => 'nama badge',
        'description' => 'deskripsi',
        'condition' => 'kondisi',
        'icon' => 'ikon',
        'image_url' => 'URL gambar',
        'badge_type' => 'tipe badge',
    ];

    public function save()
    {
        $validated = $this->validate();

        Badge::create($validated);

        session()->flash('success', 'Badge berhasil dibuat!');

        return $this->redirect('/admin/badges', navigate: true);
    }

    public function render()
    {
        return view('livewire.features.admin.badge.badge-create');
    }
}
