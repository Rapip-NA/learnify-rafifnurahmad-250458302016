<div>
    <div class="page-heading mb-4">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3 class="mb-2">
                        <i class="bi bi-pencil-square text-primary me-2"></i>
                        Edit Badge
                    </h3>
                    <p class="text-subtitle text-muted">Perbarui informasi badge</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.badges.index') }}">Badges</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4 class="card-title">Form Badge</h4>
                    </div>
                    <div class="card-body">
                        <form wire:submit="update">
                            {{-- Name (Readonly) --}}
                            <div class="mb-3">
                                <label for="name" class="form-label">
                                    Nama Badge
                                    <span class="badge bg-secondary ms-2">Tidak dapat diubah</span>
                                </label>
                                <input type="text" wire:model="name" class="form-control" id="name" readonly
                                    disabled style="background-color: #f0f0f0;">
                                <small class="text-muted">Nama badge tidak dapat diubah setelah dibuat</small>
                            </div>

                            {{-- Description --}}
                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror" id="description"
                                    rows="3" placeholder="Masukkan deskripsi badge"></textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Badge Type --}}
                            <div class="mb-3">
                                <label for="badge_type" class="form-label">
                                    Tipe Badge <span class="text-danger">*</span>
                                </label>
                                <select wire:model="badge_type"
                                    class="form-select @error('badge_type') is-invalid @enderror" id="badge_type">
                                    <option value="achievement">Achievement</option>
                                    <option value="milestone">Milestone</option>
                                    <option value="streak">Streak</option>
                                    <option value="special">Special</option>
                                </select>
                                @error('badge_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Icon --}}
                            <div class="mb-3">
                                <label for="icon" class="form-label">Icon (Emoji)</label>
                                <input type="text" wire:model="icon"
                                    class="form-control @error('icon') is-invalid @enderror" id="icon"
                                    placeholder="🏆" maxlength="10">
                                @error('icon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Gunakan emoji sebagai icon. Contoh: 🏆 🥇 ⭐ 🎯</small>
                            </div>

                            {{-- Image URL --}}
                            <div class="mb-3">
                                <label for="image_url" class="form-label">URL Gambar</label>
                                <input type="url" wire:model="image_url"
                                    class="form-control @error('image_url') is-invalid @enderror" id="image_url"
                                    placeholder="https://example.com/badge.png">
                                @error('image_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Opsional. URL gambar badge jika tersedia.</small>
                            </div>

                            {{-- Condition Builder --}}
                            <div class="mb-3">
                                <label class="form-label">Kondisi Badge</label>

                                <div class="card bg-light">
                                    <div class="card-body">
                                        {{-- Condition Type --}}
                                        <div class="mb-3">
                                            <label for="condition_type" class="form-label">Tipe Kondisi</label>
                                            <select wire:model.live="condition_type" class="form-select"
                                                id="condition_type">
                                                <option value="">Pilih tipe kondisi...</option>
                                                <option value="perfect_score">Perfect Score</option>
                                                <option value="completion_count">Completion Count</option>
                                                <option value="speed_completion">Speed Completion</option>
                                                <option value="top_scorer">Top Scorer</option>
                                            </select>
                                        </div>

                                        {{-- Dynamic Fields Based on Condition Type --}}
                                        @if ($condition_type === 'perfect_score')
                                            <div class="mb-3">
                                                <label class="form-label">Jumlah Perfect Score</label>
                                                <input type="number" wire:model.live="required_count"
                                                    class="form-control" min="1">
                                                <small class="text-muted">Jumlah kompetisi yang harus diselesaikan
                                                    dengan perfect score</small>
                                            </div>
                                        @elseif($condition_type === 'completion_count')
                                            <div class="mb-3">
                                                <label class="form-label">Jumlah Kompetisi</label>
                                                <input type="number" wire:model.live="required_count"
                                                    class="form-control" min="1">
                                                <small class="text-muted">Jumlah kompetisi yang harus
                                                    diselesaikan</small>
                                            </div>
                                        @elseif($condition_type === 'speed_completion')
                                            <div class="mb-3">
                                                <label class="form-label">Persentase Waktu (%)</label>
                                                <input type="number" wire:model.live="time_percentage"
                                                    class="form-control" min="1" max="100">
                                                <small class="text-muted">Selesaikan kompetisi dalam waktu kurang dari
                                                    {{ $time_percentage }}% dari durasi total</small>
                                            </div>
                                        @elseif($condition_type === 'top_scorer')
                                            <div class="mb-3">
                                                <label class="form-label">Posisi Top</label>
                                                <input type="number" wire:model.live="top_position"
                                                    class="form-control" min="1" max="10">
                                                <small class="text-muted">Masuk ke posisi top {{ $top_position }} di
                                                    leaderboard</small>
                                            </div>
                                        @endif

                                        @if ($condition_type)
                                            <div class="alert alert-info mt-3 mb-0">
                                                <small><strong>Preview JSON:</strong> {{ $condition }}</small>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Buttons --}}
                            <div class="d-flex gap-2 justify-content-between mt-4">
                                <button type="button" onclick="confirmDeleteBadgeEdit()" class="btn btn-danger">
                                    <i class="bi bi-trash me-1"></i> Hapus Badge
                                </button>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.badges.index') }}" wire:navigate
                                        class="btn btn-secondary">
                                        <i class="bi bi-x-circle me-1"></i> Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save me-1"></i> Update Badge
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Preview Card --}}
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Preview</h5>
                    </div>
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <span style="font-size: 4rem;">{{ $icon ?: '🏅' }}</span>
                        </div>
                        <h5>{{ $name ?: 'Nama Badge' }}</h5>
                        <span
                            class="badge 
                            @if ($badge_type === 'achievement') bg-primary
                            @elseif($badge_type === 'milestone') bg-success
                            @elseif($badge_type === 'streak') bg-warning
                            @else bg-info @endif mb-2">
                            {{ ucfirst($badge_type) }}
                        </span>
                        <p class="text-muted small mt-2">{{ $description ?: 'Deskripsi badge akan muncul di sini' }}
                        </p>
                        @if ($condition)
                            <div class="alert alert-light mt-3">
                                <small><strong>Kondisi:</strong> {{ $condition }}</small>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Stats Card --}}
                <div class="card shadow-sm mt-3">
                    <div class="card-body">
                        <h6 class="card-title">Statistik</h6>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">Total Earned:</span>
                            <span class="badge bg-primary">{{ $badge->users->count() }} users</span>
                        </div>
                    </div>
                </div>
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
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
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
            showConfirmButton: false
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
            showConfirmButton: false
        }).then(() => {
            window.location.href = "{{ route('admin.badges.index') }}";
        });
    });
</script>
