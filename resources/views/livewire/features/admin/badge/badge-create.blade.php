<div>
    <div>
        <div>
            <div>
                <!-- Page Header -->
                <div class="mb-8">
                    <div class="flex items-center gap-4 mb-4">
                        <a href="{{ route('admin.badges.index') }}" wire:navigate
                            class="p-3 bg-slate-800 border border-slate-700 text-white rounded-xl hover:bg-slate-700 transition">
                            <i class="bi bi-arrow-left"></i>
                        </a>
                        <div>
                            <h1
                                class="text-3xl font-bold text-transparent bg-gradient-to-r from-indigo-400 to-pink-400 bg-clip-text flex items-center gap-2">
                                <i class="bi bi-plus-circle"></i>
                                Tambah Badge Baru
                            </h1>
                            <p class="text-slate-400">Buat badge baru untuk reward sistem</p>
                        </div>
                    </div>
                </div>

                <!-- Form & Preview Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Form Card -->
                    <div class="lg:col-span-2">
                        <div
                            class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-6">
                            <h3 class="text-xl font-bold text-white mb-6">Form Badge</h3>

                            <form wire:submit="save" class="space-y-6">
                                <!-- Name -->
                                <div>
                                    <label class="block text-sm font-semibold text-slate-300 mb-2">
                                        Nama Badge <span class="text-red-400">*</span>
                                    </label>
                                    <input type="text" wire:model="name"
                                        class="w-full px-4 py-3 bg-slate-900 border @error('name') border-red-500 @else border-slate-700 @enderror rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                                        placeholder="Masukkan nama badge">
                                    @error('name')
                                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div>
                                    <label class="block text-sm font-semibold text-slate-300 mb-2">Deskripsi</label>
                                    <textarea wire:model="description" rows="3"
                                        class="w-full px-4 py-3 bg-slate-900 border @error('description') border-red-500 @else border-slate-700 @enderror rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                                        placeholder="Deskripsi badge"></textarea>
                                    @error('description')
                                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Condition Builder -->
                                <div>
                                    <label class="block text-sm font-semibold text-slate-300 mb-2">Tipe Kondisi
                                        Badge</label>
                                    <select wire:model.live="condition_type"
                                        class="w-full px-4 py-3 bg-slate-900 border @error('condition_type') border-red-500 @else border-slate-700 @enderror rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                                        <option value="">-- Pilih Kondisi --</option>
                                        <option value="first_completion">Kompetisi Pertama</option>
                                        <option value="perfect_score">Nilai Sempurna</option>
                                        <option value="completion_count">Jumlah Kompetisi Selesai</option>
                                        <option value="speed_completion">Selesai Cepat</option>
                                        <option value="top_scorer">Top Scorer</option>
                                    </select>
                                    @error('condition_type')
                                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-2 text-xs text-slate-400">Pilih kondisi yang harus dipenuhi untuk
                                        mendapatkan badge ini</p>
                                </div>

                                <!-- Dynamic Condition Parameters -->
                                @if ($condition_type === 'perfect_score')
                                    <div class="ml-4 bg-yellow-500/10 border border-yellow-500/30 rounded-xl p-4">
                                        <label class="block text-sm font-semibold text-yellow-400 mb-2">
                                            <i class="bi bi-star-fill"></i> Jumlah Nilai Sempurna yang Dibutuhkan
                                        </label>
                                        <input type="number" wire:model.live="required_count" min="1"
                                            value="1"
                                            class="w-full px-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-yellow-500 transition">
                                        <p class="mt-2 text-xs text-slate-400">Peserta harus mendapat nilai 100%
                                            sebanyak
                                            ini</p>
                                    </div>
                                @endif

                                @if ($condition_type === 'completion_count')
                                    <div class="ml-4 bg-green-500/10 border border-green-500/30 rounded-xl p-4">
                                        <label class="block text-sm font-semibold text-green-400 mb-2">
                                            <i class="bi bi-check2-all"></i> Jumlah Kompetisi yang Harus Diselesaikan
                                        </label>
                                        <input type="number" wire:model.live="required_count" min="1"
                                            value="1"
                                            class="w-full px-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                                        <p class="mt-2 text-xs text-slate-400">Peserta harus menyelesaikan kompetisi
                                            sebanyak ini (nilai berapapun)</p>
                                    </div>
                                @endif

                                @if ($condition_type === 'speed_completion')
                                    <div class="ml-4 bg-blue-500/10 border border-blue-500/30 rounded-xl p-4">
                                        <label class="block text-sm font-semibold text-blue-400 mb-2">
                                            <i class="bi bi-lightning-fill"></i> Persentase Waktu Maksimal
                                        </label>
                                        <input type="number" wire:model.live="time_percentage" min="1"
                                            max="100" value="50"
                                            class="w-full px-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                                        <p class="mt-2 text-xs text-slate-400">Peserta harus menylelesaikan dalam
                                            {{ $time_percentage }}% dari waktu yang tersedia</p>
                                    </div>
                                @endif

                                @if ($condition_type === 'top_scorer')
                                    <div class="ml-4 bg-yellow-500/10 border border-yellow-500/30 rounded-xl p-4">
                                        <label class="block text-sm font-semibold text-yellow-400 mb-2">
                                            <i class="bi bi-trophy-fill"></i> Posisi Ranking Teratas
                                        </label>
                                        <input type="number" wire:model.live="top_position" min="1"
                                            value="3"
                                            class="w-full px-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-yellow-500 transition">
                                        <p class="mt-2 text-xs text-slate-400">Peserta harus masuk top
                                            {{ $top_position }}
                                            di leaderboard</p>
                                    </div>
                                @endif

                                @if ($condition_type === 'first_completion')
                                    <div
                                        class="ml-4 bg-blue-500/10 border border-blue-500/30 rounded-xl p-4 flex items-center gap-2">
                                        <i class="bi bi-info-circle text-blue-400"></i>
                                        <p class="text-sm text-blue-400">Badge ini akan diberikan otomatis saat peserta
                                            menyelesaikan kompetisi pertama mereka</p>
                                    </div>
                                @endif

                                @if ($condition)
                                    <div>
                                        <label class="block text-sm font-semibold text-slate-400 mb-2">Kondisi JSON
                                            (Otomatis)</label>
                                        <div class="bg-slate-900 border border-slate-700 rounded-xl p-4">
                                            <code class="text-green-400 text-xs">{{ $condition }}</code>
                                        </div>
                                    </div>
                                @endif

                                <!-- Badge Type -->
                                <div>
                                    <label class="block text-sm font-semibold text-slate-300 mb-2">
                                        Tipe Badge <span class="text-red-400">*</span>
                                    </label>
                                    <select wire:model="badge_type"
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

                                <!-- Icon -->
                                <div>
                                    <label class="block text-sm font-semibold text-slate-300 mb-2">Icon (Emoji)</label>
                                    <input type="text" wire:model="icon" maxlength="10"
                                        class="w-full px-4 py-3 bg-slate-900 border @error('icon') border-red-500 @else border-slate-700 @enderror rounded-xl text-white text-3xl placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                                        placeholder="🏆">
                                    @error('icon')
                                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-2 text-xs text-slate-400">Gunakan emoji sebagai icon. Contoh: 🏆 🥇 ⭐
                                        🎯
                                    </p>
                                </div>

                                <!-- Image URL -->
                                <div>
                                    <label class="block text-sm font-semibold text-slate-300 mb-2">URL Gambar</label>
                                    <input type="url" wire:model="image_url"
                                        class="w-full px-4 py-3 bg-slate-900 border @error('image_url') border-red-500 @else border-slate-700 @enderror rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                                        placeholder="https://example.com/badge.png">
                                    @error('image_url')
                                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-2 text-xs text-slate-400">Opsional. URL gambar badge jika tersedia.
                                    </p>
                                </div>

                                <!-- Buttons -->
                                <div class="flex justify-end gap-4 pt-6 border-t border-slate-700">
                                    <a href="{{ route('admin.badges.index') }}" wire:navigate
                                        class="px-6 py-3 bg-slate-700 text-white font-semibold rounded-xl hover:bg-slate-600 transition">
                                        <i class="bi bi-x-circle"></i>
                                        Batal
                                    </a>
                                    <button type="submit"
                                        class="inline-flex items-center gap-2 px-6 py-3 gradient-primary text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-indigo-500/50 transition">
                                        <i class="bi bi-save"></i>
                                        Simpan Badge
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Preview Card -->
                    <div class="lg:col-span-1">
                        <div
                            class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl overflow-hidden sticky top-6">
                            <div class="px-6 py-4 bg-slate-900/50 border-b border-slate-700">
                                <h3 class="text-lg font-bold text-white">Preview</h3>
                            </div>
                            <div class="p-6 text-center">
                                <div class="mb-4">
                                    <span class="text-7xl">{{ $icon ?: '🏅' }}</span>
                                </div>
                                <h3 class="text-2xl font-bold text-white mb-3">{{ $name ?: 'Nama Badge' }}</h3>
                                @if ($badge_type === 'achievement')
                                    <span
                                        class="px-4 py-2 rounded-full text-sm font-semibold bg-blue-500/20 text-blue-400 border border-blue-500/30">Achievement</span>
                                @elseif($badge_type === 'milestone')
                                    <span
                                        class="px-4 py-2 rounded-full text-sm font-semibold bg-green-500/20 text-green-400 border border-green-500/30">Milestone</span>
                                @elseif($badge_type === 'streak')
                                    <span
                                        class="px-4 py-2 rounded-full text-sm font-semibold bg-yellow-500/20 text-yellow-400 border border-yellow-500/30">Streak</span>
                                @else
                                    <span
                                        class="px-4 py-2 rounded-full text-sm font-semibold bg-cyan-500/20 text-cyan-400 border border-cyan-500/30">{{ ucfirst($badge_type) }}</span>
                                @endif
                                <p class="text-slate-400 text-sm mt-4">
                                    {{ $description ?: 'Deskripsi badge akan muncul di sini' }}</p>
                                @if ($condition)
                                    <div class="mt-4 bg-slate-800/50 border border-slate-700 rounded-xl p-3">
                                        <p class="text-xs text-slate-300"><strong>Kondisi:</strong></p>
                                        <p class="text-xs text-slate-400 mt-1">{{ $condition }}</p>
                                    </div>
                                @endif>
                            </div>
                        </div>
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

        body.light-theme input,
        body.light-theme select,
        body.light-theme textarea {
            background: white !important;
            color: #0f172a !important;
            border-color: #cbd5e1 !important;
        }

        body.light-theme .bg-slate-800\/50 {
            background: #f8fafc !important;
        }
    </style>
</div>
