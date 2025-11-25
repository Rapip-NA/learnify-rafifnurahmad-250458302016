<div>
    <!-- Versi Admin Mazer: Daftar Qualifier -->
    <div class="page-heading mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Daftar Qualifier</h3>
            <a href="{{ route('admin.qualifier.create') }}" wire:navigate class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Tambah Qualifier
            </a>
        </div>
    </div>

    <section class="section">
        <div class="card shadow-sm">
            <div class="card-body">
                <!-- Flash Message -->
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Search & Filter -->
                <div class="row g-3 mb-4">
                    <div class="col-md-8">
                        <input type="text" wire:model.live.debounce.300ms="search" class="form-control"
                            placeholder="Cari nama atau email qualifier...">
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
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>
                                    <button wire:click="sortBy('id')" class="btn btn-link p-0 text-decoration-none">
                                        ID
                                        @if ($sortField === 'id')
                                            <small>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</small>
                                        @endif
                                    </button>
                                </th>
                                <th>
                                    <button wire:click="sortBy('name')" class="btn btn-link p-0 text-decoration-none">
                                        Nama
                                        @if ($sortField === 'name')
                                            <small>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</small>
                                        @endif
                                    </button>
                                </th>
                                <th>
                                    <button wire:click="sortBy('email')" class="btn btn-link p-0 text-decoration-none">
                                        Email
                                        @if ($sortField === 'email')
                                            <small>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</small>
                                        @endif
                                    </button>
                                </th>
                                <th class="text-center">Soal Diverifikasi</th>
                                <th class="text-center">Jawaban Diverifikasi</th>
                                <th>
                                    <button wire:click="sortBy('created_at')"
                                        class="btn btn-link p-0 text-decoration-none">
                                        Terdaftar
                                        @if ($sortField === 'created_at')
                                            <small>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</small>
                                        @endif
                                    </button>
                                </th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($qualifiers as $q)
                                <tr>
                                    <td>{{ $q->id }}</td>
                                    <td class="fw-semibold">{{ $q->name }}</td>
                                    <td>{{ $q->email }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-primary">{{ $q->verified_questions_count }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span
                                            class="badge bg-success">{{ $q->verified_participant_answers_count }}</span>
                                    </td>
                                    <td>{{ $q->created_at->format('d M Y') }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.qualifier.show', $q->id) }}" wire:navigate
                                                class="text-primary">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.qualifier.edit', $q->id) }}" wire:navigate
                                                class="text-success">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button wire:click="deleteQualifier({{ $q->id }})"
                                                wire:confirm="Apakah Anda yakin ingin menghapus qualifier ini?"
                                                class="btn btn-link text-danger p-0">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        @if ($search)
                                            Tidak ada qualifier ditemukan untuk "{{ $search }}"
                                        @else
                                            Belum ada qualifier terdaftar
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
                            Menampilkan {{ $qualifiers->firstItem() ?? 0 }} - {{ $qualifiers->lastItem() ?? 0 }} dari
                            {{ $qualifiers->total() }} qualifier
                        </p>
                    </div>
                    <div>
                        {{ $qualifiers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
