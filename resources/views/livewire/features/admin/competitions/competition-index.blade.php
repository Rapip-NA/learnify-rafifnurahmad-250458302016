<div>
    <div>
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1
                        class="text-3xl font-bold text-transparent bg-gradient-to-r from-indigo-400 to-pink-400 bg-clip-text mb-2">
                        <i class="bi bi-trophy mr-2"></i>Competitions
                    </h1>
                    <p class="text-slate-400">Manage all competitions here.</p>
                </div>
                <a href="{{ route('admin.competitions.create') }}"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 gradient-primary text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-indigo-500/50 transition-all w-full md:w-auto">
                    <i class="bi bi-plus-circle"></i>
                    Create Competition
                </a>
            </div>
        </div>

        <!-- Filters Card -->
        <div class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Search -->
                <div>
                    <input type="text"
                        class="w-full px-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                        placeholder="Search competitions..." wire:model.live.debounce.300ms="search">
                </div>

                <!-- Status Filter -->
                <div>
                    <select
                        class="w-full px-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                        wire:model.live="statusFilter">
                        <option value="">All Status</option>
                        <option value="draft">Draft</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Mobile Card View (Visible on small screens) -->
        <div class="grid grid-cols-1 gap-6 md:hidden mb-6">
            @forelse($competitions as $competition)
                <div
                    class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-5 space-y-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-bold text-white text-lg mb-1">{{ $competition->title }}</h3>
                            <p class="text-sm text-slate-400">{{ $competition->creator->name ?? 'N/A' }}</p>
                        </div>
                        @if ($competition->status === 'draft')
                            <span
                                class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-500/20 text-gray-400 border border-gray-500/30">Draft</span>
                        @elseif($competition->status === 'active')
                            <span
                                class="px-3 py-1 rounded-full text-xs font-semibold bg-green-500/20 text-green-400 border border-green-500/30">Active</span>
                        @else
                            <span
                                class="px-3 py-1 rounded-full text-xs font-semibold bg-red-500/20 text-red-400 border border-red-500/30">Inactive</span>
                        @endif
                    </div>

                    @if ($competition->description)
                        <p class="text-sm text-slate-400 line-clamp-2">{{ $competition->description }}</p>
                    @endif

                    <div class="grid grid-cols-2 gap-4 py-4 border-y border-slate-700/50">
                        <div>
                            <p class="text-xs text-slate-500 mb-1">Start Date</p>
                            <p class="text-sm text-slate-300">{{ $competition->start_date->format('d M Y, H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 mb-1">End Date</p>
                            <p class="text-sm text-slate-300">{{ $competition->end_date->format('d M Y, H:i') }}</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-2">
                        <a href="{{ route('admin.competitions.view', $competition) }}"
                            class="p-2 rounded-lg bg-blue-500/20 text-blue-400 hover:bg-blue-500/30 border border-blue-500/30 transition flex-1 text-center"
                            title="View">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('admin.competitions.edit', $competition) }}"
                            class="p-2 rounded-lg bg-yellow-500/20 text-yellow-400 hover:bg-yellow-500/30 border border-yellow-500/30 transition flex-1 text-center"
                            title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <button onclick="confirmDelete({{ $competition->id }})"
                            class="p-2 rounded-lg bg-red-500/20 text-red-400 hover:bg-red-500/30 border border-red-500/30 transition flex-1 text-center"
                            title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            @empty
                <div class="text-center py-12 bg-slate-800/50 rounded-2xl border border-slate-700">
                    <i class="bi bi-inbox text-slate-600 text-6xl block mb-4"></i>
                    <p class="text-slate-400">No competitions found.</p>
                </div>
            @endforelse
        </div>

        <!-- Mobile Pagination -->
        @if ($competitions->hasPages())
            <div
                class="md:hidden mb-6 bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-4">
                <div class="flex flex-col gap-4">
                    <!-- Results Info -->
                    <div class="text-sm text-slate-400 text-center">
                        Showing {{ $competitions->firstItem() }} to {{ $competitions->lastItem() }} of
                        {{ $competitions->total() }} results
                    </div>

                    <!-- Pagination Controls -->
                    <div class="flex items-center justify-center gap-2">
                        {{-- Previous Button --}}
                        @if ($competitions->onFirstPage())
                            <span
                                class="px-4 py-2 text-sm text-slate-600 bg-slate-800 border border-slate-700 rounded-lg cursor-not-allowed">
                                «
                            </span>
                        @else
                            <button wire:click="previousPage"
                                class="px-4 py-2 text-sm text-slate-300 bg-slate-800 border border-slate-700 rounded-lg hover:bg-slate-700 hover:text-white transition">
                                «
                            </button>
                        @endif

                        {{-- Page Info --}}
                        <span
                            class="px-4 py-2 text-sm font-semibold text-white bg-indigo-600 border border-indigo-500 rounded-lg">
                            {{ $competitions->currentPage() }} / {{ $competitions->lastPage() }}
                        </span>

                        {{-- Next Button --}}
                        @if ($competitions->hasMorePages())
                            <button wire:click="nextPage"
                                class="px-4 py-2 text-sm text-slate-300 bg-slate-800 border border-slate-700 rounded-lg hover:bg-slate-700 hover:text-white transition">
                                »
                            </button>
                        @else
                            <span
                                class="px-4 py-2 text-sm text-slate-600 bg-slate-800 border border-slate-700 rounded-lg cursor-not-allowed">
                                »
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        <!-- Desktop Table View (Hidden on small screens) -->
        <div
            class="hidden md:block bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-900/50 border-b border-slate-700">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Title</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Start Date</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">End Date</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Created By</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-slate-300">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-700/50">
                        @forelse($competitions as $competition)
                            <tr class="hover:bg-slate-800/50 transition">
                                <td class="px-6 py-4">
                                    <div>
                                        <div class="font-semibold text-white mb-1">{{ $competition->title }}</div>
                                        @if ($competition->description)
                                            <div class="text-sm text-slate-400">
                                                {{ Str::limit($competition->description, 50) }}</div>
                                        @endif
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-slate-300 text-sm">
                                    {{ $competition->start_date->format('M d, Y H:i') }}
                                </td>

                                <td class="px-6 py-4 text-slate-300 text-sm">
                                    {{ $competition->end_date->format('M d, Y H:i') }}
                                </td>

                                <td class="px-6 py-4">
                                    @if ($competition->status === 'draft')
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-500/20 text-gray-400 border border-gray-500/30">Draft</span>
                                    @elseif($competition->status === 'active')
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold bg-green-500/20 text-green-400 border border-green-500/30">Active</span>
                                    @else
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold bg-red-500/20 text-red-400 border border-red-500/30">Inactive</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-slate-300 text-sm">
                                    {{ $competition->creator->name ?? 'N/A' }}
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- View Button -->
                                        <a href="{{ route('admin.competitions.view', $competition) }}"
                                            class="p-2 rounded-lg bg-blue-500/20 text-blue-400 hover:bg-blue-500/30 border border-blue-500/30 transition"
                                            title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <!-- Edit Button -->
                                        <a href="{{ route('admin.competitions.edit', $competition) }}"
                                            class="p-2 rounded-lg bg-yellow-500/20 text-yellow-400 hover:bg-yellow-500/30 border border-yellow-500/30 transition"
                                            title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <!-- Delete Button -->
                                        <button onclick="confirmDelete({{ $competition->id }})"
                                            class="p-2 rounded-lg bg-red-500/20 text-red-400 hover:bg-red-500/30 border border-red-500/30 transition"
                                            title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <i class="bi bi-inbox text-slate-600 text-6xl block mb-4"></i>
                                    <p class="text-slate-400">No competitions found.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($competitions->hasPages())
                <div class="px-6 py-4 border-t border-slate-700">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                        <!-- Results Info -->
                        <div class="text-sm text-slate-400">
                            Showing {{ $competitions->firstItem() }} to {{ $competitions->lastItem() }} of
                            {{ $competitions->total() }} results
                        </div>

                        <!-- Pagination Links -->
                        <div class="flex items-center gap-1">
                            {{-- Previous Button --}}
                            @if ($competitions->onFirstPage())
                                <span
                                    class="px-3 py-2 text-sm text-slate-600 bg-slate-800 border border-slate-700 rounded-lg cursor-not-allowed">
                                    « Previous
                                </span>
                            @else
                                <button wire:click="previousPage"
                                    class="px-3 py-2 text-sm text-slate-300 bg-slate-800 border border-slate-700 rounded-lg hover:bg-slate-700 hover:text-white transition">
                                    « Previous
                                </button>
                            @endif

                            {{-- Page Numbers --}}
                            @foreach ($competitions->getUrlRange(1, $competitions->lastPage()) as $page => $url)
                                @if ($page == $competitions->currentPage())
                                    <span
                                        class="px-3 py-2 text-sm font-semibold text-white bg-indigo-600 border border-indigo-500 rounded-lg">
                                        {{ $page }}
                                    </span>
                                @else
                                    <button wire:click="gotoPage({{ $page }})"
                                        class="px-3 py-2 text-sm text-slate-300 bg-slate-800 border border-slate-700 rounded-lg hover:bg-slate-700 hover:text-white transition">
                                        {{ $page }}
                                    </button>
                                @endif
                            @endforeach

                            {{-- Next Button --}}
                            @if ($competitions->hasMorePages())
                                <button wire:click="nextPage"
                                    class="px-3 py-2 text-sm text-slate-300 bg-slate-800 border border-slate-700 rounded-lg hover:bg-slate-700 hover:text-white transition">
                                    Next »
                                </button>
                            @else
                                <span
                                    class="px-3 py-2 text-sm text-slate-600 bg-slate-800 border border-slate-700 rounded-lg cursor-not-allowed">
                                    Next »
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <script>
            function confirmDelete(id) {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Kompetisi ini akan dihapus secara permanen!",
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
                        @this.call('delete', id);
                    }
                });
            }

            window.addEventListener('competition-deleted', event => {
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Kompetisi berhasil dihapus.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false,
                    background: '#1e293b',
                    color: '#e2e8f0',
                });
            });

            @if (session('competition-created'))
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Kompetisi berhasil dibuat.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false,
                    background: '#1e293b',
                    color: '#e2e8f0',
                });
            @endif

            @if (session('competition-updated'))
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Kompetisi berhasil diperbarui.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false,
                    background: '#1e293b',
                    color: '#e2e8f0',
                });
            @endif
        </script>
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

        body.light-theme .border-slate-700 {
            border-color: #e2e8f0 !important;
        }

        body.light-theme .bg-slate-900 {
            background: #f8fafc !important;
        }

        body.light-theme input,
        body.light-theme select {
            background: white !important;
            color: #0f172a !important;
            border-color: #cbd5e1 !important;
        }

        body.light-theme .hover\:bg-slate-800\/50:hover {
            background-color: rgba(241, 245, 249, 0.5) !important;
        }

        body.light-theme .bi-inbox {
            color: #cbd5e1 !important;
        }

        /* Pagination light theme */
        body.light-theme .bg-slate-800 {
            background: white !important;
        }

        body.light-theme .text-slate-600 {
            color: #94a3b8 !important;
        }

        body.light-theme .hover\:bg-slate-700:hover {
            background-color: #f1f5f9 !important;
        }
    </style>

</div>
