<div>
    <div>
        <div class="page-heading mb-4">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3 class="mb-2">
                            <i class="bi bi-trophy-fill text-warning me-2"></i>
                            Daftar Kompetisi
                        </h3>
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
        </div>


        <section class="section">
            {{-- Tabs Navigation --}}
            <ul class="nav nav-pills mb-4" id="competitionTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="active-tab" data-bs-toggle="pill" data-bs-target="#active"
                        type="button" role="tab" aria-controls="active" aria-selected="true">
                        <i class="bi bi-lightning-charge-fill me-2"></i>
                        Kompetisi Aktif
                        <span class="badge bg-success ms-2">{{ $activeCompetitions->count() }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="draft-tab" data-bs-toggle="pill" data-bs-target="#draft" type="button"
                        role="tab" aria-controls="draft" aria-selected="false">
                        <i class="bi bi-clock-history me-2"></i>
                        Segera Hadir
                        <span class="badge bg-info ms-2">{{ $draftCompetitions->count() }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="inactive-tab" data-bs-toggle="pill" data-bs-target="#inactive"
                        type="button" role="tab" aria-controls="inactive" aria-selected="false">
                        <i class="bi bi-archive-fill me-2"></i>
                        Sudah Berakhir
                        <span class="badge bg-secondary ms-2">{{ $inactiveCompetitions->count() }}</span>
                    </button>
                </li>
            </ul>

            {{-- Tabs Content --}}
            <div class="tab-content" id="competitionTabsContent">
                {{-- Active Competitions Tab --}}
                <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="active-tab">
                    @if ($activeCompetitions->isEmpty())
                        <div class="card border-0 shadow-lg">
                            <div class="card-body text-center py-5">
                                <div class="mb-4">
                                    <i class="bi bi-trophy text-warning" style="font-size: 5rem; opacity: 0.3;"></i>
                                </div>
                                <h5 class="text-muted mb-2">Belum ada kompetisi yang aktif</h5>
                                <p class="text-muted small">Kompetisi baru akan segera hadir. Stay tuned!</p>
                            </div>
                        </div>
                    @else
                        <div class="row match-height">
                            @foreach ($activeCompetitions as $competition)
                                @include(
                                    'livewire.features.peserta.competitions.partials.competition-card',
                                    [
                                        'competition' => $competition,
                                        'statusClass' => 'active',
                                    ]
                                )
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Draft Competitions Tab --}}
                <div class="tab-pane fade" id="draft" role="tabpanel" aria-labelledby="draft-tab">
                    @if ($draftCompetitions->isEmpty())
                        <div class="card border-0 shadow-lg">
                            <div class="card-body text-center py-5">
                                <div class="mb-4">
                                    <i class="bi bi-calendar-event text-info"
                                        style="font-size: 5rem; opacity: 0.3;"></i>
                                </div>
                                <h5 class="text-muted mb-2">Belum ada kompetisi yang akan datang</h5>
                                <p class="text-muted small">Kompetisi baru akan segera dijadwalkan!</p>
                            </div>
                        </div>
                    @else
                        <div class="row match-height">
                            @foreach ($draftCompetitions as $competition)
                                @include(
                                    'livewire.features.peserta.competitions.partials.competition-card',
                                    [
                                        'competition' => $competition,
                                        'statusClass' => 'draft',
                                    ]
                                )
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Inactive Competitions Tab --}}
                <div class="tab-pane fade" id="inactive" role="tabpanel" aria-labelledby="inactive-tab">
                    @if ($inactiveCompetitions->isEmpty())
                        <div class="card border-0 shadow-lg">
                            <div class="card-body text-center py-5">
                                <div class="mb-4">
                                    <i class="bi bi-archive text-secondary" style="font-size: 5rem; opacity: 0.3;"></i>
                                </div>
                                <h5 class="text-muted mb-2">Belum ada kompetisi yang berakhir</h5>
                                <p class="text-muted small">Kompetisi yang sudah selesai akan muncul di sini.</p>
                            </div>
                        </div>
                    @else
                        <div class="row match-height">
                            @foreach ($inactiveCompetitions as $competition)
                                @include(
                                    'livewire.features.peserta.competitions.partials.competition-card',
                                    [
                                        'competition' => $competition,
                                        'statusClass' => 'inactive',
                                    ]
                                )
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>

    <style>
        /* Add smooth animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: fadeInUp 0.5s ease-out;
        }
    </style>
</div>
