<!-- Revisi Style Menggunakan Template Admin Mazer -->
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Detail Qualifier</h3>
                <p class="text-subtitle text-muted">Informasi lengkap mengenai qualifier.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.qualifier.index') }}">Qualifier</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Informasi Qualifier</h5>
                <div class="d-flex gap-2">
                    <button wire:click="deleteQualifier"
                        wire:confirm="Apakah Anda yakin ingin menghapus qualifier ini? Data tidak dapat dikembalikan!"
                        class="btn btn-danger btn-sm">Hapus</button>
                </div>
            </div>

            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="fw-bold">ID Qualifier</label>
                        <p>{{ $qualifier->id }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Nama Lengkap</label>
                        <p class="fw-semibold">{{ $qualifier->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Email</label>
                        <p>{{ $qualifier->email }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Role</label>
                        <span class="badge bg-primary">{{ ucfirst($qualifier->role) }}</span>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Terdaftar Sejak</label>
                        <p>{{ $qualifier->created_at->format('d F Y, H:i') }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Terakhir Diupdate</label>
                        <p>{{ $qualifier->updated_at->format('d F Y, H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik -->
        <div class="row">
            <div class="col-md-6">
                <div class="card bg-primary text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-white-50">Total Soal Diverifikasi</p>
                            <h2>{{ $qualifier->verified_questions_count }}</h2>
                        </div>
                        <div class="fs-1 opacity-50">📝</div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card bg-success text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-white-50">Total Jawaban Diverifikasi</p>
                            <h2>{{ $qualifier->verified_participant_answers_count }}</h2>
                        </div>
                        <div class="fs-1 opacity-50">✅</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Riwayat Verifikasi Soal -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Riwayat Verifikasi Soal</h5>
            </div>
            <div class="card-body">
                @if ($qualifier->verifiedQuestions->count() > 0)
                    @foreach ($qualifier->verifiedQuestions->take(10) as $question)
                        <div class="alert alert-light border mb-3">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="fw-bold">{{ $question->question_text }}</h6>
                                    <p class="small text-muted mb-0">🏆 {{ $question->competition->title ?? 'N/A' }} |
                                        ⭐ {{ $question->points }} | ⏱️ {{ $question->time_limit }} detik</p>
                                </div>
                                <span class="badge bg-success">Diverifikasi</span>
                            </div>
                        </div>
                    @endforeach

                    @if ($qualifier->verifiedQuestions->count() > 10)
                        <p class="text-center text-muted">Dan {{ $qualifier->verifiedQuestions->count() - 10 }} soal
                            lainnya...</p>
                    @endif
                @else
                    <p class="text-center text-muted">Belum memverifikasi soal apapun</p>
                @endif
            </div>
        </div>

        <!-- Riwayat Verifikasi Jawaban -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Riwayat Verifikasi Jawaban</h5>
            </div>
            <div class="card-body">
                @if ($qualifier->verifiedParticipantAnswers->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Peserta</th>
                                    <th>Status</th>
                                    <th>Poin</th>
                                    <th>Diverifikasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($qualifier->verifiedParticipantAnswers->take(15) as $answer)
                                    <tr>
                                        <td>{{ $answer->competitionParticipant->user->name ?? 'N/A' }}</td>
                                        <td>
                                            @if ($answer->is_correct)
                                                <span class="badge bg-success">Benar</span>
                                            @else
                                                <span class="badge bg-danger">Salah</span>
                                            @endif
                                        </td>
                                        <td class="fw-bold">{{ $answer->points_awarded ?? 0 }}</td>
                                        <td class="text-muted">
                                            {{ $answer->verified_at ? \Carbon\Carbon::parse($answer->verified_at)->format('d M Y') : '-' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if ($qualifier->verifiedParticipantAnswers->count() > 15)
                        <p class="text-center text-muted">Dan
                            {{ $qualifier->verifiedParticipantAnswers->count() - 15 }} jawaban lainnya...</p>
                    @endif
                @else
                    <p class="text-center text-muted">Belum memverifikasi jawaban apapun</p>
                @endif
            </div>
        </div>
    </section>
</div>
