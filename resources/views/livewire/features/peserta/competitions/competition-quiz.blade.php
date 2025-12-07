<div>
    {{-- resources/views/livewire/competition-quiz.blade.php --}}
    <div wire:poll.1s="checkTimer">
        <div>
            <div>

                @if ($isFinished)
                    {{-- QUIZ SELESAI --}}
                    <div class="flex justify-center">
                        <div class="w-full max-w-2xl">
                            <div
                                class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl overflow-hidden text-center">
                                <div class="p-8">
                                    <div class="mb-4">
                                        <i class="bi bi-check-circle text-green-400 text-7xl"></i>
                                    </div>

                                    <h2 class="text-3xl font-bold text-white mb-4">Kuis Selesai!</h2>

                                    @if ($timeExpired)
                                        <div
                                            class="bg-yellow-500/20 border border-yellow-500/30 text-yellow-300 px-4 py-3 rounded-xl mb-4">
                                            ⏰ Waktu telah habis. Kuis diselesaikan secara otomatis.
                                        </div>
                                    @endif

                                    <p class="text-slate-400 mb-4">
                                        Skor Anda:
                                        <span
                                            class="block text-6xl font-bold text-transparent bg-gradient-to-r from-indigo-400 to-pink-400 bg-clip-text mt-2">{{ $participant->total_score }}</span>
                                    </p>

                                    <a href="{{ route('peserta.competitions.result', $competition->uid) }}"
                                        class="inline-flex items-center gap-2 px-8 py-4 gradient-primary text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-indigo-500/50 transition-all text-lg">
                                        Lihat Detail Hasil
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    {{-- HEADER + TIMER --}}
                    <div class="mb-6">
                        <div
                            class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl overflow-hidden">
                            <div class="p-6">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

                                    {{-- TITLE --}}
                                    <div class="flex-grow">
                                        <h4 class="text-2xl font-bold text-white mb-1">{{ $competition->title }}</h4>
                                        <small class="text-slate-400">
                                            Soal {{ $currentQuestionIndex + 1 }} dari {{ $totalQuestions }}
                                        </small>
                                    </div>

                                    {{-- TIMER --}}
                                    <div
                                        class="text-center px-6 py-4 bg-slate-800/50 border border-slate-700 rounded-xl">
                                        <small class="text-slate-400 block mb-1">Sisa Waktu</small>
                                        <div class="flex items-center justify-center gap-2">
                                            <i
                                                class="bi bi-stopwatch text-2xl {{ $remainingSeconds < 300 ? 'text-red-400' : 'text-indigo-400' }}"></i>
                                            <span
                                                class="text-4xl font-bold {{ $remainingSeconds < 300 ? 'text-red-400' : 'text-indigo-400' }}">
                                                {{ sprintf('%02d:%02d', floor($remainingSeconds / 60), $remainingSeconds % 60) }}
                                            </span>
                                        </div>
                                        @if ($remainingSeconds < 300)
                                            <small class="text-red-400 font-semibold block mt-1">
                                                ⚠️ Waktu hampir habis!
                                            </small>
                                        @endif
                                    </div>

                                    {{-- PROGRESS --}}
                                    <div
                                        class="text-center px-6 py-4 bg-slate-800/50 border border-slate-700 rounded-xl min-w-[160px]">
                                        <small class="text-slate-400 block mb-1">Progress</small>
                                        <div class="text-3xl font-bold text-green-400 mb-2">
                                            {{ $answeredCount }}/{{ $totalQuestions }}
                                        </div>
                                        <div class="w-full bg-slate-700 rounded-full h-2 overflow-hidden">
                                            <div class="bg-gradient-to-r from-green-400 to-green-600 h-full rounded-full transition-all"
                                                style="width: {{ $totalQuestions > 0 ? ($answeredCount / $totalQuestions) * 100 : 0 }}%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- NAVIGASI SOAL --}}
                    <div class="mb-6">
                        <div
                            class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl overflow-hidden">
                            <div class="p-6">
                                <small class="text-slate-400 block mb-3">Navigasi Soal:</small>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($questions as $index => $q)
                                        <button wire:click="goToQuestion({{ $index }})"
                                            class="w-12 h-12 rounded-lg font-bold transition-all
                                    @if ($currentQuestionIndex === $index) bg-gradient-to-br from-indigo-500 to-purple-600 text-white shadow-lg shadow-indigo-500/50
                                    @elseif(isset($answers[$index]))
                                        bg-green-500/20 text-green-400 border border-green-500/30
                                    @else
                                        bg-slate-700 text-slate-300 hover:bg-slate-600 @endif">
                                            {{ $index + 1 }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- QUESTION CARD --}}
                    @if ($currentQuestion)
                        <div class="mb-6">
                            <div
                                class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl overflow-hidden">
                                <div class="p-8">
                                    {{-- Tags --}}
                                    <div class="flex justify-between items-center mb-6">
                                        <span
                                            class="px-3 py-1 bg-blue-500/20 text-blue-400 border border-blue-500/30 rounded-full text-sm font-semibold">
                                            {{ $currentQuestion->category->name ?? 'Umum' }}
                                        </span>

                                        <span
                                            class="px-3 py-1 rounded-full text-sm font-semibold
                                @if ($currentQuestion->difficulty_level === 'easy') bg-green-500/20 text-green-400 border border-green-500/30
                                @elseif($currentQuestion->difficulty_level === 'medium') bg-yellow-500/20 text-yellow-400 border border-yellow-500/30
                                @else bg-red-500/20 text-red-400 border border-red-500/30 @endif">
                                            {{ ucfirst($currentQuestion->difficulty_level) }}
                                            • {{ $currentQuestion->point_weight }} poin
                                        </span>
                                    </div>

                                    {{-- Question Text --}}
                                    <h5 class="text-xl font-bold text-white mb-6">
                                        {{ $currentQuestion->question_text }}
                                    </h5>

                                    {{-- Answer Options --}}
                                    <div class="mb-6 space-y-3" wire:key="question-{{ $currentQuestion->id }}">
                                        @foreach ($currentQuestion->answers as $answer)
                                            <label
                                                class="flex items-start p-4 border rounded-xl cursor-pointer transition-all
                                    @if ($selectedAnswer === $answer->id) border-indigo-500 bg-indigo-500/10
                                    @else
                                        border-slate-600 hover:border-slate-500 hover:bg-slate-800/50 @endif"
                                                wire:key="answer-{{ $answer->id }}">
                                                <input type="radio" name="question_{{ $currentQuestion->id }}"
                                                    value="{{ $answer->id }}"
                                                    wire:click="selectAnswer({{ $answer->id }})"
                                                    class="mt-1 w-5 h-5 text-indigo-500 focus:ring-indigo-500 focus:ring-2"
                                                    @if ($selectedAnswer === $answer->id) checked @endif>
                                                <span class="ml-3 flex-grow text-slate-200">
                                                    {{ $answer->answer_text }}
                                                </span>
                                            </label>
                                        @endforeach
                                    </div>

                                    {{-- Flash Messages --}}
                                    @if (session()->has('success'))
                                        <div
                                            class="bg-green-500/20 border border-green-500/30 text-green-300 px-4 py-3 rounded-xl mb-4">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @if (session()->has('error'))
                                        <div
                                            class="bg-red-500/20 border border-red-500/30 text-red-300 px-4 py-3 rounded-xl mb-4">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    {{-- Navigation Buttons --}}
                                    <div class="flex justify-between gap-4">
                                        {{-- PREVIOUS --}}
                                        <button wire:click="previousQuestion"
                                            class="px-6 py-3 bg-slate-700 text-slate-300 font-semibold rounded-xl hover:bg-slate-600 transition disabled:opacity-50 disabled:cursor-not-allowed"
                                            @if ($currentQuestionIndex === 0) disabled @endif>
                                            ← Sebelumnya
                                        </button>

                                        {{-- NEXT / FINISH --}}
                                        @if ($currentQuestionIndex < $totalQuestions - 1)
                                            <button wire:click="nextQuestion"
                                                class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-indigo-500/50 transition">
                                                Selanjutnya →
                                            </button>
                                        @else
                                            <button wire:click="finishCompetition"
                                                class="px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-green-500/50 transition">
                                                Selesai
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                @endif
            </div>
        </div>
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
                    confirmButtonColor: '#6366f1',
                    customClass: {
                        confirmButton: 'btn btn-lg px-4'
                    },
                    allowOutsideClick: false,
                    allowEscapeKey: false
                });
            @endif
        </script>
    @endpush

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

            body.light-theme .text-slate-200,
            body.light-theme .text-slate-300,
            body.light-theme .text-slate-400 {
                color: #64748b !important;
            }

            body.light-theme .border-slate-600,
            body.light-theme .border-slate-700 {
                border-color: #e2e8f0 !important;
            }

            body.light-theme .bg-slate-700,
            body.light-theme .bg-slate-800 {
                background: #f1f5f9 !important;
            }
        </style>
    @endpush
