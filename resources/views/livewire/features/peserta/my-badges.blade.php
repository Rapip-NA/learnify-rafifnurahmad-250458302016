<div>
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-transparent bg-gradient-to-r from-indigo-400 to-pink-400 bg-clip-text mb-2">
            My Badges
        </h1>
        <p class="text-slate-400">Koleksi pencapaian dan penghargaan Anda</p>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div
            class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-6 relative overflow-hidden group hover:border-indigo-500/50 transition-all duration-300">
            <div
                class="absolute top-0 right-0 w-32 h-32 bg-indigo-500/10 rounded-full blur-3xl -mr-16 -mt-16 transition-all group-hover:bg-indigo-500/20">
            </div>
            <div class="relative z-10">
                <div class="flex items-center gap-4 mb-2">
                    <div class="p-3 bg-indigo-500/20 rounded-xl">
                        <i class="bi bi-trophy text-indigo-400 text-xl"></i>
                    </div>
                    <p class="text-slate-400 font-medium">Badges Earned</p>
                </div>
                <h2 class="text-4xl font-bold text-white mt-2">{{ $earnedCount }}</h2>
            </div>
        </div>

        <div
            class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-6 relative overflow-hidden group hover:border-slate-600 transition-all duration-300">
            <div
                class="absolute top-0 right-0 w-32 h-32 bg-slate-500/10 rounded-full blur-3xl -mr-16 -mt-16 transition-all group-hover:bg-slate-500/20">
            </div>
            <div class="relative z-10">
                <div class="flex items-center gap-4 mb-2">
                    <div class="p-3 bg-slate-700/50 rounded-xl">
                        <i class="bi bi-lock text-slate-400 text-xl"></i>
                    </div>
                    <p class="text-slate-400 font-medium">Badges Remaining</p>
                </div>
                <h2 class="text-4xl font-bold text-slate-200 mt-2">{{ $totalBadges - $earnedCount }}</h2>
            </div>
        </div>
    </div>

    <!-- Earned Badges -->
    @if ($earnedBadges->count() > 0)
        <div class="mb-10">
            <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                <i class="bi bi-stars text-yellow-400"></i>
                Earned Badges
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($earnedBadges as $badge)
                    <div
                        class="bg-gradient-to-br from-slate-800 to-slate-900 border border-green-500/30 rounded-2xl p-6 text-center relative overflow-hidden group hover:transform hover:scale-105 transition-all duration-300 shadow-lg shadow-green-900/10">
                        <!-- Glow Effect -->
                        <div
                            class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-green-500 to-transparent opacity-50">
                        </div>

                        <!-- Check Icon -->
                        <div class="absolute top-4 right-4">
                            <div
                                class="w-8 h-8 bg-green-500/20 rounded-full flex items-center justify-center border border-green-500/30">
                                <i class="bi bi-check-lg text-green-400"></i>
                            </div>
                        </div>

                        <!-- Icon -->
                        <div class="mb-4 relative inline-block">
                            <div
                                class="text-6xl filter drop-shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                                {{ $badge->icon ?? '🏅' }}
                            </div>
                            <div class="absolute inset-0 bg-green-400/20 blur-xl rounded-full -z-10"></div>
                        </div>

                        <!-- Content -->
                        <h4 class="text-lg font-bold text-white mb-2">{{ $badge->name }}</h4>
                        <p class="text-slate-400 text-sm mb-4 line-clamp-2">{{ $badge->description }}</p>

                        <!-- Badge Type -->
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                            @if ($badge->badge_type === 'achievement') bg-blue-500/20 text-blue-400 border border-blue-500/30
                            @elseif($badge->badge_type === 'milestone') bg-purple-500/20 text-purple-400 border border-purple-500/30
                            @elseif($badge->badge_type === 'streak') bg-orange-500/20 text-orange-400 border border-orange-500/30
                            @else bg-slate-700 text-slate-300 border border-slate-600 @endif">
                            {{ ucfirst($badge->badge_type) }}
                        </span>

                        <!-- Date -->
                        <div class="mt-4 pt-4 border-t border-slate-700/50">
                            <p class="text-xs text-slate-500 flex items-center justify-center gap-1">
                                <i class="bi bi-calendar-check"></i>
                                {{ \Carbon\Carbon::parse($badge->awarded_at)->format('d M Y') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Locked Badges -->
    @if ($lockedBadges->count() > 0)
        <div>
            <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                <i class="bi bi-lock text-slate-400"></i>
                Locked Badges
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($lockedBadges as $badge)
                    <div
                        class="bg-slate-900/50 border border-slate-800 rounded-2xl p-6 text-center relative overflow-hidden opacity-75 hover:opacity-100 transition-opacity duration-300">
                        <!-- Icon -->
                        <div class="mb-4 relative inline-block grayscale opacity-50">
                            <div class="text-6xl">
                                {{ $badge->icon ?? '🏅' }}
                            </div>
                        </div>

                        <!-- Content -->
                        <h4 class="text-lg font-bold text-slate-300 mb-2">{{ $badge->name }}</h4>
                        <p class="text-slate-500 text-sm mb-4 line-clamp-2">{{ $badge->description }}</p>

                        <!-- Badge Type -->
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-slate-800 text-slate-400 border border-slate-700 mb-4">
                            {{ ucfirst($badge->badge_type) }}
                        </span>

                        <!-- Progress -->
                        @if ($badge->progress['required'] > 0)
                            <div class="w-full bg-slate-800 rounded-full h-2 mb-2 overflow-hidden">
                                <div class="bg-indigo-500 h-2 rounded-full transition-all duration-500"
                                    style="width: {{ $badge->progress['percentage'] }}%"></div>
                            </div>
                            <p class="text-xs text-slate-500">
                                {{ $badge->progress['current'] }} / {{ $badge->progress['required'] }}
                            </p>
                        @else
                            <div class="mt-2">
                                <p class="text-xs text-slate-500 flex items-center justify-center gap-1">
                                    <i class="bi bi-lock-fill"></i>
                                    Keep participating to unlock
                                </p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Empty State -->
    @if ($earnedBadges->count() === 0 && $lockedBadges->count() === 0)
        <div class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-12 text-center">
            <div class="w-20 h-20 bg-slate-700/50 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="bi bi-award text-4xl text-slate-400"></i>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">Belum ada badge</h3>
            <p class="text-slate-400">Mulai ikuti kompetisi untuk mendapatkan badge pertama Anda!</p>
        </div>
    @endif
</div>

@push('styles')
    <style>
        body.light-theme .bg-gradient-to-br {
            background: white !important;
            border-color: #e2e8f0 !important;
        }

        body.light-theme .text-white {
            color: #0f172a !important;
        }

        body.light-theme .text-slate-200,
        body.light-theme .text-slate-300,
        body.light-theme .text-slate-400,
        body.light-theme .text-slate-500 {
            color: #64748b !important;
        }

        body.light-theme .border-slate-600,
        body.light-theme .border-slate-700,
        body.light-theme .border-slate-800 {
            border-color: #e2e8f0 !important;
        }

        body.light-theme .bg-slate-700,
        body.light-theme .bg-slate-800,
        body.light-theme .bg-slate-900 {
            background: #f8fafc !important;
        }

        body.light-theme .bg-slate-900\/50 {
            background: #f1f5f9 !important;
        }
    </style>
@endpush
