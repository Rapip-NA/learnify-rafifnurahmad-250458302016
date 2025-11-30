<?php

namespace App\Livewire\Features\Peserta\Competitions;

use App\Models\Competition;
use App\Models\CompetitionParticipant;
use Livewire\Component;

class CompetitionList extends Component
{
    public function render()
    {
        // Auto-update expired competitions to inactive status
        Competition::whereIn('status', ['active', 'draft'])
            ->where('end_date', '<', now())
            ->update(['status' => 'inactive']);

        // Fetch draft competitions (upcoming, not yet started)
        $draftCompetitions = Competition::where('status', 'draft')
            ->with(['questions' => function ($q) {
                $q->where('validation_status', 'approved');
            }])
            ->orderBy('start_date', 'asc')
            ->get();

        // Fetch active competitions (currently ongoing)
        $activeCompetitions = Competition::where('status', 'active')
            ->where('end_date', '>=', now())
            ->with(['questions' => function ($q) {
                $q->where('validation_status', 'approved');
            }])
            ->orderBy('start_date', 'asc')
            ->get();

        // Fetch inactive competitions (past end date or manually closed)
        $inactiveCompetitions = Competition::where(function ($query) {
                $query->where('status', 'inactive')
                      ->orWhere('end_date', '<', now());
            })
            ->with(['questions' => function ($q) {
                $q->where('validation_status', 'approved');
            }])
            ->orderBy('end_date', 'desc')
            ->get();

        $myParticipations = CompetitionParticipant::where('user_id', auth()->id())
            ->pluck('competition_id')
            ->toArray();

        // Get completed competitions (where finished_at is not null)
        $completedCompetitions = CompetitionParticipant::where('user_id', auth()->id())
            ->whereNotNull('finished_at')
            ->pluck('competition_id')
            ->toArray();

        return view('livewire.features.peserta.competitions.competition-list', [
            'draftCompetitions' => $draftCompetitions,
            'activeCompetitions' => $activeCompetitions,
            'inactiveCompetitions' => $inactiveCompetitions,
            'myParticipations' => $myParticipations,
            'completedCompetitions' => $completedCompetitions,
        ]);
    }

    public function startCompetition($competitionId)
    {
        $competition = Competition::with(['questions' => function ($q) {
            $q->where('validation_status', 'approved');
        }])->findOrFail($competitionId);

        // Validasi 1: Cek apakah kompetisi masih aktif
        if ($competition->status !== 'active') {
            $this->dispatch('showValidationError', [
                'title' => 'Kompetisi Tidak Aktif',
                'message' => 'Kompetisi ini saat ini tidak dapat diikuti. Status: ' . ucfirst($competition->status)
            ]);
            return;
        }

        // Validasi 2: Cek apakah kompetisi sudah dimulai
        if ($competition->start_date > now()) {
            $this->dispatch('showValidationError', [
                'title' => 'Kompetisi Belum Dimulai',
                'message' => 'Kompetisi ini akan dimulai pada ' . $competition->start_date->format('d M Y H:i')
            ]);
            return;
        }

        // Validasi 3: Cek apakah kompetisi sudah berakhir
        if ($competition->end_date < now()) {
            $this->dispatch('showValidationError', [
                'title' => 'Kompetisi Sudah Berakhir',
                'message' => 'Mohon maaf, kompetisi ini sudah berakhir pada ' . $competition->end_date->format('d M Y H:i')
            ]);
            return;
        }

        // Validasi 4: Cek apakah kompetisi memiliki soal
        $questionCount = $competition->questions->count();
        if ($questionCount === 0) {
            $this->dispatch('showValidationError', [
                'title' => 'Tidak Ada Soal',
                'message' => 'Kompetisi ini belum memiliki soal yang tersedia. Silakan hubungi administrator.'
            ]);
            return;
        }

        // Validasi 5: Cek apakah peserta sudah pernah mengikuti dan menyelesaikan kompetisi
        $participant = CompetitionParticipant::where('user_id', auth()->id())
            ->where('competition_id', $competitionId)
            ->first();

        if ($participant && $participant->finished_at) {
            $this->dispatch('showValidationError', [
                'title' => 'Sudah Menyelesaikan Quiz',
                'message' => 'Anda sudah menyelesaikan kompetisi ini. Silakan lihat hasil Anda di halaman history.',
                'showHistoryButton' => true,
                'competitionId' => $competitionId
            ]);
            return;
        }

        // Jika sudah pernah mulai tapi belum selesai, langsung redirect ke quiz
        if ($participant && !$participant->finished_at) {
            $this->dispatch('showContinueMessage', [
                'title' => 'Lanjutkan Quiz',
                'message' => 'Anda sudah memulai kompetisi ini sebelumnya. Klik "Ya, Lanjutkan!" untuk melanjutkan.'
            ]);
            
            // Auto redirect after showing message
            return redirect()->route('peserta.competitions.quiz', $competitionId);
        }

        // Jika belum pernah ikut, buat participant baru
        CompetitionParticipant::create([
            'user_id' => auth()->id(),
            'competition_id' => $competitionId,
            'started_at' => now(),
            'total_score' => 0,
            'progress_percentage' => 0,
        ]);

        // Redirect ke halaman quiz dengan notifikasi sukses
        session()->flash('competition_started', true);
        return redirect()->route('peserta.competitions.quiz', $competitionId);
    }
}
