<?php

namespace App\Livewire\Features\Admin\ListQualifier;

use App\Models\User;
use Livewire\Component;

class QualifierShow extends Component
{
    public User $qualifier;

    public function mount($id)
    {
        $this->qualifier = User::where('role', 'qualifier')
            ->with([
                'verifiedQuestions.competition',
                'verifiedParticipantAnswers.participant.user',
            ])
            ->withCount('verifiedQuestions', 'verifiedParticipantAnswers')
            ->findOrFail($id);
    }

    public function deleteQualifier()
    {
        $this->qualifier->delete();
        session()->flash('message', 'Qualifier berhasil dihapus.');
        return $this->redirect('/qualifier', navigate: true);
    }

    public function render()
    {
        return view('livewire.features.admin.list-qualifier.qualifier-show')
            ->layout('components.layouts.app');
    }
}
