<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1">
                <h3>Edit Competition</h3>
                <p class="text-subtitle text-muted">
                    Update competition data by filling the form below.
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 text-end">
                <a href="{{ route('admin.competitions.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>Edit Competition Form</h4>
            </div>

            <div class="card-body">
                <form wire:submit.prevent="update">

                    <div class="row">
                        <!-- Title -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text"
                                   wire:model="title"
                                   class="form-control @error('title') is-invalid @enderror">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Description</label>
                            <textarea wire:model="description"
                                      rows="4"
                                      class="form-control @error('description') is-invalid @enderror"></textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Start & End Date -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Start Date <span class="text-danger">*</span></label>
                            <input type="datetime-local"
                                   wire:model="start_date"
                                   class="form-control @error('start_date') is-invalid @enderror">
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">End Date <span class="text-danger">*</span></label>
                            <input type="datetime-local"
                                   wire:model="end_date"
                                   class="form-control @error('end_date') is-invalid @enderror">
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-12 mb-4">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select wire:model="status"
                                    class="form-select @error('status') is-invalid @enderror">
                                <option value="draft">Draft</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="col-12 text-end">
                            <a href="{{ route('admin.competitions.index') }}"
                               class="btn btn-light-secondary me-2">
                                Cancel
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i>
                                Update Competition
                            </button>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </section>
</div>
