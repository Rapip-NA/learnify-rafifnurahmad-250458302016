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
                                Detail Peserta
                            </h1>
                            <p class="text-slate-400">Informasi lengkap peserta kompetisi</p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.peserta.index') }}"
                                class="inline-flex items-center gap-2 px-6 py-3 bg-slate-800 border border-slate-700 text-white font-semibold rounded-xl hover:bg-slate-700 transition-all">
                                <i class="bi bi-arrow-left"></i>
                                Kembali
                            </a>
                            <button wire:click="deletePeserta"
                                wire:confirm="Apakah Anda yakin ingin menghapus peserta ini? Data tidak dapat dikembalikan!"
                                class="inline-flex items-center gap-2 px-6 py-3 bg-red-500/20 text-red-400 border border-red-500/30 font-semibold rounded-xl hover:bg-red-500/30 transition-all">
                                <i class="bi bi-trash"></i>
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Basic Information Card -->
                <div
                    class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl overflow-hidden mb-6">
                    <div class="px-6 py-4 bg-slate-900/50 border-b border-slate-700">
                        <h3 class="text-xl font-bold text-white">Informasi Peserta</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4">
                                <label class="text-xs text-slate-400 mb-1 block">ID Peserta</label>
                                <p class="text-white font-semibold text-lg">{{ $peserta->id }}</p>
                            </div>
                            <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4">
                                <label class="text-xs text-slate-400 mb-1 block">Nama Lengkap</label>
                                <p class="text-white font-semibold text-lg">{{ $peserta->name }}</p>
                            </div>
                            <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4">
                                <label class="text-xs text-slate-400 mb-1 block">Email</label>
                                <p class="text-white">{{ $peserta->email }}</p>
                            </div>
                            <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4">
                                <label class="text-xs text-slate-400 mb-1 block">Role</label>
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-500/20 text-blue-400 border border-blue-500/30">
                                    {{ ucfirst($peserta->role) }}
                                </span>
                            </div>
                            <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4">
                                <label class="text-xs text-slate-400 mb-1 block">Terdaftar Sejak</label>
                                <p class="text-white">{{ $peserta->created_at->format('d F Y, H:i') }}</p>
                            </div>
                            <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4">
                                <label class="text-xs text-slate-400 mb-1 block">Terakhir Diupdate</label>
                                <p class="text-white">{{ $peserta->updated_at->format('d F Y, H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kompetisi yang Diikuti -->
                <div
                    class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl overflow-hidden mb-6">
                    <div class="px-6 py-4 bg-slate-900/50 border-b border-slate-700">
                        <h3 class="text-xl font-bold text-white">Kompetisi yang Diikuti</h3>
                    </div>
                    <div class="p-6">
                        @if ($peserta->competitionParticipants->count())
                            <div class="space-y-3">
                                @foreach ($peserta->competitionParticipants as $participant)
                                    <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="text-white font-semibold mb-1">
                                                    {{ $participant->competition->title ?? 'N/A' }}</h4>
                                                <p class="text-slate-400 text-sm">
                                                    <i class="bi bi-calendar"></i>
                                                    Bergabung: {{ $participant->created_at->format('d M Y') }}
                                                </p>
                                            </div>
                                            @if ($participant->score !== null)
                                                <span
                                                    class="px-3 py-1 rounded-full text-xs font-semibold bg-green-500/20 text-green-400 border border-green-500/30">
                                                    Score: {{ $participant->score }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <i class="bi bi-inbox text-slate-600 text-6xl block mb-4"></i>
                                <p class="text-slate-400">Belum mengikuti kompetisi apapun</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Badges & Pencapaian -->
                <div
                    class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl overflow-hidden mb-6">
                    <div class="px-6 py-4 bg-slate-900/50 border-b border-slate-700">
                        <h3 class="text-xl font-bold text-white">Badge & Pencapaian</h3>
                    </div>
                    <div class="p-6">
                        @if ($peserta->userBadges->count())
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach ($peserta->userBadges as $userBadge)
                                    <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4 text-center">
                                        <div class="text-5xl mb-2">{{ $userBadge->badge->icon ?? '🏆' }}</div>
                                        <h4 class="text-white font-semibold text-sm mb-1">
                                            {{ $userBadge->badge->name ?? 'Badge' }}</h4>
                                        <p class="text-slate-400 text-xs">
                                            {{ \Carbon\Carbon::parse($userBadge->awarded_at)->format('d M Y') }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <i class="bi bi-trophy text-slate-600 text-6xl block mb-4"></i>
                                <p class="text-slate-400">Belum memiliki badge</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Posisi Leaderboard -->
                <div
                    class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl overflow-hidden">
                    <div class="px-6 py-4 bg-slate-900/50 border-b border-slate-700">
                        <h3 class="text-xl font-bold text-white">Posisi Leaderboard</h3>
                    </div>
                    <div class="p-6">
                        @if ($peserta->leaderboards->count())
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead class="border-b border-slate-700">
                                        <tr>
                                            <th class="px-4 py-3 text-left text-sm font-semibold text-slate-300">
                                                Kompetisi
                                            </th>
                                            <th class="px-4 py-3 text-center text-sm font-semibold text-slate-300">Rank
                                            </th>
                                            <th class="px-4 py-3 text-right text-sm font-semibold text-slate-300">Score
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-700/50">
                                        @foreach ($peserta->leaderboards as $leaderboard)
                                            <tr class="hover:bg-slate-800/50 transition">
                                                <td class="px-4 py-3 text-white">Kompetisi
                                                    #{{ $leaderboard->competition_id }}</td>
                                                <td class="px-4 py-3 text-center">
                                                    <span
                                                        class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-500/20 text-yellow-400 border border-yellow-500/30">
                                                        #{{ $leaderboard->rank }}
                                                    </span>
                                                </td>
                                                <td class="px-4 py-3 text-right text-white font-bold">
                                                    {{ $leaderboard->score }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-12">
                                <i class="bi bi-graph-up text-slate-600 text-6xl block mb-4"></i>
                                <p class="text-slate-400">Belum ada di leaderboard</p>
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

        body.light-theme .bi-inbox,
        body.light-theme .bi-trophy,
        body.light-theme .bi-graph-up {
            color: #cbd5e1 !important;
        }
    </style>
</div>
