<div>
    <div class="page-heading">
    <h3>{{ $competition->title }}</h3>
</div>

<div class="page-content">

    @if($isFinished)
        {{-- FINISHED STATE --}}
        <section class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card text-center shadow">
                    <div class="card-body py-5">

                        <div class="text-success mb-3">
                            <i class="bi bi-check-circle-fill" style="font-size: 4rem;"></i>
                        </div>

                        <h2 class="fw-bold mb-2">🎉 Kompetisi Selesai!</h2>
                        <p class="text-muted">Skor Akhir Anda</p>

                        <h1 class="display-1 fw-bolder text-primary mb-4">
                            {{ $participant->total_score }}
                        </h1>

                        <a href="{{ route('competition.result', $competition->id) }}"
                           class="btn btn-primary btn-lg me-2">
                            Lihat Pembahasan
                        </a>

                        <a href="{{ route('competition.list') }}"
                           class="btn btn-secondary btn-lg">
                            Kembali ke Daftar
                        </a>

                    </div>
                </div>
            </div>
        </section>

    @else
        {{-- QUIZ STATE --}}

        <section class="row">

            {{-- NAVIGATION SIDEBAR --}}
            <div class="col-lg-3 mb-3">
                <div class="card shadow sticky-top" style="top: 80px;">
                    <div class="card-header">
                        <h5 class="mb-0">Navigasi Soal</h5>
                    </div>

                    <div class="card-body">

                        <div class="row g-2">
                            @foreach($questions as $index => $q)
                                <div class="col-3 col-lg-4">
                                    <button wire:click="goToQuestion({{ $index }})"
                                        class="btn btn-sm w-100
                                            {{ $currentQuestionIndex === $index ? 'btn-primary' :
                                                (isset($answers[$index]) ? 'btn-success' : 'btn-light border') }}">
                                        {{ $index + 1 }}
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        <hr>

                        <small class="text-muted">
                            <div class="d-flex align-items-center mb-1">
                                <span class="badge bg-primary me-2">&nbsp;</span> Sedang dijawab
                            </div>
                            <div class="d-flex align-items-center mb-1">
                                <span class="badge bg-success me-2">&nbsp;</span> Sudah dijawab
                            </div>
                            <div class="d-flex align-items-center mb-1">
                                <span class="badge bg-light border me-2">&nbsp;</span> Belum dijawab
                            </div>
                        </small>

                    </div>
                </div>
            </div>

            {{-- MAIN QUESTION CONTENT --}}
            <div class="col-lg-9">

                {{-- HEADER WITH PROGRESS --}}
                <div class="card shadow mb-4">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h4 class="fw-bold mb-0">{{ $competition->title }}</h4>

                            <span class="badge bg-secondary fs-6">
                                Soal {{ $currentQuestionIndex + 1 }} dari {{ $totalQuestions }}
                            </span>
                        </div>

                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-primary"
                                role="progressbar"
                                style="width: {{ $participant->progress_percentage }}%">
                            </div>
                        </div>

                        <p class="text-muted small mt-2">
                            Progress: {{ $answeredCount }} / {{ $totalQuestions }} dijawab
                        </p>

                    </div>
                </div>

                {{-- ALERTS --}}
                @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- QUESTION CARD --}}
                @if($currentQuestion)
                    <div class="card shadow">
                        <div class="card-body">

                            <div class="mb-3">
                                <span class="badge bg-primary me-2">
                                    {{ $currentQuestion->category->name }}
                                </span>
                                <span class="badge bg-purple">
                                    {{ ucfirst($currentQuestion->difficulty_level) }}
                                    - {{ $currentQuestion->point_weight }} poin
                                </span>
                            </div>

                            <h5 class="fw-bold mb-4">{{ $currentQuestion->question_text }}</h5>

                            {{-- ANSWERS --}}
                            @foreach($currentQuestion->answers as $answer)
                                <div class="form-check p-3 border rounded mb-2
                                    {{ $selectedAnswer == $answer->id ? 'border-primary bg-light' : '' }}">
                                    <input class="form-check-input"
                                           type="radio"
                                           wire:model="selectedAnswer"
                                           value="{{ $answer->id }}">
                                    <label class="form-check-label">
                                        {{ $answer->answer_text }}
                                    </label>
                                </div>
                            @endforeach

                            <hr>

                            <div class="d-flex justify-content-between">

                                <button wire:click="previousQuestion"
                                        class="btn btn-secondary"
                                        @if($currentQuestionIndex===0) disabled @endif>
                                    ← Sebelumnya
                                </button>

                                <button wire:click="submitAnswer"
                                        class="btn btn-success">
                                    Simpan Jawaban
                                </button>

                                @if($currentQuestionIndex < $totalQuestions - 1)
                                    <button wire:click="nextQuestion"
                                            class="btn btn-primary">
                                        Selanjutnya →
                                    </button>
                                @else
                                    <button wire:click="finishCompetition"
                                            class="btn btn-danger">
                                        🏁 Selesai
                                    </button>
                                @endif

                            </div>

                        </div>
                    </div>
                @endif

            </div>
        </section>

    @endif

</div>
    
</div>
