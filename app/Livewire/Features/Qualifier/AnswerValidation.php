<?php

namespace App\Livewire\Features\Qualifier;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\ParticipantAnswer;
use App\Models\Competition;
use Illuminate\Support\Facades\Auth;

class AnswerValidation extends Component
{
    use WithPagination;

    #[Layout('components.layouts.app')]
    #[Title('Answer Validation')]

    public $statusFilter = 'pending';
    public $competitionFilter = '';
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingCompetitionFilter()
    {
        $this->resetPage();
    }

    public function approveAnswer($answerId)
    {
        $answer = ParticipantAnswer::find($answerId);
        
        if ($answer) {
            $answer->update([
                'validation_status' => 'approved',
                'verified_by' => Auth::id(),
            ]);
            
            session()->flash('success', 'Jawaban berhasil disetujui');
        }
    }

    public function rejectAnswer($answerId)
    {
        $answer = ParticipantAnswer::find($answerId);
        
        if ($answer) {
            $answer->update([
                'validation_status' => 'rejected',
                'verified_by' => Auth::id(),
            ]);
            
            session()->flash('success', 'Jawaban berhasil ditolak');
        }
    }

    public function getStatistics()
    {
        return [
            'pending' => ParticipantAnswer::where('validation_status', 'pending')->count(),
            'approved' => ParticipantAnswer::where('validation_status', 'approved')->count(),
            'rejected' => ParticipantAnswer::where('validation_status', 'rejected')->count(),
        ];
    }

    public function render()
    {
        $answers = ParticipantAnswer::with([
                'competitionParticipant.user',
                'competitionParticipant.competition',
                'question',
                'answer',
                'verifier'
            ])
            ->when($this->statusFilter && $this->statusFilter !== 'all', function ($query) {
                $query->where('validation_status', $this->statusFilter);
            })
            ->when($this->competitionFilter, function ($query) {
                $query->whereHas('competitionParticipant', function ($q) {
                    $q->where('competition_id', $this->competitionFilter);
                });
            })
            ->when($this->search, function ($query) {
                $query->whereHas('competitionParticipant.user', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $competitions = Competition::orderBy('title')->get();
        $statistics = $this->getStatistics();

        return view('livewire.features.qualifier.answer-validation', [
            'answers' => $answers,
            'competitions' => $competitions,
            'statistics' => $statistics,
        ]);
    }
}
