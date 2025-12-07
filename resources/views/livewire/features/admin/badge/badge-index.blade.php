<div>
    <div>
        <div>
            <div>
                <!-- Page Header -->
                <div class="mb-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h1
                                class="text-3xl font-bold text-transparent bg-gradient-to-r from-indigo-400 to-pink-400 bg-clip-text mb-2 flex items-center gap-2">
                                <i class="bi bi-award"></i>
                                Badge Management
                            </h1>
                            <p class="text-slate-400">Kelola badge dan reward sistem</p>
                        </div>
                        <a href="{{ route('admin.badges.create') }}" wire:navigate
                            class="inline-flex items-center gap-2 px-6 py-3 gradient-primary text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-indigo-500/50 transition-all">
                            <i class="bi bi-plus-circle"></i>
                            Tambah Badge
                        </a>
                    </div>
                </div>

                <!-- Alerts -->
                @if (session()->has('success'))
                    <div class="mb-6 p-4 bg-green-500/10 border border-green-500/30 rounded-xl flex items-center gap-3">
                        <i class="bi bi-check-circle text-green-400 text-xl"></i>
                        <span class="text-green-400">{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Search Card -->
                <div class="mb-6 bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-6">
                    <input type="text" wire:model.live.debounce.300ms="search"
                        class="w-full px-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                        placeholder="Cari badge...">
                </div>

                <!-- Badge Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($badges as $badge)
                        <div
                            class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl overflow-hidden hover:border-indigo-500/50 transition-all">
                            <div class="p-6">
                                <!-- Badge Header -->
                                <div class="flex items-start gap-4 mb-4">
                                    <div class="flex-shrink-0 text-6xl">{{ $badge->icon ?? '🏅' }}</div>
                                    <div class="flex-grow">
                                        <h3 class="text-xl font-bold text-white mb-2">{{ $badge->name }}</h3>
                                        @if ($badge->badge_type === 'achievement')
                                            <span
                                                class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-500/20 text-blue-400 border border-blue-500/30">Achievement</span>
                                        @elseif($badge->badge_type === 'milestone')
                                            <span
                                                class="px-3 py-1 rounded-full text-xs font-semibold bg-green-500/20 text-green-400 border border-green-500/30">Milestone</span>
                                        @elseif($badge->badge_type === 'streak')
                                            <span
                                                class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-500/20 text-yellow-400 border border-yellow-500/30">Streak</span>
                                        @else
                                            <span
                                                class="px-3 py-1 rounded-full text-xs font-semibold bg-cyan-500/20 text-cyan-400 border border-cyan-500/30">{{ ucfirst($badge->badge_type) }}</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Description -->
                                <p class="text-slate-400 text-sm mb-4 line-clamp-2">{{ $badge->description }}</p>

                                <!-- Footer -->
                                <div class="flex justify-between items-center pt-4 border-t border-slate-700">
                                    <div class="flex items-center gap-2 text-slate-400 text-sm">
                                        <i class="bi bi-people-fill"></i>
                                        <span>{{ $badge->users_count }} earned</span>
                                    </div>
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.badges.view', $badge) }}" wire:navigate
                                            class="p-2 rounded-lg bg-blue-500/20 text-blue-400 hover:bg-blue-500/30 border border-blue-500/30 transition"
                                            title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.badges.edit', $badge) }}" wire:navigate
                                            class="p-2 rounded-lg bg-yellow-500/20 text-yellow-400 hover:bg-yellow-500/30 border border-yellow-500/30 transition"
                                            title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button onclick="confirmDeleteBadge({{ $badge->id }})"
                                            class="p-2 rounded-lg bg-red-500/20 text-red-400 hover:bg-red-500/30 border border-red-500/30 transition"
                                            title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full">
                            <div
                                class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-12 text-center">
                                <i class="bi bi-inbox text-slate-600 text-6xl block mb-4"></i>
                                <p class="text-slate-400 text-lg">Belum ada badge</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if ($badges->hasPages())
                    <div
                        class="mt-6 bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-4">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-slate-400">
                                Menampilkan {{ $badges->firstItem() ?? 0 }} - {{ $badges->lastItem() ?? 0 }} dari
                                {{ $badges->total() }} badges
                            </div>
                            <div class="flex items-center gap-2">
                                {{-- Previous Button --}}
                                @if ($badges->onFirstPage())
                                    <span class="px-3 py-2 rounded-lg bg-slate-800 text-slate-600 cursor-not-allowed">
                                        <i class="bi bi-chevron-left"></i>
                                    </span>
                                @else
                                    <button wire:click="previousPage"
                                        class="px-3 py-2 rounded-lg bg-slate-800 text-slate-300 hover:bg-indigo-500 hover:text-white transition">
                                        <i class="bi bi-chevron-left"></i>
                                    </button>
                                @endif

                                {{-- Page Numbers --}}
                                @foreach ($badges->getUrlRange(1, $badges->lastPage()) as $page => $url)
                                    @if ($page == $badges->currentPage())
                                        <span class="px-4 py-2 rounded-lg gradient-primary text-white font-semibold">
                                            {{ $page }}
                                        </span>
                                    @else
                                        <button wire:click="gotoPage({{ $page }})"
                                            class="px-4 py-2 rounded-lg bg-slate-800 text-slate-300 hover:bg-slate-700 hover:text-white transition">
                                            {{ $page }}
                                        </button>
                                    @endif
                                @endforeach

                                {{-- Next Button --}}
                                @if ($badges->hasMorePages())
                                    <button wire:click="nextPage"
                                        class="px-3 py-2 rounded-lg bg-slate-800 text-slate-300 hover:bg-indigo-500 hover:text-white transition">
                                        <i class="bi bi-chevron-right"></i>
                                    </button>
                                @else
                                    <span class="px-3 py-2 rounded-lg bg-slate-800 text-slate-600 cursor-not-allowed">
                                        <i class="bi bi-chevron-right"></i>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function confirmDeleteBadge(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Badge ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                background: '#1e293b',
                color: '#e2e8f0',
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('deleteBadge', id);
                }
            });
        }

        window.addEventListener('badge-deleted', event => {
            Swal.fire({
                title: 'Berhasil!',
                text: 'Badge berhasil dihapus.',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false,
                background: '#1e293b',
                color: '#e2e8f0',
            });
        });
    </script>

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

        body.light-theme input {
            background: white !important;
            color: #0f172a !important;
            border-color: #cbd5e1 !important;
        }

        body.light-theme .bi-inbox {
            color: #cbd5e1 !important;
        }
    </style>
</div>
