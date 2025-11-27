<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-8 order-md-1 order-last">
                <div class="d-flex align-items-center mb-4">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary icon-left me-3">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <div>
                        <h3>Edit Category</h3>
                        <p class="text-subtitle text-muted">Update the category information below.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-12">
                @if (session()->has('success'))
                    <div class="alert alert-light-success color-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="alert alert-light-danger color-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Category Details</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form wire:submit.prevent="update">
                                <div class="form-group mb-4">
                                    <label for="name" class="form-label">
                                        Category Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" id="name" wire:model="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Enter category name">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label for="description" class="form-label">
                                        Description
                                    </label>
                                    <textarea id="description" wire:model="description" rows="5"
                                        class="form-control @error('description') is-invalid @enderror" placeholder="Enter category description"></textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4 pt-3 border-top **bg-light** rounded p-3">
                                    <h6 class="text-muted font-semibold mb-3">Category Information</h6>
                                    <div class="row text-sm">
                                        <div class="col-md-6 mb-2">
                                            <span class="text-muted">Created At:</span>
                                            <span
                                                class="fw-bold ms-2">{{ $category->created_at->format('M d, Y H:i') }}</span>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <span class="text-muted">Updated At:</span>
                                            <span
                                                class="fw-bold ms-2">{{ $category->updated_at->format('M d, Y H:i') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                                    <a href="{{ route('admin.categories.index') }}"
                                        class="btn btn-light-secondary icon-left">
                                        Cancel
                                    </a>
                                    <button type="button" onclick="confirmUpdate()" class="btn btn-primary icon-left">
                                        <i class="bi bi-save"></i> Update Category
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    function confirmUpdate() {
        Swal.fire({
            title: 'Simpan Perubahan?',
            text: "Apakah Anda yakin ingin memperbarui data kategori ini?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Simpan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                @this.call('update');
            }
        });
    }

    window.addEventListener('category-updated', event => {
        Swal.fire({
            title: 'Berhasil!',
            text: 'Kategori berhasil diperbarui.',
            icon: 'success',
            timer: 2000,
            showConfirmButton: false
        }).then(() => {
            window.location.href = "{{ route('admin.categories.index') }}";
        });
    });
</script>
