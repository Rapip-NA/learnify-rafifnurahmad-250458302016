<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Categories</h3>
                <p class="text-subtitle text-muted">Manage and organize all competition categories.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first d-flex justify-content-end align-items-center">
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary icon-left">
                    <i class="bi bi-plus-lg"></i> Add New Category
                </a>
            </div>
        </div>
    </div>

    <section class="section">
        @if (session()->has('success'))
        <div class="alert alert-light-success color-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session()->has('error'))
        <div class="alert alert-light-danger color-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card">
            <div class="card-body py-4 px-4">
                <div class="row g-3">
                    <div class="col-md-9 col-lg-10">
                        <div class="form-group mb-0">
                            <input type="text" wire:model.live.debounce.300ms="search"
                                placeholder="Search categories..." class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-2">
                        <div class="form-group mb-0">
                            <select wire:model.live="perPage" class="form-select">
                                <option value="5">5 per page</option>
                                <option value="10">10 per page</option>
                                <option value="25">25 per page</option>
                                <option value="50">50 per page</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-lg table-hover" id="table1">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-nowrap">ID</th>
                                    <th class="text-uppercase">Name</th>
                                    <th class="text-uppercase">Description</th>
                                    <th class="text-uppercase text-nowrap">Created At</th>
                                    <th class="text-uppercase text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                <tr>
                                    <td class="text-bold-500 text-nowrap">{{ $category->id }}</td>
                                    <td class="text-nowrap">{{ $category->name }}</td>
                                    <td>
                                        <span class="text-muted text-truncate d-inline-block" style="max-width: 300px;">
                                            {{ Str::limit($category->description, 100) }}
                                        </span>
                                    </td>
                                    <td class="text-nowrap text-muted">{{ $category->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="text-end">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.categories.view', $category) }}"
                                                class="btn btn-sm btn-outline-info" title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.categories.edit', $category) }}"
                                                class="btn btn-sm btn-outline-warning" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button wire:click="confirmDelete({{ $category->id }})"
                                                class="btn btn-sm btn-outline-danger" title="Delete"
                                                wire:loading.attr="disabled">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox-fill fs-1 mb-3 d-block"></i>
                                        <p class="fs-5">No categories found.</p>
                                        @if($search)
                                        <p class="text-sm mt-2">Try adjusting your search criteria.</p>
                                        @endif
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@if($deleteId)
<div class="modal fade show d-block" tabindex="-1" role="dialog" style="background-color: rgba(0, 0, 0, 0.5);"
    aria-modal="true">
    <div class="modal-dialog modal-dialog-centered" role="document" wire:key="delete-modal-{{ $deleteId }}">
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
                <p class="text-muted">You are about to delete this category. This action cannot be undone.</p>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-light-secondary" wire:click="$set('deleteId', null)">
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