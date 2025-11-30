<!-- Versi Admin Mazer -->
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Detail Peserta</h3>
                <p class="text-subtitle text-muted">Informasi lengkap peserta kompetisi</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.peserta.index') }}">Peserta</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Informasi Peserta</h5>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.peserta.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button wire:click="deletePeserta"
                        wire:confirm="Apakah Anda yakin ingin menghapus peserta ini? Data tidak dapat dikembalikan!"
                        class="btn btn-danger">Hapus</button>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="text-muted small">ID Peserta</label>
                        <p class="fw-bold">{{ $peserta->id }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Nama Lengkap</label>
                        <p class="fw-bold">{{ $peserta->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Email</label>
                        <p>{{ $peserta->email }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Role</label>
                        <span class="badge bg-primary">{{ ucfirst($peserta->role) }}</span>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Terdaftar Sejak</label>
                        <p>{{ $peserta->created_at->format('d F Y, H:i') }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Terakhir Diupdate</label>
                        <p>{{ $peserta->updated_at->format('d F Y, H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kompetisi -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title">Kompetisi yang Diikuti</h5>
            </div>
            <div class="card-body">
                @if ($peserta->competitionParticipants->count())
                    @foreach ($peserta->competitionParticipants as $participant)
                        <div class="border rounded p-3 mb-2">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="fw-bold">{{ $participant->competition->title ?? 'N/A' }}</h6>
                                    <small class="text-muted">Bergabung:
                                        {{ $participant->created_at->format('d M Y') }}</small>
                                </div>
                                @if ($participant->score !== null)
                                    <span class="badge bg-success">Score: {{ $participant->score }}</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center text-muted">Belum mengikuti kompetisi apapun</p>
                @endif
            </div>
        </div>

        <!-- Badges -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title">Badge & Pencapaian</h5>
            </div>
            <div class="card-body">
                @if ($peserta->userBadges->count())
                    <div class="row g-3">
                        @foreach ($peserta->userBadges as $userBadge)
                            <div class="col-6 col-md-3">
                                <div class="border rounded text-center p-3">
                                    <div class="fs-1">🏆</div>
                                    <h6 class="fw-bold small">{{ $userBadge->badge->name ?? 'Badge' }}</h6>
                                    <small
                                        class="text-muted">{{ \Carbon\Carbon::parse($userBadge->awarded_at)->format('d M Y') }}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-muted">Belum memiliki badge</p>
                @endif
            </div>
        </div>

        <!-- Leaderboard -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title">Posisi Leaderboard</h5>
            </div>
            <div class="card-body">
                @if ($peserta->leaderboards->count())
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Kompetisi</th>
                                    <th>Rank</th>
                                    <th>Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($peserta->leaderboards as $leaderboard)
                                    <tr>
                                        <td>Kompetisi #{{ $leaderboard->competition_id }}</td>
                                        <td><span class="badge bg-warning text-dark">#{{ $leaderboard->rank }}</span>
                                        </td>
                                        <td class="fw-bold">{{ $leaderboard->score }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-center text-muted">Belum ada di leaderboard</p>
                @endif
            </div>
        </div>
    </section>
</div>
