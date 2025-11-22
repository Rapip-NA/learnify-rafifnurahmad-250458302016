<div>
    <!-- Versi Admin Mazer untuk Tambah Qualifier -->
<div class="page-heading mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <h3>Tambah Qualifier Baru</h3>
        <a href="{{ route('admin.qualifier.index') }}" wire:navigate class="btn btn-light">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<section class="section">
    <div class="card shadow-sm">
        <div class="card-body">

            <div class="alert alert-primary d-flex align-items-center mb-4" role="alert">
                <i class="bi bi-info-circle me-2"></i>
                <div>
                    <strong>Info:</strong> Qualifier bertugas memverifikasi soal dan jawaban peserta dalam kompetisi.
                </div>
            </div>

            <form wire:submit="save" class="needs-validation" novalidate>
                <div class="row g-3">
                    <!-- Name -->
                    <div class="col-12">
                        <label for="name" class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" id="name" wire:model.blur="name"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Masukkan nama lengkap">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="col-12">
                        <label for="email" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                        <input type="email" id="email" wire:model.blur="email"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="email@example.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="col-12 col-md-6">
                        <label for="password" class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                        <input type="password" id="password" wire:model.blur="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Minimal 8 karakter">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password Confirmation -->
                    <div class="col-12 col-md-6">
                        <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password <span class="text-danger">*</span></label>
                        <input type="password" id="password_confirmation" wire:model.blur="password_confirmation"
                            class="form-control" placeholder="Ulangi password">
                    </div>
                </div>

                <div class="d-flex gap-3 mt-4">
                    <button type="submit" class="btn btn-primary flex-grow-1">
                        <i class="bi bi-save me-1"></i> Simpan Qualifier
                    </button>
                    <a href="{{ route('admin.qualifier.index') }}" wire:navigate
                        class="btn btn-light flex-grow-1 text-center">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>

</div>
