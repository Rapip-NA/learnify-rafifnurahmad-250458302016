<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Competitions</h3>
                <p class="text-subtitle text-muted">Manage all competitions here.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first text-end">
                <a href="{{ route('admin.competitions.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Create Competition
                </a>
            </div>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <section class="section mt-4">
        <div class="card">

            {{-- CARD HEADER --}}
            <div class="card-header">
                <div class="row g-3">
                    <div class="col-md-6">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Search competitions..."
                            wire:model.live.debounce.300ms="search">
                    </div>

                    <div class="col-md-3">
                        <select class="form-select" wire:model.live="statusFilter">
                            <option value="">All Status</option>
                            <option value="draft">Draft</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- CARD BODY --}}
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Title</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($competitions as $competition)
                                <tr>
                                    <td>
                                        <strong>{{ $competition->title }}</strong><br>
                                        @if($competition->description)
                                            <small class="text-muted">{{ Str::limit($competition->description, 50) }}</small>
                                        @endif
                                    </td>

                                    <td>{{ $competition->start_date->format('M d, Y H:i') }}</td>
                                    <td>{{ $competition->end_date->format('M d, Y H:i') }}</td>

                                    <td>
                                        @if($competition->status === 'draft')
                                            <span class="badge bg-secondary">Draft</span>
                                        @elseif($competition->status === 'active')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>

                                    <td>{{ $competition->creator->name ?? 'N/A' }}</td>

                                    <td class="text-center">
                                        <a href="{{ route('admin.competitions.view', $competition) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.competitions.edit', $competition) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button wire:click="confirmDelete({{ $competition->id }})"
                                            class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        No competitions found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>

            {{-- PAGINATION --}}
            <div class="card-footer">
                {{ $competitions->links() }}
            </div>

        </div>
    </section>

    {{-- DELETE MODAL --}}
    @if($deleteId)
        <div class="modal fade show d-block" style="background: rgba(0,0,0,.5);" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Delete</h5>
                        <button wire:click="$set('deleteId', null)" class="btn-close"></button>
                    </div>

                    <div class="modal-body">
                        Are you sure you want to delete this competition?
                    </div>

                    <div class="modal-footer">
                        <button wire:click="$set('deleteId', null)" class="btn btn-secondary">
                            Cancel
                        </button>
                        <button wire:click="delete" class="btn btn-danger">
                            Delete
                        </button>
                    </div>

                </div>
            </div>
        </div>
    @endif
</div>
