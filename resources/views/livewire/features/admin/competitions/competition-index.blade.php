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



    <section class="section mt-4">
        <div class="card">

            {{-- CARD HEADER --}}
            <div class="card-header">
                <div class="row g-3">
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="Search competitions..."
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
                                        @if ($competition->description)
                                            <small
                                                class="text-muted">{{ Str::limit($competition->description, 50) }}</small>
                                        @endif
                                    </td>

                                    <td>{{ $competition->start_date->format('M d, Y H:i') }}</td>
                                    <td>{{ $competition->end_date->format('M d, Y H:i') }}</td>

                                    <td>
                                        @if ($competition->status === 'draft')
                                            <span class="badge bg-secondary">Draft</span>
                                        @elseif($competition->status === 'active')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>

                                    <td>{{ $competition->creator->name ?? 'N/A' }}</td>

                                    <td class="text-center">
                                        <!-- Desktop View: Inline Buttons (lg and up) -->
                                        <div class="d-none d-lg-block">
                                            <a href="{{ route('admin.competitions.view', $competition) }}"
                                                class="btn btn-sm btn-info">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.competitions.edit', $competition) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button onclick="confirmDelete({{ $competition->id }})"
                                                class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>

                                        <!-- Mobile/Tablet View: Dropdown (md and sm) -->
                                        <div class="d-lg-none dropdown">
                                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                                id="actionDropdown{{ $competition->id }}" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end"
                                                aria-labelledby="actionDropdown{{ $competition->id }}">
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.competitions.view', $competition) }}">
                                                        <i class="bi bi-eye me-2 text-info"></i> View
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.competitions.edit', $competition) }}">
                                                        <i class="bi bi-pencil me-2 text-warning"></i> Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-danger" href="#"
                                                        onclick="event.preventDefault(); confirmDelete({{ $competition->id }})">
                                                        <i class="bi bi-trash me-2"></i> Delete
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
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

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Kompetisi ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('delete', id);
                }
            });
        }

        window.addEventListener('competition-deleted', event => {
            Swal.fire({
                title: 'Berhasil!',
                text: 'Kompetisi berhasil dihapus.',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            });
        });

        // Success notification for created competition
        @if (session('competition-created'))
            Swal.fire({
                title: 'Berhasil!',
                text: 'Kompetisi berhasil dibuat.',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            });
        @endif

        // Success notification for updated competition
        @if (session('competition-updated'))
            Swal.fire({
                title: 'Berhasil!',
                text: 'Kompetisi berhasil diperbarui.',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            });
        @endif
    </script>
</div>
