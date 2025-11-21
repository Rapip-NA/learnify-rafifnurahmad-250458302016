<!-- Revisi menggunakan template Admin Mazer -->
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Peserta</h3>
                <p class="text-subtitle text-muted">Form untuk mengubah data peserta</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first d-flex justify-content-end">
                <a href="{{ route('admin.peserta.index') }}" class="btn btn-light">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card shadow-sm">
            <div class="card-body">
                <form wire:submit="update">

                    <!-- Name -->
                    <div class="mb-3">
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
                    <div class="mb-3">
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

                    <!-- Divider -->
                    <hr class="my-4">

                    <p class="text-muted small mb-3">
                        <strong>Catatan:</strong> Kosongkan password jika tidak ingin mengubahnya
                    </p>

                    <!-- Password -->
                    <div class="mb-3">
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
                    <div class="mb-4">
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
                            <i class="bi bi-save"></i> Update Peserta
                        </button>
                        <a href="{{ route('admin.peserta.index') }}" class="btn btn-secondary flex-fill">
                            Batal
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </section>
</div>
