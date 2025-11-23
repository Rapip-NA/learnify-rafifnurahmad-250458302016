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
            @if ($competitions->isEmpty())
                <div class="card border-0 shadow-lg" style="overflow: hidden;">
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
                    @foreach ($competitions as $competition)
                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                            <div class="card border-0 h-100 shadow-lg"
                                style="
                                transition: all 0.3s ease;
                                overflow: hidden;
                                border-radius: 1rem;
                            "
                                onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 20px 40px rgba(0,0,0,0.15)';"
                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(0,0,0,0.08)';">

                                <!-- Header with gradient -->
                                <div class="card-header border-0 py-4"
                                    style="
                                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                                    position: relative;
                                    overflow: hidden;
                                ">
                                    <!-- Decorative circle -->
                                    <div
                                        style="position: absolute; width: 100px; height: 100px; background: rgba(255,255,255,0.1); border-radius: 50%; top: -30px; right: -20px;">
                                    </div>

                                    <h5 class="card-title text-white mb-0 fw-bold position-relative"
                                        style="font-size: 1.25rem;">
                                        {{ $competition->title }}
                                    </h5>
                                </div>

                                <div class="card-body d-flex flex-column">
                                    <p class="card-text text-muted mb-4" style="flex-grow: 1; font-size: 0.95rem;">
                                        {{ Str::limit($competition->description, 120) }}
                                    </p>

                                    <!-- Info section with better styling -->
                                    <div class="mb-4">
                                        <div class="d-flex align-items-center mb-3 p-3 rounded-3"
                                            style="background: linear-gradient(to right, #f8f9fa, #e9ecef);">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                                style="width: 40px; height: 40px; background: linear-gradient(135deg, #667eea, #764ba2);">
                                                <i class="bi bi-calendar-check text-white"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <small class="text-muted d-block"
                                                    style="font-size: 0.75rem;">Mulai</small>
                                                <strong
                                                    style="font-size: 0.9rem;">{{ $competition->start_date->format('d M Y H:i') }}</strong>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center mb-3 p-3 rounded-3"
                                            style="background: linear-gradient(to right, #f8f9fa, #e9ecef);">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                                style="width: 40px; height: 40px; background: linear-gradient(135deg, #f093fb, #f5576c);">
                                                <i class="bi bi-calendar-x text-white"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <small class="text-muted d-block"
                                                    style="font-size: 0.75rem;">Selesai</small>
                                                <strong
                                                    style="font-size: 0.9rem;">{{ $competition->end_date->format('d M Y H:i') }}</strong>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center p-3 rounded-3"
                                            style="background: linear-gradient(to right, #f8f9fa, #e9ecef);">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                                style="width: 40px; height: 40px; background: linear-gradient(135deg, #4facfe, #00f2fe);">
                                                <i class="bi bi-question-circle text-white"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <small class="text-muted d-block" style="font-size: 0.75rem;">Jumlah
                                                    Soal</small>
                                                <strong
                                                    style="font-size: 0.9rem;">{{ $competition->questions->count() }}
                                                    Pertanyaan</strong>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Action button -->
                                    @if (in_array($competition->id, $myParticipations))
                                        <a href="{{ route('peserta.competitions.quiz', $competition->id) }}"
                                            class="btn btn-lg w-100 fw-semibold rounded-pill shadow-sm"
                                            style="
                                            background: linear-gradient(135deg, #11998e, #38ef7d);
                                            color: white;
                                            border: none;
                                            padding: 0.75rem 1.5rem;
                                            transition: all 0.3s ease;
                                        "
                                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(17, 153, 142, 0.4)';"
                                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.1)';">
                                            <i class="bi bi-arrow-right-circle-fill me-2"></i>
                                            Lanjutkan Quiz
                                        </a>
                                    @else
                                        <button wire:click="startCompetition({{ $competition->id }})"
                                            class="btn btn-lg w-100 fw-semibold rounded-pill shadow-sm"
                                            style="
                                            background: linear-gradient(135deg, #667eea, #764ba2);
                                            color: white;
                                            border: none;
                                            padding: 0.75rem 1.5rem;
                                            transition: all 0.3s ease;
                                        "
                                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(102, 126, 234, 0.4)';"
                                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.1)';">
                                            <i class="bi bi-play-circle-fill me-2"></i>
                                            Mulai Kompetisi
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
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
