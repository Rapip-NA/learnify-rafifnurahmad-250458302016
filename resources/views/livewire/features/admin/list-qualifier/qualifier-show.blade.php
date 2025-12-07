<div>
    <div>
        <div>
            <div>
                <!-- Page Header -->
                <div class="mb-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h1
                                class="text-3xl font-bold text-transparent bg-gradient-to-r from-indigo-400 to-pink-400 bg-clip-text mb-2">
                                Detail Qualifier
                            </h1>
                            <p class="text-slate-400">Informasi lengkap mengenai qualifier</p>
                        </div>
                        <button wire:click="deleteQualifier"
                            wire:confirm="Apakah Anda yakin ingin menghapus qualifier ini? Data tidak dapat dikembalikan!"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-red-500/20 text-red-400 border border-red-500/30 font-semibold rounded-xl hover:bg-red-500/30 transition-all">
                            <i class="bi bi-trash"></i>
                            Hapus
                        </button>
                    </div>
                </div>

                <!-- Basic Information Card -->
                <div
                    class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl overflow-hidden mb-6">
                    <div class="px-6 py-4 bg-slate-900/50 border-b border-slate-700">
                        <h3 class="text-xl font-bold text-white">Informasi Qualifier</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4">
                                <label class="text-xs text-slate-400 mb-1 block">ID Qualifier</label>
                                <p class="text-white font-semibold text-lg">{{ $qualifier->id }}</p>
                            </div>
                            <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4">
                                <label class="text-xs text-slate-400 mb-1 block">Nama Lengkap</label>
                                <p class="text-white font-semibold text-lg">{{ $qualifier->name }}</p>
                            </div>
                            <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4">
                                <label class="text-xs text-slate-400 mb-1 block">Email</label>
                                <p class="text-white">{{ $qualifier->email }}</p>
                            </div>
                            <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4">
                                <label class="text-xs text-slate-400 mb-1 block">Role</label>
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-500/20 text-blue-400 border border-blue-500/30">
                                    {{ ucfirst($qualifier->role) }}
                                </span>
                            </div>
                            <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4">
                                <label class="text-xs text-slate-400 mb-1 block">Terdaftar Sejak</label>
                                <p class="text-white">{{ $qualifier->created_at->format('d F Y, H:i') }}</p>
                            </div>
                            <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4">
                                <label class="text-xs text-slate-400 mb-1 block">Terakhir Diupdate</label>
                                <p class="text-white">{{ $qualifier->updated_at->format('d F Y, H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistik Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div
                        class="bg-gradient-to-br from-blue-500/20 to-blue-600/20 border border-blue-500/30 rounded-2xl p-6">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-blue-300 text-sm mb-1">Total Soal Diverifikasi</p>
                                <h2 class="text-4xl font-bold text-white">{{ $qualifier->verified_questions_count }}
                                </h2>
                            </div>
                            <div class="text-6xl opacity-50">📝</div>
                        </div>
                    </div>

                    <div
                        class="bg-gradient-to-br from-green-500/20 to-green-600/20 border border-green-500/30 rounded-2xl p-6">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-green-300 text-sm mb-1">Total Jawaban Diverifikasi</p>
                                <h2 class="text-4xl font-bold text-white">
                                    {{ $qualifier->verified_participant_answers_count }}</h2>
                            </div>
                            <div class="text-6xl opacity-50">✅</div>
                        </div>
                    </div>
                </div>

                <!-- Riwayat Verifikasi Soal -->
                <div
                    class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl overflow-hidden mb-6">
                    <div class="px-6 py-4 bg-slate-900/50 border-b border-slate-700">
                        <h3 class="text-xl font-bold text-white">Riwayat Verifikasi Soal</h3>
                    </div>
                    <div class="p-6">
                        @if ($qualifier->verifiedQuestions->count() > 0)
                            <div class="space-y-3">
                                @foreach ($qualifier->verifiedQuestions->take(10) as $question)
                                    <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4">
                                        <div class="flex justify-between items-start gap-3">
                                            <div class="flex-grow">
                                                <h4 class="text-white font-semibold mb-2">{{ $question->question_text }}
                                                </h4>
                                                <div class="flex flex-wrap gap-2 text-sm text-slate-400">
                                                    <span><i class="bi bi-trophy"></i>
                                                        {{ $question->competition->title ?? 'N/A' }}</span>
                                                    <span><i class="bi bi-star"></i> {{ $question->point_weight }}
                                                        points</span>
                                                </div>
                                            </div>
                                            <span
                                                class="px-3 py-1 rounded-full text-xs font-semibold bg-green-500/20 text-green-400 border border-green-500/30 whitespace-nowrap">
                                                Diverifikasi
                                            </span>
                                        </div>
                                    </div>
                                @endforeach

                                @if ($qualifier->verifiedQuestions->count() > 10)
                                    <p class="text-center text-slate-400 pt-2">
                                        Dan {{ $qualifier->verifiedQuestions->count() - 10 }} soal lainnya...
                                    </p>
                                @endif
                            </div>
                        @else
                            <div class="text-center py-12">
                                <i class="bi bi-inbox text-slate-600 text-6xl block mb-4"></i>
                                <p class="text-slate-400">Belum memverifikasi soal apapun</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Riwayat Verifikasi Jawaban -->
                <div
                    class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl overflow-hidden">
                    <div class="px-6 py-4 bg-slate-900/50 border-b border-slate-700">
                        <h3 class="text-xl font-bold text-white">Riwayat Verifikasi Jawaban</h3>
                    </div>
                    <div class="p-6">
                        @if ($qualifier->verifiedParticipantAnswers->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead class="border-b border-slate-700">
                                        <tr>
                                            <th class="px-4 py-3 text-left text-sm font-semibold text-slate-300">Peserta
                                            </th>
                                            <th class="px-4 py-3 text-center text-sm font-semibold text-slate-300">
                                                Status
                                            </th>
                                            <th class="px-4 py-3 text-center text-sm font-semibold text-slate-300">Poin
                                            </th>
                                            <th class="px-4 py-3 text-right text-sm font-semibold text-slate-300">
                                                Diverifikasi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-700/50">
                                        @foreach ($qualifier->verifiedParticipantAnswers->take(15) as $answer)
                                            <tr class="hover:bg-slate-800/50 transition">
                                                <td class="px-4 py-3 text-white">
                                                    {{ $answer->competitionParticipant->user->name ?? 'N/A' }}</td>
                                                <td class="px-4 py-3 text-center">
                                                    @if ($answer->is_correct)
                                                        <span
                                                            class="px-3 py-1 rounded-full text-xs font-semibold bg-green-500/20 text-green-400 border border-green-500/30">
                                                            Benar
                                                        </span>
                                                    @else
                                                        <span
                                                            class="px-3 py-1 rounded-full text-xs font-semibold bg-red-500/20 text-red-400 border border-red-500/30">
                                                            Salah
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="px-4 py-3 text-center text-white font-bold">
                                                    {{ $answer->points_awarded ?? 0 }}</td>
                                                <td class="px-4 py-3 text-right text-slate-400 text-sm">
                                                    {{ $answer->verified_at ? \Carbon\Carbon::parse($answer->verified_at)->format('d M Y') : '-' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @if ($qualifier->verifiedParticipantAnswers->count() > 15)
                                <p class="text-center text-slate-400 pt-4">
                                    Dan {{ $qualifier->verifiedParticipantAnswers->count() - 15 }} jawaban lainnya...
                                </p>
                            @endif
                        @else
                            <div class="text-center py-12">
                                <i class="bi bi-inbox text-slate-600 text-6xl block mb-4"></i>
                                <p class="text-slate-400">Belum memverifikasi jawaban apapun</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
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

        body.light-theme .bg-slate-900,
        body.light-theme .bg-slate-800 {
            background: #f8fafc !important;
        }

        body.light-theme .bg-slate-800\/50 {
            background: #f8fafc !important;
        }

        body.light-theme .bi-inbox {
            color: #cbd5e1 !important;
        }

        body.light-theme .text-blue-300,
        body.light-theme .text-green-300 {
            color: #64748b !important;
        }
    </style>
</div>
