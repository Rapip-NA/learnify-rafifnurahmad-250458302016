{{-- resources/views/livewire/competition-quiz.blade.php --}}
<div class="container" wire:poll.1s="checkTimer">

    @if($isFinished)
        {{-- ===================== QUIZ SELESAI ===================== --}}
        <div class="row justify-content-center">
            <div class="col-lg-6">

                <div class="card shadow text-center">
                    <div class="card-body">

                        <div class="mb-3">
                            <i class="bi bi-check-circle text-success" style="font-size: 3.5rem;"></i>
                        </div>

                        <h2 class="fw-bold mb-3">Kuis Selesai!</h2>

                        @if($timeExpired)
                            <div class="alert alert-warning">
                                ⏰ Waktu telah habis. Kuis diselesaikan secara otomatis.
                            </div>
                        @endif

                        <p class="text-muted mb-3">
                            Skor Anda:
                            <span class="fw-bold text-primary fs-3">{{ $participant->total_score }}</span>
                        </p>

                        <a href="{{ route('competition.result', $competition->id) }}"
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
                                    <i style="font-size: 1.5rem;" class="{{ $remainingSeconds < 300 ? 'text-danger' : 'text-primary' }}">
                                    </i>
                                    <div>
                                        <i class="bi bi-stopwatch font"></i>
                                    </div>


                                    <span class="fs-3 fw-bold
                                        {{ $remainingSeconds < 300 ? 'text-danger' : 'text-primary' }}">
                                        {{ sprintf('%02d:%02d', floor($remainingSeconds / 60), $remainingSeconds % 60) }}
                                    </span>
                                </div>

                                @if($remainingSeconds < 300)
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
                                    <div class="progress-bar bg-success"
                                         role="progressbar"
                                         style="width: {{ ($answeredCount / $totalQuestions) * 100 }}%">
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

                            @foreach($questions as $index => $q)
                                <button
                                    wire:click="goToQuestion({{ $index }})"
                                    class="btn fw-bold
                                    @if($currentQuestionIndex === $index)
                                        btn-primary text-white
                                    @elseif(isset($answers[$index]))
                                        btn-success text-white
                                    @else
                                        btn-outline-secondary
                                    @endif
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
        @if($currentQuestion)
            <div class="row justify-content-center">
                <div class="col-lg-10">

                    <div class="card shadow-lg">
                        <div class="card-body">

                            {{-- Tags --}}
                            <div class="d-flex justify-content-between mb-3">
                                <span class="badge bg-primary">
                                    {{ $currentQuestion->category->name ?? 'Umum' }}
                                </span>

                                <span class="badge
                                    @if($currentQuestion->difficulty_level === 'easy') bg-success
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
                            <div class="mb-4">
                                @foreach($currentQuestion->answers as $answer)
                                    <label class="d-flex align-items-start border rounded p-3 mb-2
                                        @if($selectedAnswer === $answer->id)
                                            border-primary bg-light
                                        @else
                                            border-secondary
                                        @endif
                                        ">
                                        <input type="radio"
                                               wire:click="selectAnswer({{ $answer->id }})"
                                               class="form-check-input me-3 mt-1"
                                               {{ $selectedAnswer === $answer->id ? 'checked' : '' }}>
                                        <span class="flex-grow-1">
                                            {{ $answer->answer_text }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>

                            {{-- Flash Messages --}}
                            @if(session()->has('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if(session()->has('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            {{-- Navigation Buttons --}}
                            <div class="d-flex justify-content-between">

                                {{-- PREVIOUS --}}
                                <button wire:click="previousQuestion"
                                        class="btn btn-outline-secondary px-4"
                                        @if($currentQuestionIndex === 0) disabled @endif>
                                    ← Sebelumnya
                                </button>

                                {{-- SAVE --}}
                                <button wire:click="submitAnswer"
                                        class="btn btn-primary px-5 fw-bold">
                                    Simpan Jawaban
                                </button>

                                {{-- NEXT / FINISH --}}
                                @if($currentQuestionIndex < $totalQuestions - 1)
                                    <button wire:click="nextQuestion"
                                            class="btn btn-outline-secondary px-4">
                                        Selanjutnya →
                                    </button>
                                @else
                                    <button wire:click="finishCompetition"
                                            class="btn btn-success px-4 fw-bold">
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
