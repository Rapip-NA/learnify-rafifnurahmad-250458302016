<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Kompetisi</h3>
                <p class="text-subtitle text-muted">Temukan dan ikuti kompetisi yang tersedia.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Daftar Kompetisi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        @if($competitions->isEmpty())
        <div class="alert alert-warning text-center">
            <p class="mb-0"><i class="bi bi-exclamation-triangle-fill me-2"></i>Belum ada kompetisi yang aktif saat ini.
            </p>
        </div>
        @else
        <div class="row match-height">
            @foreach($competitions as $competition)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-content">
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $competition->title }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($competition->description, 100) }}</p>

                            <div class="mt-4 mb-4">
                                <ul class="list-group list-group-flush">
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center p-0 pt-2 pb-2">
                                        <strong><i class="bi bi-calendar-check me-2"></i>Mulai:</strong>
                                        <span>{{ $competition->start_date->format('d M Y H:i') }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center p-0 pt-2 pb-2">
                                        <strong><i class="bi bi-calendar-x me-2"></i>Selesai:</strong>
                                        <span>{{ $competition->end_date->format('d M Y H:i') }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center p-0 pt-2 pb-2">
                                        <strong><i class="bi bi-question-circle me-2"></i>Jumlah Soal:</strong>
                                        <span class="badge bg-light-primary text-primary">{{
                                            $competition->questions->count() }}</span>
                                    </li>
                                </ul>
                            </div>

                            @if(in_array($competition->id, $myParticipations))
                            <a href="{{ route('competition.quiz', $competition->id) }}"
                                class="btn btn-success btn-block mt-3">
                                <i class="bi bi-arrow-right-circle-fill me-2"></i>Lanjutkan
                            </a>
                            @else
                            <button wire:click="startCompetition({{ $competition->id }})"
                                class="btn btn-primary btn-block mt-3">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Mulai Kompetisi
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </section>
</div>
