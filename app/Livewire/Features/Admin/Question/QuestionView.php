<?php

namespace App\Livewire\Features\Admin\Question;

use App\Models\Question;
use Livewire\Component;

class QuestionView extends Component
{
    public $question;
    public $deleteId = null;

    public function mount($id)
    {
        $this->question = Question::with([
            'competition',
            'category',
            'verifier',
            'answers'
        ])->findOrFail($id);
    }

    public function confirmDelete()
    {
        $this->deleteId = $this->question->id;
    }

    public function delete()
    {
        if ($this->deleteId) {
            Question::find($this->deleteId)->delete();
            session()->flash('message', 'Question deleted successfully.');
            return redirect()->route('admin.questions.index');
        }
    }

    public function render()
    {
        return view('livewire.features.admin.question.question-view');
    }
}
