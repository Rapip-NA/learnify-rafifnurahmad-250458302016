<div>
    <div>
        <div>
            <div>
                <!-- Page Header -->
                <div class="mb-8">
                    <h1
                        class="text-3xl font-bold text-transparent bg-gradient-to-r from-indigo-400 to-pink-400 bg-clip-text mb-2 flex items-center gap-2">
                        <i class="bi bi-trophy-fill"></i>
                        Global Leaderboard
                    </h1>
                    <p class="text-slate-400">Peringkat peserta berdasarkan total skor dari semua kompetisi</p>
                </div>

                <!-- Main Card -->
                <div class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl overflow-hidden"
                    wire:poll.{{ $refreshInterval }}ms>
                    <!-- Header Stats -->
                    <div
                        class="relative overflow-hidden px-6 py-6 bg-gradient-to-br from-indigo-500/20 to-purple-500/20 border-b border-slate-700">
                        <!-- Decorative circles -->
                        <div class="absolute w-48 h-48 bg-white/5 rounded-full -top-12 -right-12"></div>
                        <div class="absolute w-36 h-36 bg-white/5 rounded-full -bottom-8 -left-8"></div>

                        <div class="relative flex justify-between items-center flex-wrap gap-4">
                            <div>
                                <h3 class="text-2xl font-bold text-white mb-1">Global Leaderboard</h3>
                                <p class="text-slate-300 text-sm">Total skor dari semua kompetisi</p>
                            </div>

                            <div class="flex items-center gap-4">
                                <div
                                    class="text-center px-6 py-3 bg-white/10 backdrop-blur-lg rounded-xl border border-white/20">
                                    <div class="text-3xl font-bold text-white">{{ $totalParticipants }}</div>
                                    <small class="text-slate-300 text-xs uppercase tracking-wider">Peserta</small>
                                </div>

                                <div
                                    class="flex items-center gap-2 px-4 py-2 bg-green-500/20 border-2 border-green-500/40 rounded-full">
                                    <span class="relative flex h-3 w-3">
                                        <span
                                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                                    </span>
                                    <strong class="text-white font-semibold text-sm">Live</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-0">
                        @if ($leaderboard->isEmpty())
                            <div class="text-center py-16">
                                <i class="bi bi-trophy text-slate-600 text-8xl block mb-4"></i>
                                <h5 class="text-slate-300 text-xl mb-2">Belum ada peserta yang menyelesaikan kompetisi
                                </h5>
                                <p class="text-slate-400">Jadilah yang pertama untuk masuk leaderboard!</p>
                            </div>
                        @else
                            <!-- Desktop Table -->
                            <div class="hidden md:block overflow-x-auto">
                                <table class="w-full">
                                    <thead class="bg-slate-900/50 border-b border-slate-700">
                                        <tr>
                                            <th
                                                class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">
                                                Rank</th>
                                            <th
                                                class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">
                                                Peserta</th>
                                            <th
                                                class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">
                                                Total Skor</th>
                                            <th
                                                class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">
                                                Kompetisi</th>
                                            <th
                                                class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">
                                                Terakhir Aktif</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-700/50">
                                        @foreach ($leaderboard as $entry)
                                            <tr
                                                class="transition-all hover:bg-slate-800/50 
                                    @if ($entry->rank == 1) bg-yellow-500/10 border-l-4 border-l-yellow-500 
                                    @elseif($entry->rank == 2) bg-gray-400/10 border-l-4 border-l-gray-400 
                                    @elseif($entry->rank == 3) bg-orange-600/10 border-l-4 border-l-orange-600 @endif
                                    {{ auth()->id() === $entry->id ? 'bg-blue-500/10 border-l-4 border-l-blue-500' : '' }}">

                                                <td class="px-6 py-4">
                                                    <span
                                                        class="inline-flex items-center justify-center px-4 py-2 font-bold text-lg rounded-xl min-w-[60px]
                                            @if ($entry->rank == 1) bg-gradient-to-br from-yellow-400 to-yellow-600 text-black shadow-lg shadow-yellow-400/50
                                            @elseif($entry->rank == 2) bg-gradient-to-br from-gray-300 to-gray-500 text-white shadow-lg shadow-gray-400/50
                                            @elseif($entry->rank == 3) bg-gradient-to-br from-orange-400 to-orange-700 text-white shadow-lg shadow-orange-500/50
                                            @else bg-slate-800 text-slate-300 border border-slate-600 @endif">
                                                        {{ $entry->position_badge }}
                                                    </span>
                                                </td>

                                                <td class="px-6 py-4">
                                                    <div class="flex items-center gap-3">
                                                        <div
                                                            class="w-12 h-12 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm shadow-lg shadow-indigo-500/30">
                                                            {{ strtoupper(substr($entry->name, 0, 2)) }}
                                                        </div>
                                                        <div>
                                                            <div class="font-bold text-white text-base">
                                                                {{ $entry->name }}
                                                                @if (auth()->id() === $entry->id)
                                                                    <span
                                                                        class="ml-2 px-2 py-0.5 bg-blue-500 text-white text-xs font-semibold rounded-full">YOU</span>
                                                                @endif
                                                            </div>
                                                            <small
                                                                class="text-slate-400 text-sm">{{ $entry->email }}</small>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="px-6 py-4">
                                                    <div class="flex items-baseline gap-1">
                                                        <span
                                                            class="font-bold text-green-400 text-2xl">{{ number_format($entry->total_score, 0) }}</span>
                                                        <span class="text-green-400/75 text-sm">pts</span>
                                                    </div>
                                                </td>

                                                <td class="px-6 py-4">
                                                    <span
                                                        class="inline-flex items-center gap-1 px-3 py-1.5 bg-gradient-to-br from-cyan-500/20 to-cyan-600/20 border border-cyan-500/30 text-cyan-400 rounded-full text-sm font-medium">
                                                        <i class="bi bi-trophy"></i>
                                                        {{ $entry->competitions_count }} kompetisi
                                                    </span>
                                                </td>

                                                <td class="px-6 py-4">
                                                    <div class="flex items-center gap-2 text-slate-400 text-sm">
                                                        <i class="bi bi-clock"></i>
                                                        <span>{{ $entry->last_activity ? $entry->last_activity->diffForHumans() : '-' }}</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Mobile Cards -->
                            <div class="md:hidden p-4 space-y-4">
                                @foreach ($leaderboard as $entry)
                                    <div
                                        class="bg-slate-800/50 border rounded-xl overflow-hidden
                            @if ($entry->rank == 1) border-l-4 border-l-yellow-500 bg-yellow-500/5
                            @elseif($entry->rank == 2) border-l-4 border-l-gray-400 bg-gray-400/5
                            @elseif($entry->rank == 3) border-l-4 border-l-orange-600 bg-orange-600/5
                            @else border-slate-700 @endif
                            {{ auth()->id() === $entry->id ? 'border-2 border-blue-500 bg-blue-500/5' : '' }}">

                                        <div class="p-4">
                                            <div class="flex items-center gap-3 mb-3">
                                                <span
                                                    class="inline-flex items-center justify-center px-3 py-2 font-bold text-xl rounded-xl min-w-[60px]
                                        @if ($entry->rank == 1) bg-gradient-to-br from-yellow-400 to-yellow-600 text-black
                                        @elseif($entry->rank == 2) bg-gradient-to-br from-gray-300 to-gray-500 text-white
                                        @elseif($entry->rank == 3) bg-gradient-to-br from-orange-400 to-orange-700 text-white
                                        @else bg-slate-900 text-slate-300 @endif">
                                                    {{ $entry->position_badge }}
                                                </span>

                                                <div class="flex items-center gap-2 flex-grow">
                                                    <div
                                                        class="w-11 h-11 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm">
                                                        {{ strtoupper(substr($entry->name, 0, 2)) }}
                                                    </div>
                                                    <div class="flex-grow">
                                                        <div class="font-bold text-white">{{ $entry->name }}</div>
                                                        @if (auth()->id() === $entry->id)
                                                            <span
                                                                class="px-2 py-0.5 bg-blue-500 text-white text-xs font-semibold rounded-full">YOU</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div
                                                class="flex justify-between items-center pt-3 border-t border-slate-700">
                                                <div>
                                                    <strong
                                                        class="text-green-400 text-2xl block">{{ number_format($entry->total_score, 0) }}</strong>
                                                    <small class="text-green-400/75">points</small>
                                                </div>

                                                <div class="text-right">
                                                    <span
                                                        class="inline-flex items-center gap-1 px-3 py-1 bg-gradient-to-br from-cyan-500/20 to-cyan-600/20 border border-cyan-500/30 text-cyan-400 rounded-full text-xs mb-1">
                                                        <i class="bi bi-trophy"></i> {{ $entry->competitions_count }}
                                                    </span>
                                                    <div
                                                        class="text-slate-400 text-xs flex items-center gap-1 justify-end">
                                                        <i class="bi bi-clock"></i>
                                                        {{ $entry->last_activity ? $entry->last_activity->diffForHumans() : '-' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Show More Button -->
                            @if ($totalParticipants > 50 && !$showAll)
                                <div class="text-center py-6 border-t border-slate-700 bg-slate-900/30">
                                    <button wire:click="toggleShowAll"
                                        class="px-8 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-semibold rounded-full shadow-lg hover:shadow-xl hover:shadow-indigo-500/50 hover:-translate-y-0.5 transition-all">
                                        <i class="bi bi-chevron-double-down mr-2"></i>
                                        Tampilkan Semua ({{ $totalParticipants }} peserta)
                                    </button>
                                </div>
                            @elseif($showAll)
                                <div class="text-center py-6 border-t border-slate-700 bg-slate-900/30">
                                    <button wire:click="toggleShowAll"
                                        class="px-8 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-semibold rounded-full shadow-lg hover:shadow-xl hover:shadow-indigo-500/50 hover:-translate-y-0.5 transition-all">
                                        <i class="bi bi-chevron-double-up mr-2"></i>
                                        Tampilkan Top 50
                                    </button>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Hover effects for desktop table rows */
        @media (min-width: 768px) {
            .hover\:bg-slate-800\/50:hover {
                transform: translateX(5px);
            }
        }

        /* LIGHT THEME OVERRIDES */
        body.light-theme .bg-gradient-to-br {
            background: white !important;
            border-color: #e2e8f0 !important;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05);
        }

        /* Header Card in Light Mode */
        body.light-theme .bg-gradient-to-br.from-slate-800 {
            background: white !important;
        }

        /* Text Colors */
        body.light-theme .text-white {
            color: #0f172a !important;
        }

        body.light-theme .text-slate-300 {
            color: #475569 !important;
        }

        body.light-theme .text-slate-400 {
            color: #64748b !important;
        }

        /* Borders */
        body.light-theme .border-slate-700 {
            border-color: #e2e8f0 !important;
        }

        /* Backgrounds */
        body.light-theme .bg-slate-900 {
            background: #f8fafc !important;
        }

        body.light-theme .bg-slate-800 {
            background: white !important;
        }

        body.light-theme .bg-slate-800\/50 {
            background: white !important;
        }

        /* Table Header */
        body.light-theme thead.bg-slate-900\/50 {
            background: #f1f5f9 !important;
            color: #334155 !important;
        }

        body.light-theme thead th {
            color: #475569 !important;
        }

        /* Row Hover */
        body.light-theme .hover\:bg-slate-800\/50:hover {
            background: #f8fafc !important;
        }

        /* Top 3 Rows Backgrounds in Light Mode */
        body.light-theme .bg-yellow-500\/10 {
            background-color: #fefce8 !important;
            /* yellow-50 */
            border-left-color: #eab308 !important;
        }

        body.light-theme .bg-gray-400\/10 {
            background-color: #f8fafc !important;
            /* slate-50 */
            border-left-color: #94a3b8 !important;
        }

        body.light-theme .bg-orange-600\/10 {
            background-color: #fff7ed !important;
            /* orange-50 */
            border-left-color: #ea580c !important;
        }

        /* Active User Row */
        body.light-theme .bg-blue-500\/10 {
            background-color: #eff6ff !important;
            /* blue-50 */
            border-left-color: #3b82f6 !important;
        }

        /* Icons */
        body.light-theme .bi-trophy {
            color: #94a3b8 !important;
        }
    </style>
</div>
