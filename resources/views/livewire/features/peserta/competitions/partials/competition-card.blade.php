<div>
    <!-- Competition Card Component -->
    <div class="group">
        <div
            class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl overflow-hidden h-full transition-all hover:-translate-y-2 hover:shadow-2xl hover:shadow-indigo-500/20 @if ($statusClass === 'inactive') opacity-85 @endif">

            {{-- Header with gradient --}}
            <div
                class="relative py-6 px-6 overflow-hidden
            @if ($statusClass === 'active') bg-gradient-to-br from-green-500 to-green-600
            @elseif($statusClass === 'draft') bg-gradient-to-br from-indigo-500 to-purple-600
            @else bg-gradient-to-br from-slate-600 to-slate-700 @endif">

                {{-- Decorative circle --}}
                <div class="absolute w-24 h-24 bg-white/10 rounded-full -top-8 -right-5"></div>

                <h5 class="text-white font-bold text-xl mb-2 relative">
                    {{ $competition->title }}
                </h5>

                {{-- Status Badge --}}
                @if ($statusClass === 'draft')
                    <span
                        class="inline-flex items-center gap-1 px-3 py-1 bg-white/20 backdrop-blur-sm text-white rounded-full text-xs font-semibold">
                        <i class="bi bi-clock"></i> Segera Hadir
                    </span>
                @elseif($statusClass === 'inactive')
                    <span
                        class="inline-flex items-center gap-1 px-3 py-1 bg-white/20 backdrop-blur-sm text-white rounded-full text-xs font-semibold">
                        <i class="bi bi-archive"></i> Sudah Berakhir
                    </span>
                @endif
            </div>

            <div class="p-6 flex flex-col h-[calc(100%-120px)]">
                <p class="text-slate-400 mb-6 flex-grow text-sm leading-relaxed">
                    {{ Str::limit($competition->description, 120) }}
                </p>

                {{-- Info section --}}
                <div class="space-y-3 mb-6">
                    {{-- Start Date --}}
                    <div class="flex items-center gap-3 p-3 bg-slate-800/50 border border-slate-700 rounded-xl">
                        <div
                            class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center flex-shrink-0">
                            <i class="bi bi-calendar-check text-white"></i>
                        </div>
                        <div class="flex-grow">
                            <small class="text-slate-500 text-xs block">Mulai</small>
                            <strong
                                class="text-white text-sm">{{ $competition->start_date->format('d M Y H:i') }}</strong>
                        </div>
                    </div>

                    {{-- End Date --}}
                    <div class="flex items-center gap-3 p-3 bg-slate-800/50 border border-slate-700 rounded-xl">
                        <div
                            class="w-10 h-10 rounded-full bg-gradient-to-br from-pink-500 to-red-600 flex items-center justify-center flex-shrink-0">
                            <i class="bi bi-calendar-x text-white"></i>
                        </div>
                        <div class="flex-grow">
                            <small class="text-slate-500 text-xs block">Selesai</small>
                            <strong
                                class="text-white text-sm">{{ $competition->end_date->format('d M Y H:i') }}</strong>
                        </div>
                    </div>

                    {{-- Question Count --}}
                    <div class="flex items-center gap-3 p-3 bg-slate-800/50 border border-slate-700 rounded-xl">
                        <div
                            class="w-10 h-10 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center flex-shrink-0">
                            <i class="bi bi-question-circle text-white"></i>
                        </div>
                        <div class="flex-grow">
                            <small class="text-slate-500 text-xs block">Jumlah Soal</small>
                            <strong class="text-white text-sm">{{ $competition->questions->count() }}
                                Pertanyaan</strong>
                        </div>
                    </div>
                </div>

                {{-- Action button based on status --}}
                @if ($statusClass === 'draft')
                    {{-- Draft: Coming Soon Button (Disabled) --}}
                    <button disabled
                        class="w-full py-4 px-6 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-semibold rounded-xl opacity-60 cursor-not-allowed flex items-center justify-center gap-2">
                        <i class="bi bi-hourglass-split"></i>
                        Segera Hadir
                    </button>
                @elseif($statusClass === 'inactive')
                    {{-- Inactive: History or Closed --}}
                    @if (in_array($competition->id, $completedCompetitions))
                        <a href="{{ route('peserta.competitions.result', $competition) }}"
                            class="w-full py-4 px-6 bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-cyan-500/50 transition-all flex items-center justify-center gap-2">
                            <i class="bi bi-clock-history"></i>
                            Lihat History
                        </a>
                    @else
                        <button disabled
                            class="w-full py-4 px-6 bg-gradient-to-r from-slate-600 to-slate-700 text-white font-semibold rounded-xl opacity-60 cursor-not-allowed flex items-center justify-center gap-2">
                            <i class="bi bi-x-circle"></i>
                            Sudah Berakhir
                        </button>
                    @endif
                @else
                    {{-- Active: Standard Buttons --}}
                    @if (in_array($competition->id, $completedCompetitions))
                        <a href="{{ route('peserta.competitions.result', $competition) }}"
                            class="w-full py-4 px-6 bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-cyan-500/50 transition-all flex items-center justify-center gap-2">
                            <i class="bi bi-clock-history"></i>
                            Lihat History
                        </a>
                    @elseif(in_array($competition->id, $myParticipations))
                        <a href="{{ route('peserta.competitions.quiz', $competition) }}"
                            class="w-full py-4 px-6 bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-green-500/50 transition-all flex items-center justify-center gap-2">
                            <i class="bi bi-arrow-right-circle-fill"></i>
                            Lanjutkan Quiz
                        </a>
                    @else
                        <button onclick="confirmStartCompetition({{ $competition->id }})"
                            class="w-full py-4 px-6 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-indigo-500/50 transition-all flex items-center justify-center gap-2">
                            <i class="bi bi-play-circle-fill"></i>
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
                    confirmButtonColor: '#ef4444',
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
                    confirmButtonColor: '#22c55e',
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
                    confirmButtonColor: '#6366f1',
                    cancelButtonColor: '#64748b',
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

    <style>
        body.light-theme .bg-gradient-to-br.from-slate-800 {
            background: white !important;
            border-color: #e2e8f0 !important;
        }

        body.light-theme .text-white {
            color: #0f172a !important;
        }

        body.light-theme .text-slate-400,
        body.light-theme .text-slate-500 {
            color: #64748b !important;
        }

        body.light-theme .border-slate-700 {
            border-color: #e2e8f0 !important;
        }

        body.light-theme .bg-slate-800 {
            background: #f8fafc !important;
        }
    </style>
</div>
