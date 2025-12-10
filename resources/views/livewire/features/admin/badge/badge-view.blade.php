<div>
    <div>
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1
                        class="text-3xl font-bold text-transparent bg-gradient-to-r from-indigo-400 to-pink-400 bg-clip-text mb-2 flex items-center gap-2">
                        <span class="text-4xl">{{ $badge->icon ?? '🏅' }}</span>
                        {{ $badge->name }}
                    </h1>
                    <p class="text-slate-400">{{ $badge->description }}</p>
                </div>
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('admin.dashboard') }}"
                                class="text-slate-400 hover:text-white transition">Dashboard</a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="bi bi-chevron-right text-slate-600 mx-2"></i>
                                <a href="{{ route('admin.badges.index') }}"
                                    class="text-slate-400 hover:text-white transition">Badges</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <i class="bi bi-chevron-right text-slate-600 mx-2"></i>
                                <span class="text-indigo-400">{{ $badge->name }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Badge Info Card --}}
            <div class="lg:col-span-1">
                <div
                    class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl overflow-hidden sticky top-6">
                    <div class="p-6 text-center">
                        <div class="mb-4">
                            <span class="text-7xl">{{ $badge->icon ?? '🏅' }}</span>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-3">{{ $badge->name }}</h3>

                        @php
                            $badgeColor = match ($badge->badge_type) {
                                'achievement' => 'bg-blue-500/20 text-blue-400 border-blue-500/30',
                                'milestone' => 'bg-green-500/20 text-green-400 border-green-500/30',
                                'streak' => 'bg-yellow-500/20 text-yellow-400 border-yellow-500/30',
                                'special' => 'bg-purple-500/20 text-purple-400 border-purple-500/30',
                                default => 'bg-slate-500/20 text-slate-400 border-slate-500/30',
                            };
                        @endphp

                        <span
                            class="inline-block px-4 py-2 rounded-full text-sm font-semibold border {{ $badgeColor }} mb-4">
                            {{ ucfirst($badge->badge_type) }}
                        </span>

                        <p class="text-slate-400 text-sm leading-relaxed mb-6">{{ $badge->description }}</p>

                        <div class="pt-6 border-t border-slate-700">
                            <p class="text-4xl font-bold text-white mb-1">{{ $badge->users->count() }}</p>
                            <p class="text-slate-500 text-sm">Users Earned This Badge</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Users List --}}
            <div class="lg:col-span-2 space-y-6">
                <div
                    class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-700 flex items-center justify-between">
                        <h4 class="text-lg font-bold text-white flex items-center gap-2">
                            <i class="bi bi-people-fill text-indigo-400"></i>
                            Users List
                        </h4>
                    </div>

                    @if ($badge->users->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-slate-900/50 text-slate-400 text-xs uppercase font-semibold">
                                    <tr>
                                        <th class="px-6 py-4">User</th>
                                        <th class="px-6 py-4">Email</th>
                                        <th class="px-6 py-4">Awarded At</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-700">
                                    @foreach ($badge->users as $user)
                                        <tr class="hover:bg-slate-800/30 transition">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold text-xs">
                                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                                    </div>
                                                    <span class="text-white font-medium">{{ $user->name }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-slate-400 text-sm">
                                                {{ $user->email }}
                                            </td>
                                            <td class="px-6 py-4 text-slate-400 text-sm">
                                                {{ $user->pivot->awarded_at ? \Carbon\Carbon::parse($user->pivot->awarded_at)->format('d M Y H:i') : '-' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="p-12 text-center">
                            <i class="bi bi-inbox text-slate-600 text-5xl mb-4 block"></i>
                            <p class="text-slate-400">Belum ada user yang mendapatkan badge ini.</p>
                        </div>
                    @endif
                </div>

                {{-- Back Button --}}
                <div>
                    <a href="{{ route('admin.badges.index') }}" wire:navigate
                        class="inline-flex justify-center items-center gap-2 px-6 py-3 bg-slate-800 border border-slate-700 text-white font-semibold rounded-xl hover:bg-slate-700 transition w-full md:w-auto">
                        <i class="bi bi-arrow-left"></i>
                        Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Light theme adjustments */
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

        body.light-theme .text-slate-500 {
            color: #94a3b8 !important;
        }

        body.light-theme .border-slate-700 {
            border-color: #e2e8f0 !important;
        }

        body.light-theme .bg-slate-900,
        body.light-theme .bg-slate-800 {
            background: #f8fafc !important;
        }

        body.light-theme .divide-slate-700> :not([hidden])~ :not([hidden]) {
            border-color: #e2e8f0 !important;
        }

        body.light-theme .hover\:bg-slate-800\/30:hover {
            background-color: #f1f5f9 !important;
        }

        body.light-theme .bg-slate-900\/50 {
            background: #f8fafc !important;
        }

        body.light-theme .bi-inbox {
            color: #cbd5e1 !important;
        }

        body.light-theme .sticky {
            background: white !important;
        }
    </style>
</div>
