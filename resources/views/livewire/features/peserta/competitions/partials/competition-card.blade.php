<!-- Competition Card Component -->
<div class="col-12 col-md-6 col-lg-4 mb-4">
    <div class="card border-0 h-100 shadow-lg"
        style="
        transition: all 0.3s ease;
        overflow: hidden;
        border-radius: 1rem;
        @if ($statusClass === 'inactive') opacity: 0.85; @endif
    "
        onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 20px 40px rgba(0,0,0,0.15)';"
        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(0,0,0,0.08)';">

        {{-- Header with gradient --}}
        <div class="card-header border-0 py-4"
            style="
            background: 
                @if ($statusClass === 'active') linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
                @elseif($statusClass === 'draft') linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                @else linear-gradient(135deg, #6c757d 0%, #495057 100%); @endif
            position: relative;
            overflow: hidden;
        ">
            {{-- Decorative circle --}}
            <div
                style="position: absolute; width: 100px; height: 100px; background: rgba(255,255,255,0.1); border-radius: 50%; top: -30px; right: -20px;">
            </div>

            <h5 class="card-title text-white mb-0 fw-bold position-relative" style="font-size: 1.25rem;">
                {{ $competition->title }}
            </h5>

            {{-- Status Badge --}}
            @if ($statusClass === 'draft')
                <span class="badge bg-light text-dark mt-2">
                    <i class="bi bi-clock me-1"></i> Segera Hadir
                </span>
            @elseif($statusClass === 'inactive')
                <span class="badge bg-light text-dark mt-2">
                    <i class="bi bi-archive me-1"></i> Sudah Berakhir
                </span>
            @endif
        </div>

        <div class="card-body d-flex flex-column">
            <p class="card-text text-muted mb-4" style="flex-grow: 1; font-size: 0.95rem;">
                {{ Str::limit($competition->description, 120) }}
            </p>

            {{-- Info section --}}
            <div class="mb-4">
                <div class="d-flex align-items-center mb-3 p-3 rounded-3"
                    style="background: linear-gradient(to right, #f8f9fa, #e9ecef);">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                        style="width: 40px; height: 40px; background: linear-gradient(135deg, #667eea, #764ba2);">
                        <i class="bi bi-calendar-check text-white"></i>
                    </div>
                    <div class="flex-grow-1">
                        <small class="text-muted d-block" style="font-size: 0.75rem;">Mulai</small>
                        <strong style="font-size: 0.9rem;">{{ $competition->start_date->format('d M Y H:i') }}</strong>
                    </div>
                </div>

                <div class="d-flex align-items-center mb-3 p-3 rounded-3"
                    style="background: linear-gradient(to right, #f8f9fa, #e9ecef);">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                        style="width: 40px; height: 40px; background: linear-gradient(135deg, #f093fb, #f5576c);">
                        <i class="bi bi-calendar-x text-white"></i>
                    </div>
                    <div class="flex-grow-1">
                        <small class="text-muted d-block" style="font-size: 0.75rem;">Selesai</small>
                        <strong style="font-size: 0.9rem;">{{ $competition->end_date->format('d M Y H:i') }}</strong>
                    </div>
                </div>

                <div class="d-flex align-items-center p-3 rounded-3"
                    style="background: linear-gradient(to right, #f8f9fa, #e9ecef);">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                        style="width: 40px; height: 40px; background: linear-gradient(135deg, #4facfe, #00f2fe);">
                        <i class="bi bi-question-circle text-white"></i>
                    </div>
                    <div class="flex-grow-1">
                        <small class="text-muted d-block" style="font-size: 0.75rem;">Jumlah Soal</small>
                        <strong style="font-size: 0.9rem;">{{ $competition->questions->count() }} Pertanyaan</strong>
                    </div>
                </div>
            </div>

            {{-- Action button based on status --}}
            @if ($statusClass === 'draft')
                {{-- Draft: Coming Soon Button (Disabled) --}}
                <button disabled class="btn btn-lg w-100 fw-semibold rounded-pill shadow-sm"
                    style="
                    background: linear-gradient(135deg, #667eea, #764ba2);
                    color: white;
                    border: none;
                    padding: 0.75rem 1.5rem;
                    opacity: 0.6;
                    cursor: not-allowed;
                ">
                    <i class="bi bi-hourglass-split me-2"></i>
                    Segera Hadir
                </button>
            @elseif($statusClass === 'inactive')
                {{-- Inactive: History or Closed --}}
                @if (in_array($competition->id, $completedCompetitions))
                    <a href="{{ route('peserta.competitions.result', $competition->id) }}"
                        class="btn btn-lg w-100 fw-semibold rounded-pill shadow-sm"
                        style="
                        background: linear-gradient(135deg, #4facfe, #00f2fe);
                        color: white;
                        border: none;
                        padding: 0.75rem 1.5rem;
                        transition: all 0.3s ease;
                    "
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(79, 172, 254, 0.4)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.1)';">
                        <i class="bi bi-clock-history me-2"></i>
                        Lihat History
                    </a>
                @else
                    <button disabled class="btn btn-lg w-100 fw-semibold rounded-pill shadow-sm"
                        style="
                        background: linear-gradient(135deg, #6c757d, #495057);
                        color: white;
                        border: none;
                        padding: 0.75rem 1.5rem;
                        opacity: 0.6;
                        cursor: not-allowed;
                    ">
                        <i class="bi bi-x-circle me-2"></i>
                        Sudah Berakhir
                    </button>
                @endif
            @else
                {{-- Active: Standard Buttons --}}
                @if (in_array($competition->id, $completedCompetitions))
                    <a href="{{ route('peserta.competitions.result', $competition->id) }}"
                        class="btn btn-lg w-100 fw-semibold rounded-pill shadow-sm"
                        style="
                        background: linear-gradient(135deg, #4facfe, #00f2fe);
                        color: white;
                        border: none;
                        padding: 0.75rem 1.5rem;
                        transition: all 0.3s ease;
                    "
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(79, 172, 254, 0.4)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.1)';">
                        <i class="bi bi-clock-history me-2"></i>
                        Lihat History
                    </a>
                @elseif (in_array($competition->id, $myParticipations))
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
                    <button onclick="confirmStartCompetition({{ $competition->id }})"
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
            @endif
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // Listen for validation error events from backend
        window.addEventListener('showValidationError', event => {
            const data = event.detail[0];

            let htmlContent = `
                <div class="text-start">
                    <p class="text-muted mb-3">${data.message}</p>
                </div>
            `;

            // If there's a history button to show
            if (data.showHistoryButton && data.competitionId) {
                htmlContent += `
                    <div class="text-center mt-3">
                        <a href="/peserta/competitions/${data.competitionId}/result" 
                           class="btn btn-primary btn-lg px-4">
                            <i class="bi bi-clock-history me-2"></i> Lihat History
                        </a>
                    </div>
                `;
            }

            Swal.fire({
                title: `<strong>${data.title}</strong>`,
                html: htmlContent,
                icon: 'error',
                confirmButtonText: '<i class="bi bi-check-circle me-1"></i> Mengerti',
                confirmButtonColor: '#dc3545',
                customClass: {
                    confirmButton: 'btn btn-lg px-4'
                }
            });
        });

        // Listen for continue message events
        window.addEventListener('showContinueMessage', event => {
            const data = event.detail[0];

            Swal.fire({
                title: `<strong>${data.title}</strong>`,
                html: `
                    <div class="text-start">
                        <p class="text-muted mb-3">${data.message}</p>
                        <div class="alert alert-info" style="font-size: 0.9rem;">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Info:</strong> Progress Anda telah tersimpan dan akan dilanjutkan.
                        </div>
                    </div>
                `,
                icon: 'info',
                confirmButtonText: '<i class="bi bi-play-fill me-1"></i> Ya, Lanjutkan!',
                confirmButtonColor: '#11998e',
                showCancelButton: false,
                customClass: {
                    confirmButton: 'btn btn-lg px-4'
                }
            });
        });

        function confirmStartCompetition(competitionId) {
            Swal.fire({
                title: '<strong>Mulai Kompetisi?</strong>',
                html: `
                    <div class="text-start">
                        <p class="text-muted mb-3">Anda akan memulai kompetisi ini.</p>
                        <div class="alert alert-warning" style="font-size: 0.9rem;">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <strong>Perhatian:</strong>
                            <ul class="mt-2 mb-0 ps-3">
                                <li>Timer akan mulai menghitung mundur setelah Anda klik "Ya, Mulai!"</li>
                                <li>Pastikan koneksi internet Anda stabil</li>
                                <li>Siapkan konsentrasi Anda</li>
                                <li>Anda tidak dapat mengulang kompetisi setelah selesai</li>
                            </ul>
                        </div>
                        <p class="mb-0"><strong>Apakah Anda siap memulai?</strong></p>
                    </div>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: '<i class="bi bi-play-fill me-1"></i> Ya, Mulai!',
                cancelButtonText: '<i class="bi bi-x-circle me-1"></i> Batal',
                confirmButtonColor: '#667eea',
                cancelButtonColor: '#6c757d',
                reverseButtons: true,
                customClass: {
                    confirmButton: 'btn btn-lg px-4',
                    cancelButton: 'btn btn-lg px-4'
                },
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading
                    Swal.fire({
                        title: 'Memulai Kompetisi...',
                        html: 'Mohon tunggu, sistem sedang memvalidasi dan memulai timer',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Call Livewire method to start competition
                    @this.call('startCompetition', competitionId);
                }
            });
        }
    </script>
@endpush
