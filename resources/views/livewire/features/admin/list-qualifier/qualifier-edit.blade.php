<div>
    <!-- Halaman Edit Qualifier - Versi Admin Mazer -->

<div class="page-heading">
    <h3>Edit Qualifier</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-body">

            <!-- Back Button -->
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('admin.qualifier.index') }}" wire:navigate class="me-3 text-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

            <form wire:submit="update" class="row g-3">
                <!-- Name -->
                <div class="col-12">
                    <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        id="name"
                        wire:model.blur="name"
                        class="form-control @error('name') is-invalid @enderror"
                        placeholder="Masukkan nama lengkap"
                    >
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="col-12">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input
                        type="email"
                        id="email"
                        wire:model.blur="email"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="email@example.com"
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr class="my-4">
                <p class="text-muted small">Kosongkan password jika tidak ingin mengubahnya.</p>

                <!-- Password -->
                <div class="col-12">
                    <label for="password" class="form-label">Password Baru</label>
                    <input
                        type="password"
                        id="password"
                        wire:model.blur="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Minimal 8 karakter (opsional)"
                    >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Confirmation -->
                <div class="col-12 mb-4">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        wire:model.blur="password_confirmation"
                        class="form-control"
                        placeholder="Ulangi password (opsional)"
                    >
                </div>

                <!-- Buttons -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-fill">
                        Update Qualifier
                    </button>
                    <a
                        href="{{ route('admin.qualifier.index') }}"
                        wire:navigate
                        class="btn btn-light flex-fill"
                    >
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>
</section>

</div>
