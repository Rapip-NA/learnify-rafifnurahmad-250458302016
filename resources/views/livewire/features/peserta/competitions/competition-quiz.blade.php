{{-- resources/views/livewire/competition-quiz.blade.php --}}
<div class="container" wire:poll.1s="checkTimer">

    @if ($isFinished)
        {{-- ===================== QUIZ SELESAI ===================== --}}
        <div class="row justify-content-center">
            <div class="col-lg-6">

                <div class="card shadow text-center">
                    <div class="card-body">

                        <div class="mb-3">
                            <i class="bi bi-check-circle text-success" style="font-size: 3.5rem;"></i>
                        </div>

                        <h2 class="fw-bold mb-3">Kuis Selesai!</h2>

                        @if ($timeExpired)
                            <div class="alert alert-warning">
                                ⏰ Waktu telah habis. Kuis diselesaikan secara otomatis.
                            </div>
                        @endif

                        <p class="text-muted mb-3">
                            Skor Anda:
                            <span class="fw-bold text-primary fs-3">{{ $participant->total_score }}</span>
                        </p>

                        <a href="{{ route('peserta.competitions.result', $competition->id) }}"
                            class="btn btn-primary px-4">
                            Lihat Detail Hasil
                        </a>

                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- ===================== HEADER + TIMER ===================== --}}
        <div class="row justify-content-center mb-4">
            <div class="col-lg-10">
                <div class="card shadow-sm">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            {{-- TITLE --}}
                            <div>
                                <h4 class="fw-bold mb-1">{{ $competition->title }}</h4>
                                <small class="text-muted">
                                    Soal {{ $currentQuestionIndex + 1 }} dari {{ $totalQuestions }}
                                </small>
                            </div>

                            {{-- TIMER --}}
                            <div class="text-center">
                                <small class="text-muted">Sisa Waktu</small>

                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <i style="font-size: 1.5rem;"
                                        class="{{ $remainingSeconds < 300 ? 'text-danger' : 'text-primary' }}">
                                    </i>
                                    <div>
                                        <i class="bi bi-stopwatch font"></i>
                                    </div>


                                    <span
                                        class="fs-3 fw-bold
                                        {{ $remainingSeconds < 300 ? 'text-danger' : 'text-primary' }}">
                                        {{ sprintf('%02d:%02d', floor($remainingSeconds / 60), $remainingSeconds % 60) }}
                                    </span>
                                </div>

                                @if ($remainingSeconds < 300)
                                    <small class="text-danger fw-semibold">
                                        ⚠️ Waktu hampir habis!
                                    </small>
                                @endif
                            </div>

                            {{-- PROGRESS --}}
                            <div class="text-center" style="width: 140px;">
                                <small class="text-muted">Progress</small>
                                <div class="fw-bold fs-5 text-success">
                                    {{ $answeredCount }}/{{ $totalQuestions }}
                                </div>

                                <div class="progress mt-1" style="height: 6px;">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{ $totalQuestions > 0 ? ($answeredCount / $totalQuestions) * 100 : 0 }}%">
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- ===================== NAVIGASI SOAL ===================== --}}
        <div class="row justify-content-center mb-4">
            <div class="col-lg-10">
                <div class="card shadow-sm">
                    <div class="card-body">

                        <small class="text-muted">Navigasi Soal:</small>

                        <div class="d-flex flex-wrap gap-2 mt-2">

                            @foreach ($questions as $index => $q)
                                <button wire:click="goToQuestion({{ $index }})"
                                    class="btn fw-bold
                                    @if ($currentQuestionIndex === $index) btn-primary text-white
                                    @elseif(isset($answers[$index]))
                                        btn-success text-white
                                    @else
                                        btn-outline-secondary @endif
                                    "
                                    style="width: 50px; height: 50px;">
                                    {{ $index + 1 }}
                                </button>
                            @endforeach

                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- ===================== QUESTION CARD ===================== --}}
        @if ($currentQuestion)
            <div class="row justify-content-center">
                <div class="col-lg-10">

                    <div class="card shadow-lg">
                        <div class="card-body">

                            {{-- Tags --}}
                            <div class="d-flex justify-content-between mb-3">
                                <span class="badge bg-primary">
                                    {{ $currentQuestion->category->name ?? 'Umum' }}
                                </span>

                                <span
                                    class="badge
                                    @if ($currentQuestion->difficulty_level === 'easy') bg-success
                                    @elseif($currentQuestion->difficulty_level === 'medium') bg-warning
                                    @else bg-danger @endif">
                                    {{ ucfirst($currentQuestion->difficulty_level) }}
                                    • {{ $currentQuestion->point_weight }} poin
                                </span>
                            </div>

                            {{-- Question Text --}}
                            <h5 class="fw-bold mb-4">
                                {{ $currentQuestion->question_text }}
                            </h5>

                            {{-- Answer Options --}}
                            <div class="mb-4" wire:key="question-{{ $currentQuestion->id }}">
                                @if ($currentQuestion->question_type === 'essay')
                                    {{-- Essay Answer Textarea --}}
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Tulis Jawaban Anda:</label>
                                        <textarea wire:model="essayAnswerText" rows="8" class="form-control"
                                            placeholder="Ketik jawaban essay Anda di sini..." style="font-size: 1rem;"></textarea>
                                        <small class="text-muted">
                                            <i class="bi bi-info-circle"></i>
                                            Jawaban essay akan dinilai oleh admin. Tulis dengan lengkap dan jelas.
                                        </small>
                                    </div>
                                @else
                                    {{-- Multiple Choice Options --}}
                                    @foreach ($currentQuestion->answers as $answer)
                                        <label
                                            class="d-flex align-items-start border rounded p-3 mb-2
                                            @if ($selectedAnswer === $answer->id) border-primary bg-light
                                            @else
                                                border-secondary @endif
                                            "
                                            wire:key="answer-{{ $answer->id }}">
                                            <input type="radio" name="question_{{ $currentQuestion->id }}"
                                                value="{{ $answer->id }}"
                                                wire:click="selectAnswer({{ $answer->id }})"
                                                class="form-check-input me-3 mt-1"
                                                @if ($selectedAnswer === $answer->id) checked @endif>
                                            <span class="flex-grow-1">
                                                {{ $answer->answer_text }}
                                            </span>
                                        </label>
                                    @endforeach
                                @endif
                            </div>

                            {{-- Flash Messages --}}
                            @if (session()->has('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session()->has('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            {{-- Navigation Buttons --}}
                            <div class="d-flex justify-content-between">

                                {{-- PREVIOUS --}}
                                <button wire:click="previousQuestion" class="btn btn-outline-secondary px-4"
                                    @if ($currentQuestionIndex === 0) disabled @endif>
                                    ← Sebelumnya
                                </button>

                                {{-- NEXT / FINISH --}}
                                @if ($currentQuestionIndex < $totalQuestions - 1)
                                    <button wire:click="nextQuestion" class="btn btn-primary px-4 fw-bold">
                                        Selanjutnya →
                                    </button>
                                @else
                                    <button wire:click="finishCompetition" class="btn btn-success px-4 fw-bold">
                                        Selesai
                                    </button>
                                @endif

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        @endif

    @endif
</div>

@push('scripts')
    <script>
        // Show success notification when competition is started
        @if (session('competition_started'))
            Swal.fire({
                title: '<strong>Kompetisi Dimulai!</strong>',
                html: `
                <div class="text-start">
                    <p class="text-muted mb-3">Timer sudah berjalan. Selamat mengerjakan!</p>
                    <div class="alert alert-success" style="font-size: 0.9rem;">
                        <i class="bi bi-check-circle me-2"></i>
                        <strong>Tips:</strong>
                        <ul class="mt-2 mb-0 ps-3">
                            <li>Perhatikan sisa waktu di bagian atas</li>
                            <li>Jawaban otomatis tersimpan saat berpindah soal</li>
                            <li>Anda dapat menavigasi antar soal menggunakan tombol navigasi</li>
                        </ul>
                    </div>
                </div>
            `,
                icon: 'success',
                confirmButtonText: '<i class="bi bi-play-fill me-1"></i> Mulai Mengerjakan',
                confirmButtonColor: '#11998e',
                customClass: {
                    confirmButton: 'btn btn-lg px-4'
                },
                allowOutsideClick: false,
                allowEscapeKey: false
            });
        @endif
    </script>
@endpush
