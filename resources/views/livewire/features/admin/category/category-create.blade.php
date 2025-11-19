<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-8 order-md-1 order-last">
                <div class="d-flex align-items-center mb-4">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary icon-left me-3">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <div>
                        <h3>Create New Category</h3>
                        <p class="text-subtitle text-muted">Fill in the form below to create a new category.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Category Details</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form wire:submit.prevent="save">
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

                                <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                                    <a href="{{ route('admin.categories.index') }}"
                                        class="btn btn-light-secondary **icon-left**">
                                        Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary **icon-left**">
                                        <i class="bi bi-save"></i>
                                        Save Category
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="alert alert-light-info color-info **mt-4**">
                    <div class="d-flex align-items-start">
                        <i class="bi bi-info-circle-fill fs-5 me-3"></i>
                        <div class="text-sm">
                            <p class="fw-bold mb-1">Tips:</p>
                            <ul class="list-unstyled space-y-1">
                                <li>- Category name is required and must be unique</li>
                                <li>- Description is optional but recommended for clarity</li>
                                <li>- Categories help organize questions in competitions</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>