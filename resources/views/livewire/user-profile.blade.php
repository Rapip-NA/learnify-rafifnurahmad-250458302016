<div>
    <div>
        <div>
            <div>
                <!-- Page Header -->
                <div class="mb-8">
                    <h1
                        class="text-3xl font-bold text-transparent bg-gradient-to-r from-indigo-400 to-pink-400 bg-clip-text mb-2 flex items-center gap-2">
                        <i class="bi bi-person-circle"></i>
                        My Profile
                    </h1>
                    <p class="text-slate-400">View your profile information and achievements</p>
                </div>

                <!-- Profile Header Card -->
                <div
                    class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl overflow-hidden mb-6">
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-24 h-24 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-4xl shadow-lg shadow-indigo-500/30 hover:scale-105 transition-transform">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            </div>
                            <div class="flex-grow text-center md:text-left">
                                <h4 class="text-2xl font-bold text-white mb-2">{{ $user->name }}</h4>
                                <p class="text-slate-400 mb-3 flex items-center justify-center md:justify-start gap-2">
                                    <i class="bi bi-envelope"></i>
                                    {{ $user->email }}
                                </p>
                                <span
                                    class="px-3 py-1 bg-blue-500/20 text-blue-400 border border-blue-500/30 rounded-full text-sm font-semibold">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div
                        class="bg-gradient-to-br from-yellow-500/20 to-yellow-600/20 border border-yellow-500/30 rounded-2xl p-6 text-center hover:-translate-y-1 transition-transform">
                        <div class="mb-3">
                            <i class="bi bi-award-fill text-yellow-400 text-5xl"></i>
                        </div>
                        <h3 class="text-4xl font-bold text-white mb-1">{{ $totalBadges }}</h3>
                        <p class="text-yellow-300/75">Badges Earned</p>
                    </div>

                    <div
                        class="bg-gradient-to-br from-green-500/20 to-green-600/20 border border-green-500/30 rounded-2xl p-6 text-center hover:-translate-y-1 transition-transform">
                        <div class="mb-3">
                            <i class="bi bi-trophy-fill text-green-400 text-5xl"></i>
                        </div>
                        <h3 class="text-4xl font-bold text-white mb-1">{{ $totalCompletedCompetitions }}</h3>
                        <p class="text-green-300/75">Competitions Completed</p>
                    </div>

                    <div
                        class="bg-gradient-to-br from-cyan-500/20 to-cyan-600/20 border border-cyan-500/30 rounded-2xl p-6 text-center hover:-translate-y-1 transition-transform">
                        <div class="mb-3">
                            <i class="bi bi-graph-up-arrow text-cyan-400 text-5xl"></i>
                        </div>
                        <h3 class="text-4xl font-bold text-white mb-1">{{ $averageScore }}</h3>
                        <p class="text-cyan-300/75">Average Score</p>
                    </div>
                </div>

                <!-- Badges Section -->
                <div
                    class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl overflow-hidden mb-6">
                    <div
                        class="px-6 py-4 bg-gradient-to-r from-indigo-500/20 to-purple-500/20 border-b border-slate-700">
                        <h5 class="text-xl font-bold text-white flex items-center gap-2">
                            <i class="bi bi-award"></i>
                            My Badges
                        </h5>
                    </div>
                    <div class="p-6">
                        @if ($badges->count() > 0)
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach ($badges as $userBadge)
                                    <div
                                        class="bg-slate-800/50 border border-slate-700 rounded-xl p-4 text-center hover:border-indigo-500/50 hover:-translate-y-1 transition-all">
                                        <div class="mb-3 text-5xl">
                                            {{ $userBadge->badge->icon ?? '🏆' }}
                                        </div>
                                        <h6 class="text-white font-semibold mb-2">{{ $userBadge->badge->name }}</h6>
                                        <p class="text-slate-400 text-xs mb-2 line-clamp-2">
                                            {{ $userBadge->badge->description }}</p>
                                        <small class="text-slate-500 text-xs flex items-center justify-center gap-1">
                                            <i class="bi bi-calendar-check"></i>
                                            {{ $userBadge->awarded_at->format('M d, Y') }}
                                        </small>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-16">
                                <i class="bi bi-award text-slate-600 text-8xl block mb-4"></i>
                                <h5 class="text-slate-300 text-xl mb-2">No badges earned yet</h5>
                                <p class="text-slate-400">Complete competitions to earn badges!</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Completed Competitions Section -->
                <div
                    class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl overflow-hidden">
                    <div
                        class="px-6 py-4 bg-gradient-to-r from-indigo-500/20 to-purple-500/20 border-b border-slate-700">
                        <h5 class="text-xl font-bold text-white flex items-center gap-2">
                            <i class="bi bi-trophy"></i>
                            Completed Competitions
                        </h5>
                    </div>
                    <div class="p-6">
                        @if ($completedCompetitions->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead class="border-b border-slate-700">
                                        <tr>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">
                                                Competition Title</th>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">
                                                Completed At</th>
                                            <th
                                                class="px-4 py-3 text-right text-xs font-semibold text-slate-300 uppercase tracking-wider">
                                                Score</th>
                                            <th
                                                class="px-4 py-3 text-right text-xs font-semibold text-slate-300 uppercase tracking-wider">
                                                Progress</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-700/50">
                                        @foreach ($completedCompetitions as $participant)
                                            <tr class="hover:bg-slate-800/50 transition">
                                                <td class="px-4 py-4">
                                                    <strong
                                                        class="text-white">{{ $participant->competition->title }}</strong>
                                                </td>
                                                <td class="px-4 py-4 text-slate-300 text-sm">
                                                    <i class="bi bi-calendar-check mr-1"></i>
                                                    {{ $participant->finished_at->format('M d, Y H:i') }}
                                                </td>
                                                <td class="px-4 py-4 text-right">
                                                    <span
                                                        class="px-3 py-1 bg-green-500/20 text-green-400 border border-green-500/30 rounded-full text-xs font-semibold">
                                                        {{ $participant->total_score }} pts
                                                    </span>
                                                </td>
                                                <td class="px-4 py-4 text-right">
                                                    <span
                                                        class="px-3 py-1 bg-cyan-500/20 text-cyan-400 border border-cyan-500/30 rounded-full text-xs font-semibold">
                                                        {{ $participant->progress_percentage }}%
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-16">
                                <i class="bi bi-trophy text-slate-600 text-8xl block mb-4"></i>
                                <h5 class="text-slate-300 text-xl mb-2">No completed competitions yet</h5>
                                <p class="text-slate-400 mb-6">Start competing to see your achievements here!</p>
                                <a href="{{ route('peserta.competitions.list') }}"
                                    class="inline-flex items-center gap-2 px-6 py-3 gradient-primary text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-indigo-500/50 transition-all">
                                    <i class="bi bi-lightning-charge"></i>
                                    Browse Competitions
                                </a>
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

        body.light-theme .bi-award,
        body.light-theme .bi-trophy {
            color: #cbd5e1 !important;
        }

        body.light-theme .text-yellow-300\/75,
        body.light-theme .text-green-300\/75,
        body.light-theme .text-cyan-300\/75 {
            color: #64748b !important;
        }
    </style>
</div>
