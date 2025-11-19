<div class="page-heading">
    <div class="page-title mb-3">
        <div class="row">
            <div class="col-md-8">
                <h3>Create Competition</h3>
                <p class="text-subtitle text-muted">Fill the form to create a new competition.</p>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('admin.competitions.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left"></i> Back to list
                </a>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">

                <form wire:submit.prevent="save">

                    {{-- Title --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            Title <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               wire:model="title"
                               class="form-control @error('title') is-invalid @enderror">

                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Description</label>

                        <textarea wire:model="description"
                                  rows="4"
                                  class="form-control @error('description') is-invalid @enderror"></textarea>

                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Start & End Date --}}
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="form-label fw-bold">
                                Start Date <span class="text-danger">*</span>
                            </label>

                            <input type="datetime-local"
                                   wire:model="start_date"
                                   class="form-control @error('start_date') is-invalid @enderror">

                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                End Date <span class="text-danger">*</span>
                            </label>

                            <input type="datetime-local"
                                   wire:model="end_date"
                                   class="form-control @error('end_date') is-invalid @enderror">

                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold">
                            Status <span class="text-danger">*</span>
                        </label>

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

                    {{-- Buttons --}}
                    <div class="text-end">
                        <a href="{{ route('admin.competitions.index') }}" class="btn btn-light">
                            Cancel
                        </a>

                        <button type="submit" class="btn btn-primary ms-2">
                            <i class="bi bi-check-circle"></i> Create Competition
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </section>
</div>
