<div><div>
    <div class="page-heading">
        <h3>🏆 Global Leaderboard</h3>
        <p class="text-muted">Peringkat peserta berdasarkan total skor dari semua kompetisi</p>
    </div>

    <section class="section">
        <div class="card shadow-lg border-0" style="overflow: hidden;">
            <!-- Header dengan gradient yang lebih menarik -->
            <div class="card-header py-4 border-0"
                style="
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    position: relative;
                    overflow: hidden;
                ">
                <!-- Decorative circles -->
                <div
                    style="position: absolute; width: 200px; height: 200px; background: rgba(255,255,255,0.1); border-radius: 50%; top: -50px; right: -50px;">
                </div>
                <div
                    style="position: absolute; width: 150px; height: 150px; background: rgba(255,255,255,0.05); border-radius: 50%; bottom: -30px; left: -30px;">
                </div>

                <div class="position-relative">
                    <div class="d-flex justify-content-between align-items-center text-white flex-wrap gap-3">
                        <div>
                            <h4 class="mb-2 d-flex align-items-center fw-bold">
                                <span style="font-size: 1.75rem;">Global Leaderboard</span>
                            </h4>
                            <p class="mb-0 opacity-90" style="font-size: 0.95rem;">Total skor dari semua kompetisi</p>
                        </div>

                        <div class="d-flex align-items-center gap-4">
                            <div class="text-center px-4 py-2 rounded-3"
                                style="background: rgba(255,255,255,0.15); backdrop-filter: blur(10px);">
                                <div class="h2 fw-bold mb-0">{{ $totalParticipants }}</div>
                                <small class="opacity-90 text-uppercase"
                                    style="letter-spacing: 0.5px; font-size: 0.75rem;">Peserta</small>
                            </div>

                            <div class="d-flex align-items-center gap-2 px-3 py-2 rounded-pill"
                                style="background: rgba(16, 185, 129, 0.25); border: 2px solid rgba(16, 185, 129, 0.4);">
                                <span class="spinner-grow spinner-grow-sm text-success"></span>
                                <strong class="text-white fw-semibold">Live</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body p-0" wire:poll.{{ $refreshInterval }}ms>

                @if ($leaderboard->isEmpty())
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="bi bi-trophy text-secondary" style="font-size: 5rem; opacity: 0.3;"></i>
                        </div>
                        <h5 class="text-muted">Belum ada peserta yang menyelesaikan kompetisi</h5>
                        <p class="text-muted small">Jadilah yang pertama untuk masuk leaderboard!</p>
                    </div>
                @else
                    <!-- Desktop Table -->
                    <div class="d-none d-md-block">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead
                                    style="background: linear-gradient(to right, #f8f9fa, #e9ecef); border-bottom: 2px solid #dee2e6;">
                                    <tr>
                                        <th class="py-3 px-4 text-uppercase fw-semibold"
                                            style="font-size: 0.75rem; letter-spacing: 0.5px; color: #6c757d;">Rank</th>
                                        <th class="py-3 px-4 text-uppercase fw-semibold"
                                            style="font-size: 0.75rem; letter-spacing: 0.5px; color: #6c757d;">Peserta
                                        </th>
                                        <th class="py-3 px-4 text-uppercase fw-semibold"
                                            style="font-size: 0.75rem; letter-spacing: 0.5px; color: #6c757d;">Total
                                            Skor</th>
                                        <th class="py-3 px-4 text-uppercase fw-semibold"
                                            style="font-size: 0.75rem; letter-spacing: 0.5px; color: #6c757d;">Kompetisi
                                        </th>
                                        <th class="py-3 px-4 text-uppercase fw-semibold"
                                            style="font-size: 0.75rem; letter-spacing: 0.5px; color: #6c757d;">Terakhir
                                            Aktif</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leaderboard as $entry)
                                        <tr class="border-bottom
                                            @if ($entry->rank == 1) bg-warning bg-opacity-10 border-warning border-2
                                            @elseif($entry->rank == 2) bg-secondary bg-opacity-10 border-secondary
                                            @elseif($entry->rank == 3) bg-info bg-opacity-10 border-info @endif
                                            {{ auth()->id() === $entry->id ? 'bg-primary bg-opacity-10 border-primary border-2' : '' }}"
                                            style="transition: all 0.3s ease;">

                                            <td class="py-4 px-4 align-middle">
                                                <div class="d-flex align-items-center">
                                                    <span
                                                        class="badge px-3 py-2 fw-bold d-flex align-items-center justify-content-center rounded-3"
                                                        style="min-width: 60px; font-size: 1.25rem;
                                                        @if ($entry->rank == 1) background: linear-gradient(135deg, #FFD700, #FFA500); 
                                                            color: #000; 
                                                            box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);
                                                        @elseif($entry->rank == 2) 
                                                            background: linear-gradient(135deg, #C0C0C0, #808080); 
                                                            color: #fff;
                                                            box-shadow: 0 4px 15px rgba(192, 192, 192, 0.4);
                                                        @elseif($entry->rank == 3) 
                                                            background: linear-gradient(135deg, #CD7F32, #8B4513); 
                                                            color: #fff;
                                                            box-shadow: 0 4px 15px rgba(205, 127, 50, 0.4);
                                                        @else 
                                                            background: #f8f9fa; 
                                                            color: #495057; @endif">
                                                        {{ $entry->position_badge }}
                                                    </span>
                                                </div>
                                            </td>

                                            <td class="py-4 px-4 align-middle">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="avatar avatar-lg rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
                                                        style="
                                                            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                                                            width: 50px;
                                                            height: 50px;
                                                            font-size: 1.1rem;
                                                            box-shadow: 0 4px 10px rgba(102, 126, 234, 0.3);
                                                        ">
                                                        {{ strtoupper(substr($entry->name, 0, 2)) }}
                                                    </div>
                                                    <div>
                                                        <div class="fw-bold text-dark mb-1" style="font-size: 1.05rem;">
                                                            {{ $entry->name }}
                                                            @if (auth()->id() === $entry->id)
                                                                <span
                                                                    class="badge bg-primary ms-2 rounded-pill px-2 py-1"
                                                                    style="font-size: 0.7rem;">YOU</span>
                                                            @endif
                                                        </div>
                                                        <small class="text-muted">{{ $entry->email }}</small>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="py-4 px-4 align-middle">
                                                <div class="d-flex align-items-baseline gap-2">
                                                    <span class="fw-bold text-success" style="font-size: 1.75rem;">
                                                        {{ number_format($entry->total_score, 0) }}
                                                    </span>
                                                    <span class="text-success opacity-75"
                                                        style="font-size: 0.9rem;">pts</span>
                                                </div>
                                            </td>

                                            <td class="py-4 px-4 align-middle">
                                                <span class="badge rounded-pill px-3 py-2"
                                                    style="background: linear-gradient(135deg, #17a2b8, #138496); color: white; font-size: 0.9rem;">
                                                    <i class="bi bi-trophy me-1"></i>
                                                    {{ $entry->competitions_count }} kompetisi
                                                </span>
                                            </td>

                                            <td class="py-4 px-4 align-middle">
                                                <div class="d-flex align-items-center gap-2 text-muted">
                                                    <i class="bi bi-clock"></i>
                                                    <span style="font-size: 0.9rem;">
                                                        {{ $entry->last_activity ? $entry->last_activity->diffForHumans() : '-' }}
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Mobile Cards - Enhanced -->
                    <div class="d-md-none p-3">
                        @foreach ($leaderboard as $entry)
                            <div class="card mb-3 shadow-sm border-0"
                                style="
                                    overflow: hidden;
                                    @if ($entry->rank == 1) border-left: 5px solid #FFD700 !important;
                                        background: linear-gradient(to right, rgba(255, 215, 0, 0.05), white);
                                    @elseif($entry->rank == 2) 
                                        border-left: 5px solid #C0C0C0 !important;
                                        background: linear-gradient(to right, rgba(192, 192, 192, 0.05), white);
                                    @elseif($entry->rank == 3) 
                                        border-left: 5px solid #CD7F32 !important;
                                        background: linear-gradient(to right, rgba(205, 127, 50, 0.05), white);
                                    @else
                                        border-left: 3px solid #e0e0e0 !important; @endif
                                    {{ auth()->id() === $entry->id ? 'border: 2px solid #0d6efd !important; background: linear-gradient(to right, rgba(13, 110, 253, 0.05), white);' : '' }}
                                ">

                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <span class="badge px-3 py-2 fw-bold rounded-3"
                                            style="font-size: 1.5rem; min-width: 60px; text-align: center;
                                            @if ($entry->rank == 1) background: linear-gradient(135deg, #FFD700, #FFA500); color: #000;
                                            @elseif($entry->rank == 2) 
                                                background: linear-gradient(135deg, #C0C0C0, #808080); color: #fff;
                                            @elseif($entry->rank == 3) 
                                                background: linear-gradient(135deg, #CD7F32, #8B4513); color: #fff;
                                            @else 
                                                background: #f8f9fa; color: #495057; @endif">
                                            {{ $entry->position_badge }}
                                        </span>

                                        <div class="d-flex align-items-center gap-2 flex-grow-1">
                                            <div class="avatar rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
                                                style="
                                                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                                                    width: 45px;
                                                    height: 45px;
                                                ">
                                                {{ strtoupper(substr($entry->name, 0, 2)) }}
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="fw-bold mb-0">{{ $entry->name }}</div>
                                                @if (auth()->id() === $entry->id)
                                                    <span class="badge bg-primary rounded-pill px-2"
                                                        style="font-size: 0.65rem;">YOU</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                                        <div>
                                            <strong class="text-success d-block" style="font-size: 1.5rem;">
                                                {{ number_format($entry->total_score, 0) }}
                                            </strong>
                                            <small class="text-success opacity-75">points</small>
                                        </div>

                                        <div class="text-end">
                                            <span class="badge rounded-pill px-3 py-1 mb-1"
                                                style="background: linear-gradient(135deg, #17a2b8, #138496); color: white;">
                                                <i class="bi bi-trophy"></i> {{ $entry->competitions_count }}
                                            </span>
                                            <div class="text-muted" style="font-size: 0.75rem;">
                                                <i class="bi bi-clock"></i>
                                                {{ $entry->last_activity ? $entry->last_activity->diffForHumans() : '-' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Show More Button - Enhanced -->
                    @if ($totalParticipants > 50 && !$showAll)
                        <div class="text-center py-4 border-top bg-light">
                            <button class="btn btn-lg px-5 py-3 fw-semibold rounded-pill shadow-sm"
                                wire:click="toggleShowAll"
                                style="
                                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                                    color: white;
                                    border: none;
                                    transition: all 0.3s ease;
                                "
                                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(102, 126, 234, 0.4)';"
                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.1)';">
                                <i class="bi bi-chevron-double-down me-2"></i>
                                Tampilkan Semua ({{ $totalParticipants }} peserta)
                            </button>
                        </div>
                    @elseif($showAll)
                        <div class="text-center py-4 border-top bg-light">
                            <button class="btn btn-lg px-5 py-3 fw-semibold rounded-pill shadow-sm"
                                wire:click="toggleShowAll"
                                style="
                                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                                    color: white;
                                    border: none;
                                    transition: all 0.3s ease;
                                "
                                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(102, 126, 234, 0.4)';"
                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.1)';">
                                <i class="bi bi-chevron-double-up me-2"></i>
                                Tampilkan Top 50
                            </button>
                        </div>
                    @endif
                @endif

            </div>
        </div>
    </section>
</div>

<style>
    /* Hover effects for desktop table rows */
    @media (min-width: 768px) {
        .table-hover tbody tr:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
    }
</style>
</div>