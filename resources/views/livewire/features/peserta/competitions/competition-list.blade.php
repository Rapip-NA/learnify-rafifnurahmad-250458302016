<div>
    <div>
        <div>
            <div>
                <!-- Page Header -->
                <div class="mb-6 md:mb-8">
                    <h1
                        class="text-2xl md:text-3xl font-bold text-transparent bg-gradient-to-r from-indigo-400 to-pink-400 bg-clip-text mb-2 flex items-center gap-2">
                        <i class="bi bi-trophy-fill"></i>
                        Daftar Kompetisi
                    </h1>
                    <p class="text-slate-400 text-sm md:text-base">Temukan dan ikuti kompetisi yang tersedia.</p>
                </div>

                <!-- Tabs Navigation -->
                <div
                    class="flex flex-col md:flex-row flex-wrap gap-2 mb-6 bg-slate-800/50 border border-slate-700 rounded-xl p-2">
                    <button
                        class="tab-btn active flex items-center justify-center md:justify-start gap-2 w-full md:w-auto px-4 py-3 md:px-6 md:py-3 rounded-lg text-white font-semibold transition-all text-sm md:text-base"
                        data-tab="active">
                        <i class="bi bi-lightning-charge-fill"></i>
                        Kompetisi Aktif
                        <span
                            class="px-2 py-0.5 bg-green-500/30 text-green-400 border border-green-500/50 rounded-full text-xs font-bold">{{ $activeCompetitions->count() }}</span>
                    </button>
                    <button
                        class="tab-btn flex items-center justify-center md:justify-start gap-2 w-full md:w-auto px-4 py-3 md:px-6 md:py-3 rounded-lg text-slate-400 font-semibold hover:text-white hover:bg-slate-700/50 transition-all text-sm md:text-base"
                        data-tab="draft">
                        <i class="bi bi-clock-history"></i>
                        Segera Hadir
                        <span
                            class="px-2 py-0.5 bg-cyan-500/30 text-cyan-400 border border-cyan-500/50 rounded-full text-xs font-bold">{{ $draftCompetitions->count() }}</span>
                    </button>
                    <button
                        class="tab-btn flex items-center justify-center md:justify-start gap-2 w-full md:w-auto px-4 py-3 md:px-6 md:py-3 rounded-lg text-slate-400 font-semibold hover:text-white hover:bg-slate-700/50 transition-all text-sm md:text-base"
                        data-tab="inactive">
                        <i class="bi bi-archive-fill"></i>
                        Sudah Berakhir
                        <span
                            class="px-2 py-0.5 bg-slate-600 text-slate-300 border border-slate-500 rounded-full text-xs font-bold">{{ $inactiveCompetitions->count() }}</span>
                    </button>
                </div>

                <!-- Tabs Content -->
                <div>
                    <!-- Active Competitions Tab -->
                    <div class="tab-content active" data-tab="active">
                        @if ($activeCompetitions->isEmpty())
                            <div
                                class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-8 md:p-12 text-center">
                                <i class="bi bi-trophy text-yellow-400/30 text-6xl md:text-8xl block mb-4"></i>
                                <h5 class="text-slate-300 text-xl mb-2">Belum ada kompetisi yang aktif</h5>
                                <p class="text-slate-400">Kompetisi baru akan segera hadir. Stay tuned!</p>
                            </div>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
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

                    <!-- Draft Competitions Tab -->
                    <div class="tab-content hidden" data-tab="draft">
                        @if ($draftCompetitions->isEmpty())
                            <div
                                class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-8 md:p-12 text-center">
                                <i class="bi bi-calendar-event text-cyan-400/30 text-6xl md:text-8xl block mb-4"></i>
                                <h5 class="text-slate-300 text-xl mb-2">Belum ada kompetisi yang akan datang</h5>
                                <p class="text-slate-400">Kompetisi baru akan segera dijadwalkan!</p>
                            </div>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
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

                    <!-- Inactive Competitions Tab -->
                    <div class="tab-content hidden" data-tab="inactive">
                        @if ($inactiveCompetitions->isEmpty())
                            <div
                                class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-8 md:p-12 text-center">
                                <i class="bi bi-archive text-slate-600 text-6xl md:text-8xl block mb-4"></i>
                                <h5 class="text-slate-300 text-xl mb-2">Belum ada kompetisi yang berakhir</h5>
                                <p class="text-slate-400">Kompetisi yang sudah selesai akan muncul di sini.</p>
                            </div>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
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
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabButtons = document.querySelectorAll('.tab-btn');
            const tabContents = document.querySelectorAll('.tab-content');

            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const tabName = this.getAttribute('data-tab');

                    // Remove active class from all buttons and contents
                    tabButtons.forEach(btn => {
                        btn.classList.remove('active', 'bg-gradient-to-r',
                            'from-indigo-500', 'to-purple-600');
                        btn.classList.add('text-slate-400', 'hover:text-white',
                            'hover:bg-slate-700/50');
                    });
                    tabContents.forEach(content => content.classList.add('hidden'));

                    // Add active class to clicked button and corresponding content
                    this.classList.add('active', 'bg-gradient-to-r', 'from-indigo-500',
                        'to-purple-600');
                    this.classList.remove('text-slate-400', 'hover:text-white',
                        'hover:bg-slate-700/50');
                    document.querySelector(`.tab-content[data-tab="${tabName}"]`).classList.remove(
                        'hidden');
                });
            });
        });
    </script>

</div>

@push('styles')
    <style>
        /* Fade in animation */
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

        .tab-content {
            animation: fadeInUp 0.5s ease-out;
        }

        body.light-theme .bg-gradient-to-br {
            background: white !important;
            border-color: #e2e8f0 !important;
        }

        body.light-theme .text-white {
            color: #0f172a !important;
        }

        body.light-theme .text-slate-300,
        body.light-theme .text-slate-400 {
            color: #64748b !important;
        }

        body.light-theme .border-slate-700 {
            border-color: #e2e8f0 !important;
        }

        body.light-theme .bg-slate-800,
        body.light-theme .bg-slate-900 {
            background: #f8fafc !important;
        }

        body.light-theme .tab-btn {
            color: #64748b !important;
        }

        body.light-theme .tab-btn.active {
            color: white !important;
        }

        body.light-theme .tab-btn:hover {
            background: #f1f5f9 !important;
            color: #0f172a !important;
        }
    </style>
@endpush
