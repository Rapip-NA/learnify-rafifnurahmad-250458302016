<div>
    <div class="page-heading mb-4">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3 class="mb-2">
                        <i class="bi bi-plus-circle text-primary me-2"></i>
                        Tambah Badge Baru
                    </h3>
                    <p class="text-subtitle text-muted">Buat badge baru untuk reward sistem</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.badges.index') }}">Badges</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
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
                        <form wire:submit="save">
                            {{-- Name --}}
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Badge <span
                                        class="text-danger">*</span></label>
                                <input type="text" wire:model="name"
                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                    placeholder="Masukkan nama badge">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Description --}}
                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror" id="description"
                                    rows="3" placeholder="Deskripsi badge"></textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Condition Builder --}}
                            <div class="mb-3">
                                <label for="condition_type" class="form-label">Tipe Kondisi Badge</label>
                                <select wire:model.live="condition_type"
                                    class="form-select @error('condition_type') is-invalid @enderror"
                                    id="condition_type">
                                    <option value="">-- Pilih Kondisi --</option>
                                    <option value="first_completion">Kompetisi Pertama</option>
                                    <option value="perfect_score">Nilai Sempurna</option>
                                    <option value="completion_count">Jumlah Kompetisi Selesai</option>
                                    <option value="speed_completion">Selesai Cepat</option>
                                    <option value="top_scorer">Top Scorer</option>
                                </select>
                                @error('condition_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Pilih kondisi yang harus dipenuhi untuk mendapatkan badge
                                    ini</small>
                            </div>

                            {{-- Dynamic Condition Parameters --}}
                            @if ($condition_type === 'perfect_score')
                                <div class="mb-3 ms-4">
                                    <label for="required_count" class="form-label">
                                        <i class="bi bi-star-fill text-warning"></i> Jumlah Nilai Sempurna yang
                                        Dibutuhkan
                                    </label>
                                    <input type="number" wire:model.live="required_count" class="form-control"
                                        id="required_count" min="1" value="1">
                                    <small class="text-muted">Peserta harus mendapat nilai 100% sebanyak ini</small>
                                </div>
                            @endif

                            @if ($condition_type === 'completion_count')
                                <div class="mb-3 ms-4">
                                    <label for="required_count" class="form-label">
                                        <i class="bi bi-check2-all text-success"></i> Jumlah Kompetisi yang Harus
                                        Diselesaikan
                                    </label>
                                    <input type="number" wire:model.live="required_count" class="form-control"
                                        id="required_count" min="1" value="1">
                                    <small class="text-muted">Peserta harus menyelesaikan kompetisi sebanyak ini (nilai
                                        berapapun)</small>
                                </div>
                            @endif

                            @if ($condition_type === 'speed_completion')
                                <div class="mb-3 ms-4">
                                    <label for="time_percentage" class="form-label">
                                        <i class="bi bi-lightning-fill text-primary"></i> Persentase Waktu Maksimal
                                    </label>
                                    <input type="number" wire:model.live="time_percentage" class="form-control"
                                        id="time_percentage" min="1" max="100" value="50">
                                    <small class="text-muted">Peserta harus menylelesaikan dalam {{ $time_percentage }}%
                                        dari waktu yang tersedia</small>
                                </div>
                            @endif

                            @if ($condition_type === 'top_scorer')
                                <div class="mb-3 ms-4">
                                    <label for="top_position" class="form-label">
                                        <i class="bi bi-trophy-fill text-warning"></i> Posisi Ranking Teratas
                                    </label>
                                    <input type="number" wire:model.live="top_position" class="form-control"
                                        id="top_position" min="1" value="3">
                                    <small class="text-muted">Peserta harus masuk top {{ $top_position }} di
                                        leaderboard</small>
                                </div>
                            @endif

                            @if ($condition_type === 'first_completion')
                                <div class="alert alert-info ms-4">
                                    <i class="bi bi-info-circle me-2"></i>
                                    <small>Badge ini akan diberikan otomatis saat peserta menyelesaikan kompetisi
                                        pertama mereka</small>
                                </div>
                            @endif

                            @if ($condition)
                                <div class="mb-3">
                                    <label class="form-label text-muted">Kondisi JSON (Otomatis)</label>
                                    <div class="bg-light p-2 rounded">
                                        <code>{{ $condition }}</code>
                                    </div>
                                </div>
                            @endif

                            {{-- Badge Type --}}
                            <div class="mb-3">
                                <label for="badge_type" class="form-label">Tipe Badge <span
                                        class="text-danger">*</span></label>
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

                            {{-- Buttons --}}
                            <div class="d-flex gap-2 justify-content-end mt-4">
                                <a href="{{ route('admin.badges.index') }}" wire:navigate class="btn btn-secondary">
                                    <i class="bi bi-x-circle me-1"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-1"></i> Simpan Badge
                                </button>
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
            </div>
        </div>
    </div>
</div>
