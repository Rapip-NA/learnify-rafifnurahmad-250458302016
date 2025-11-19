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
            <div class="col-12 col-md-8 col-lg-6">
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
                                        class="form-control @error('description') is-invalid @enderror"
                                        placeholder="Enter category description"></textarea>
                                    @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4 pt-3 border-top **bg-light** rounded p-3">
                                    <h6 class="text-muted font-semibold mb-3">Category Information</h6>
                                    <div class="row text-sm">
                                        <div class="col-md-6 mb-2">
                                            <span class="text-muted">Created At:</span>
                                            <span class="fw-bold ms-2">{{ $category->created_at->format('M d, Y H:i')
                                                }}</span>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <span class="text-muted">Updated At:</span>
                                            <span class="fw-bold ms-2">{{ $category->updated_at->format('M d, Y H:i')
                                                }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                                    <a href="{{ route('admin.categories.index') }}"
                                        class="btn btn-light-secondary icon-left">
                                        Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary icon-left" wire:loading.attr="disabled"
                                        wire:loading.class="opacity-50 cursor-not-allowed">
                                        <span wire:loading.remove wire:target="update">
                                            <i class="bi bi-save"></i> Update Category
                                        </span>
                                        <span wire:loading wire:target="update">
                                            <span class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true"></span> Saving...
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="alert alert-light-danger color-danger mt-4">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-exclamation-triangle-fill fs-5 me-3 mt-1"></i>
                            <div>
                                <h6 class="fw-bold text-danger mb-1">Danger Zone</h6>
                                <p class="text-sm">
                                    Once you delete a category, there is no going back. Please be certain.
                                </p>
                            </div>
                        </div>
                        <button wire:click="confirmDelete" type="button" class="btn btn-danger btn-sm icon-left ms-3">
                            <i class="bi bi-trash"></i>
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@if($showDeleteModal)
<div class="modal fade show d-block" tabindex="-1" role="dialog" style="background-color: rgba(0, 0, 0, 0.5);"
    aria-modal="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" wire:click.stop>
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white"><i class="bi bi-exclamation-octagon-fill me-2"></i> Confirm Deletion
                </h5>
            </div>
            <div class="modal-body text-center">
                <div class="text-center mb-3">
                    <i class="bi bi-trash-fill text-danger fs-1"></i>
                </div>
                <h5 class="fw-bold">Are you sure?</h5>
                <p class="text-muted">You are about to delete "{{ $category->name }}"? This action cannot be undone.</p>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-light-secondary" wire:click="$set('showDeleteModal', false)">
                    Cancel
                </button>
                <button type="button" class="btn btn-danger" wire:click="delete" wire:loading.attr="disabled"
                    wire:loading.class="opacity-50 cursor-not-allowed">
                    <span wire:loading.remove wire:target="delete"><i class="bi bi-trash me-1"></i> Delete</span>
                    <span wire:loading wire:target="delete"><span class="spinner-border spinner-border-sm" role="status"
                            aria-hidden="true"></span> Deleting...</span>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal-backdrop fade show"></div>
@endif