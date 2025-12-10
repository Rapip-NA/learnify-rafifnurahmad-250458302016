<div>
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1
                    class="text-3xl font-bold text-transparent bg-gradient-to-r from-indigo-400 to-pink-400 bg-clip-text mb-2">
                    Edit Badge
                </h1>
                <p class="text-slate-400">Perbarui informasi dan kriteria badge.</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.badges.index') }}"
                    class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium rounded-md text-white bg-slate-700 hover:bg-slate-600 transition-colors duration-200">
                    <i class="bi bi-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Form Section -->
        <div class="lg:col-span-2">
            <div
                class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl overflow-hidden">
                <div class="px-4 py-4 md:px-6 md:py-4 border-b border-slate-700">
                    <h3 class="text-xl font-bold text-white">Form Badge</h3>
                </div>
                <div class="p-4 md:p-6">
                    <form wire:submit="update" class="space-y-6">
                        {{-- Name (Readonly) --}}
                        <div>
                            <label for="name" class="block text-sm font-semibold text-slate-300 mb-2">
                                Nama Badge
                                <span class="ml-2 px-2 py-0.5 rounded-full bg-slate-700 text-xs text-slate-300">Tidak
                                    dapat diubah</span>
                            </label>
                            <input type="text" wire:model="name" id="name" readonly disabled
                                class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-slate-400 cursor-not-allowed">
                            <p class="mt-2 text-xs text-slate-500">Nama badge tidak dapat diubah setelah dibuat</p>
                        </div>

                        {{-- Description --}}
                        <div>
                            <label for="description"
                                class="block text-sm font-semibold text-slate-300 mb-2">Deskripsi</label>
                            <textarea wire:model="description" id="description" rows="3"
                                class="w-full px-4 py-3 bg-slate-900 border @error('description') border-red-500 @else border-slate-700 @enderror rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                                placeholder="Masukkan deskripsi badge"></textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Badge Type --}}
                        <div>
                            <label for="badge_type" class="block text-sm font-semibold text-slate-300 mb-2">
                                Tipe Badge <span class="text-red-400">*</span>
                            </label>
                            <select wire:model="badge_type" id="badge_type"
                                class="w-full px-4 py-3 bg-slate-900 border @error('badge_type') border-red-500 @else border-slate-700 @enderror rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                                <option value="achievement">Achievement</option>
                                <option value="milestone">Milestone</option>
                                <option value="streak">Streak</option>
                                <option value="special">Special</option>
                            </select>
                            @error('badge_type')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Icon --}}
                        <div>
                            <label for="icon" class="block text-sm font-semibold text-slate-300 mb-2">Icon
                                (Emoji)</label>
                            <input type="text" wire:model="icon" id="icon" placeholder="🏆" maxlength="10"
                                class="w-full px-4 py-3 bg-slate-900 border @error('icon') border-red-500 @else border-slate-700 @enderror rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                            @error('icon')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-xs text-slate-500">Gunakan emoji sebagai icon. Contoh: 🏆 🥇 ⭐ 🎯</p>
                        </div>

                        {{-- Image URL --}}
                        <div>
                            <label for="image_url" class="block text-sm font-semibold text-slate-300 mb-2">URL
                                Gambar</label>
                            <input type="url" wire:model="image_url" id="image_url"
                                placeholder="https://example.com/badge.png"
                                class="w-full px-4 py-3 bg-slate-900 border @error('image_url') border-red-500 @else border-slate-700 @enderror rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                            @error('image_url')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-xs text-slate-500">Opsional. URL gambar badge jika tersedia.</p>
                        </div>

                        {{-- Condition Builder --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Kondisi Badge</label>

                            <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4 md:p-6">
                                {{-- Condition Type --}}
                                <div class="mb-4">
                                    <label for="condition_type" class="block text-sm text-slate-400 mb-1">Tipe
                                        Kondisi</label>
                                    <select wire:model.live="condition_type" id="condition_type"
                                        class="w-full px-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                                        <option value="">Pilih tipe kondisi...</option>
                                        <option value="perfect_score">Perfect Score</option>
                                        <option value="completion_count">Completion Count</option>
                                        <option value="speed_completion">Speed Completion</option>
                                        <option value="top_scorer">Top Scorer</option>
                                    </select>
                                </div>

                                {{-- Dynamic Fields --}}
                                @if ($condition_type === 'perfect_score')
                                    <div class="mb-4">
                                        <label class="block text-sm text-slate-400 mb-1">Jumlah Perfect Score</label>
                                        <input type="number" wire:model.live="required_count" min="1"
                                            class="w-full px-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                                        <p class="mt-2 text-xs text-slate-500">Jumlah kompetisi yang harus diselesaikan
                                            dengan perfect score</p>
                                    </div>
                                @elseif($condition_type === 'completion_count')
                                    <div class="mb-4">
                                        <label class="block text-sm text-slate-400 mb-1">Jumlah Kompetisi</label>
                                        <input type="number" wire:model.live="required_count" min="1"
                                            class="w-full px-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                                        <p class="mt-2 text-xs text-slate-500">Jumlah kompetisi yang harus diselesaikan
                                        </p>
                                    </div>
                                @elseif($condition_type === 'speed_completion')
                                    <div class="mb-4">
                                        <label class="block text-sm text-slate-400 mb-1">Persentase Waktu (%)</label>
                                        <input type="number" wire:model.live="time_percentage" min="1"
                                            max="100"
                                            class="w-full px-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                                        <p class="mt-2 text-xs text-slate-500">Selesaikan kompetisi dalam waktu kurang
                                            dari {{ $time_percentage }}% dari durasi total</p>
                                    </div>
                                @elseif($condition_type === 'top_scorer')
                                    <div class="mb-4">
                                        <label class="block text-sm text-slate-400 mb-1">Posisi Top</label>
                                        <input type="number" wire:model.live="top_position" min="1"
                                            max="10"
                                            class="w-full px-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                                        <p class="mt-2 text-xs text-slate-500">Masuk ke posisi top {{ $top_position }}
                                            di leaderboard</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Buttons --}}
                        <div
                            class="flex flex-col md:flex-row justify-between items-center gap-4 pt-6 border-t border-slate-700">
                            <button type="button" onclick="confirmDeleteBadgeEdit()"
                                class="order-3 md:order-1 inline-flex justify-center items-center gap-2 px-6 py-3 bg-red-500/20 text-red-400 border border-red-500/30 font-semibold rounded-xl hover:bg-red-500/30 transition-all w-full md:w-auto">
                                <i class="bi bi-trash"></i>
                                Hapus Badge
                            </button>
                            <div class="order-1 md:order-2 flex flex-col md:flex-row gap-4 w-full md:w-auto">
                                <a href="{{ route('admin.badges.index') }}" wire:navigate
                                    class="inline-flex justify-center items-center px-6 py-3 bg-slate-700 text-white font-semibold rounded-xl hover:bg-slate-600 transition-all w-full md:w-auto">
                                    <i class="bi bi-x-circle mr-2"></i>
                                    Batal
                                </a>
                                <button type="submit"
                                    class="inline-flex justify-center items-center gap-2 px-6 py-3 gradient-primary text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-indigo-500/50 transition-all w-full md:w-auto">
                                    <i class="bi bi-save"></i>
                                    Update Badge
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Preview Section -->
        <div class="lg:col-span-1 space-y-6">
            <div
                class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl overflow-hidden">
                <div class="px-4 py-4 md:px-6 md:py-4 border-b border-slate-700">
                    <h5 class="text-xl font-bold text-white">Preview</h5>
                </div>
                <div class="p-6 text-center">
                    <div class="mb-4">
                        <span class="text-6xl">{{ $icon ?: '🏅' }}</span>
                    </div>
                    <h5 class="text-xl font-bold text-white mb-2">{{ $name ?: 'Nama Badge' }}</h5>

                    @php
                        $badgeColor = match ($badge_type) {
                            'achievement' => 'bg-blue-500/20 text-blue-400 border-blue-500/30',
                            'milestone' => 'bg-green-500/20 text-green-400 border-green-500/30',
                            'streak' => 'bg-yellow-500/20 text-yellow-400 border-yellow-500/30',
                            'special' => 'bg-purple-500/20 text-purple-400 border-purple-500/30',
                            default => 'bg-slate-500/20 text-slate-400 border-slate-500/30',
                        };
                    @endphp

                    <span
                        class="inline-block px-3 py-1 rounded-full text-xs font-semibold border {{ $badgeColor }} mb-3">
                        {{ ucfirst($badge_type) }}
                    </span>

                    <p class="text-slate-400 text-sm leading-relaxed">
                        {{ $description ?: 'Deskripsi badge akan muncul di sini' }}</p>
                </div>
            </div>

            {{-- Stats Card --}}
            <div
                class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl overflow-hidden p-6">
                <h6 class="text-lg font-bold text-white mb-4">Statistik</h6>
                <div class="flex justify-between items-center">
                    <span class="text-slate-400">Total Earned</span>
                    <span
                        class="px-3 py-1 bg-indigo-500/20 text-indigo-400 border border-indigo-500/30 rounded-full text-sm font-semibold">
                        {{ $badge->users->count() }} users
                    </span>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDeleteBadgeEdit() {
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
                    @this.call('deleteBadge');
                }
            });
        }

        window.addEventListener('badge-updated', event => {
            Swal.fire({
                title: 'Berhasil!',
                text: 'Badge berhasil diperbarui.',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false,
                background: '#1e293b',
                color: '#e2e8f0',
            }).then(() => {
                window.location.href = "{{ route('admin.badges.index') }}";
            });
        });

        window.addEventListener('badge-deleted', event => {
            Swal.fire({
                title: 'Berhasil!',
                text: 'Badge berhasil dihapus.',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false,
                background: '#1e293b',
                color: '#e2e8f0',
            }).then(() => {
                window.location.href = "{{ route('admin.badges.index') }}";
            });
        });
    </script>

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

        body.light-theme .bg-slate-900,
        body.light-theme .bg-slate-800 {
            background: #f8fafc !important;
        }

        body.light-theme .bg-slate-800\/50 {
            background: #f1f5f9 !important;
        }

        body.light-theme input,
        body.light-theme select,
        body.light-theme textarea {
            background: white !important;
            color: #0f172a !important;
            border-color: #cbd5e1 !important;
        }
    </style>
</div>
