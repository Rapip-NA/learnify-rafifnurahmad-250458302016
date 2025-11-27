<div>
    <div class="page-heading">
        <h3>Daftar Peserta</h3>
        <p class="text-subtitle text-muted">Kelola seluruh peserta yang terdaftar</p>
    </div>

    <section class="section">
        <div class="card shadow-sm">
            <div class="card-body">
                <!-- Flash Message -->
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Search & Filter -->
                <div class="row mb-4">
                    <div class="col-md-8 mb-2">
                        <input type="text" wire:model.live.debounce.300ms="search" class="form-control"
                            placeholder="Cari nama atau email peserta...">
                    </div>
                    <div class="col-md-4">
                        <select wire:model.live="perPage" class="form-select">
                            <option value="5">5 per halaman</option>
                            <option value="10">10 per halaman</option>
                            <option value="25">25 per halaman</option>
                            <option value="50">50 per halaman</option>
                        </select>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>
                                    <button wire:click="sortBy('id')" class="btn btn-link p-0 text-decoration-none">
                                        ID
                                        @if ($sortField === 'id')
                                            <i
                                                class="bi bi-caret-{{ $sortDirection === 'asc' ? 'up' : 'down' }}-fill small"></i>
                                        @endif
                                    </button>
                                </th>
                                <th>
                                    <button wire:click="sortBy('name')" class="btn btn-link p-0 text-decoration-none">
                                        Nama
                                        @if ($sortField === 'name')
                                            <i
                                                class="bi bi-caret-{{ $sortDirection === 'asc' ? 'up' : 'down' }}-fill small"></i>
                                        @endif
                                    </button>
                                </th>
                                <th>
                                    <button wire:click="sortBy('email')" class="btn btn-link p-0 text-decoration-none">
                                        Email
                                        @if ($sortField === 'email')
                                            <i
                                                class="bi bi-caret-{{ $sortDirection === 'asc' ? 'up' : 'down' }}-fill small"></i>
                                        @endif
                                    </button>
                                </th>
                                <th>
                                    <button wire:click="sortBy('created_at')"
                                        class="btn btn-link p-0 text-decoration-none">
                                        Terdaftar
                                        @if ($sortField === 'created_at')
                                            <i
                                                class="bi bi-caret-{{ $sortDirection === 'asc' ? 'up' : 'down' }}-fill small"></i>
                                        @endif
                                    </button>
                                </th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($peserta as $p)
                                <tr>
                                    <td>{{ $p->id }}</td>
                                    <td class="fw-bold">{{ $p->name }}</td>
                                    <td>{{ $p->email }}</td>
                                    <td>{{ $p->created_at->format('d M Y') }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.peserta.show', $p->id) }}" wire:navigate
                                                class="btn btn-sm btn-info text-white">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            <button onclick="confirmDeletePeserta({{ $p->id }})"
                                                class="btn btn-sm btn-outline-danger" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        @if ($search)
                                            Tidak ada peserta ditemukan untuk "{{ $search }}"
                                        @else
                                            Belum ada peserta terdaftar
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div>
                        <p class="text-muted small mb-0">
                            Menampilkan {{ $peserta->firstItem() ?? 0 }} - {{ $peserta->lastItem() ?? 0 }} dari
                            {{ $peserta->total() }} peserta
                        </p>
                    </div>
                    <div>
                        {{ $peserta->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    function confirmDeletePeserta(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data peserta ini akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                @this.call('deletePeserta', id);
            }
        });
    }

    window.addEventListener('peserta-deleted', event => {
        Swal.fire({
            title: 'Berhasil!',
            text: 'Peserta berhasil dihapus.',
            icon: 'success',
            timer: 2000,
            showConfirmButton: false
        });
    });
</script>
