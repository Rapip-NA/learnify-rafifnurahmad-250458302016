<?php

namespace App\Livewire\Features\Admin\Question;

use App\Models\Question;
use App\Models\Competition;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class QuestionIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $filterCompetition = '';
    public $filterCategory = '';
    public $filterDifficulty = '';
    public $filterStatus = '';
    public $deleteId = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'filterCompetition' => ['except' => ''],
        'filterCategory' => ['except' => ''],
        'filterDifficulty' => ['except' => ''],
        'filterStatus' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterCompetition()
    {
        $this->resetPage();
    }

    public function updatingFilterCategory()
    {
        $this->resetPage();
    }

    public function updatingFilterDifficulty()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
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
            Question::find($this->deleteId)->delete();
            session()->flash('message', 'Question deleted successfully.');
            $this->deleteId = null;
        }
    }

    public function render()
    {
        $questions = Question::with(['competition', 'category', 'verifier'])
            ->when($this->search, function ($query) {
                $query->where('question_text', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterCompetition, function ($query) {
                $query->where('competition_id', $this->filterCompetition);
            })
            ->when($this->filterCategory, function ($query) {
                $query->where('category_id', $this->filterCategory);
            })
            ->when($this->filterDifficulty, function ($query) {
                $query->where('difficulty_level', $this->filterDifficulty);
            })
            ->when($this->filterStatus, function ($query) {
                $query->where('validation_status', $this->filterStatus);
            })
            ->latest()
            ->paginate(10);

        $competitions = Competition::select('id', 'title')->get();
        $categories = Category::select('id', 'name')->get();

        return view('livewire.features.admin.question.question-index', [
            'questions' => $questions,
            'competitions' => $competitions,
            'categories' => $categories,
        ]);
    }
}
