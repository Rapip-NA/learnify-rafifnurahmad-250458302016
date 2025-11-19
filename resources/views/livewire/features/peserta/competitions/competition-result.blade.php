<div>
    <div class="page-heading">
    <h3>Hasil Kompetisi</h3>
</div>

<div class="page-content">

    {{-- HEADER --}}
    <div class="card shadow mb-4">
        <div class="card-body">

            <h2 class="fw-bold mb-2">{{ $competition->title }}</h2>

            <div class="row g-3 mt-4">
                <div class="col-md-4">
                    <div class="card text-center bg-light border-0 shadow-sm">
                        <div class="card-body">
                            <p class="text-muted small mb-1">Total Skor</p>
                            <h2 class="text-primary fw-bolder mb-0">{{ $participant->total_score }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card text-center bg-light border-0 shadow-sm">
                        <div class="card-body">
                            <p class="text-muted small mb-1">Jawaban Benar</p>
                            <h2 class="text-success fw-bolder mb-0">{{ $correctAnswers }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card text-center bg-light border-0 shadow-sm">
                        <div class="card-body">
                            <p class="text-muted small mb-1">Jawaban Salah</p>
                            <h2 class="text-danger fw-bolder mb-0">{{ $wrongAnswers }}</h2>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- REVIEW JAWABAN --}}
    @foreach($answers as $index => $participantAnswer)
        <div class="card shadow mb-4">
            <div class="card-body">

                {{-- Badge Info --}}
                <div class="d-flex justify-content-between align-items-start mb-3">

                    <div>
                        <span class="badge bg-secondary">
                            Soal {{ $index + 1 }}
                        </span>

                        <span class="badge bg-primary ms-2">
                            {{ $participantAnswer->question->category->name }}
                        </span>
                    </div>

                    {{-- Status Benar / Salah --}}
                    @if($participantAnswer->is_correct)
                        <span class="badge bg-success d-flex align-items-center px-3 py-2">
                            <i class="bi bi-check-circle me-1"></i> Benar
                        </span>
                    @else
                        <span class="badge bg-danger d-flex align-items-center px-3 py-2">
                            <i class="bi bi-x-circle me-1"></i> Salah
                        </span>
                    @endif

                </div>

                {{-- SOAL --}}
                <h5 class="fw-bold mb-4">{{ $participantAnswer->question->question_text }}</h5>

                {{-- DAFTAR JAWABAN --}}
                @foreach($participantAnswer->question->answers as $answer)
                    <div class="p-3 rounded border mb-2
                        @if($answer->is_correct)
                            border-success bg-success bg-opacity-10
                        @elseif($answer->id == $participantAnswer->answer_id)
                            border-danger bg-danger bg-opacity-10
                        @else
                            border-light bg-light
                        @endif
                    ">

                        <div class="d-flex align-items-start">

                            {{-- Ikon --}}
                            @if($answer->is_correct)
                                <i class="bi bi-check-circle text-success fs-5 me-2 mt-1"></i>
                            @elseif($answer->id == $participantAnswer->answer_id)
                                <i class="bi bi-x-circle text-danger fs-5 me-2 mt-1"></i>
                            @else
                                <div class="me-3" style="width: 22px;"></div>
                            @endif

                            {{-- Teks jawaban --}}
                            <div class="flex-grow-1">
                                {{ $answer->answer_text }}
                            </div>

                            {{-- Label --}}
                            @if($answer->is_correct)
                                <span class="badge bg-success ms-2">Jawaban Benar</span>
                            @elseif($answer->id == $participantAnswer->answer_id)
                                <span class="badge bg-danger ms-2">Jawaban Anda</span>
                            @endif

                        </div>

                    </div>
                @endforeach

                {{-- Detail --}}
                <div class="mt-3 text-muted small">
                    Bobot: {{ $participantAnswer->question->point_weight }} poin |
                    Waktu: {{ $participantAnswer->time_spent }} detik
                </div>

            </div>
        </div>
    @endforeach

    {{-- BACK BUTTON --}}
    <div class="text-center mt-4">
        <a href="{{ route('competition.list') }}" class="btn btn-primary btn-lg">
            <i class="bi bi-arrow-left-circle me-1"></i>
            Kembali ke Daftar Kompetisi
        </a>
    </div>

</div>

</div>
