<?php

namespace App\Livewire\Features\Admin\ListPeserta;

use App\Models\User;
use Livewire\Component;

class PesertaShow extends Component
{
    public User $peserta;

    public function mount($id)
    {
        $this->peserta = User::where('role', 'peserta')
            ->with([
                'competitionParticipants.competition',
                'leaderboards',
                'userBadges.badge'
            ])
            ->findOrFail($id);
    }

    public function deletePeserta()
    {
        $this->peserta->delete();
        session()->flash('message', 'Peserta berhasil dihapus.');
        return $this->redirect('/peserta', navigate: true);
    }

    public function render()
    {
        return view('livewire.features.admin.list-peserta.peserta-show');
    }
}
