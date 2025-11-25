<div>
    <div class="page-heading mb-4">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3 class="mb-2">
                        <i class="bi bi-trophy text-warning me-2"></i>
                        My Badges
                    </h3>
                    <p class="text-subtitle text-muted">Badge yang telah Anda raih</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('peserta.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">My Badges</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content">
        {{-- Statistics --}}
        <div class="row mb-4">
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h2 class="text-primary mb-1">{{ $earnedCount }}</h2>
                        <p class="text-muted mb-0">Badges Earned</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h2 class="text-secondary mb-1">{{ $totalBadges - $earnedCount }}</h2>
                        <p class="text-muted mb-0">Badges Remaining</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Earned Badges --}}
        @if ($earnedBadges->count() > 0)
            <div class="row mb-4">
                <div class="col-12">
                    <h4 class="mb-3">
                        <i class="bi bi-stars text-warning me-2"></i>
                        Earned Badges
                    </h4>
                </div>
                @foreach ($earnedBadges as $badge)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card shadow-sm h-100 border-success">
                            <div class="card-body text-center">
                                <div class="badge-icon-container mb-3" style="position: relative;">
                                    <span style="font-size: 4rem;">{{ $badge->icon ?? '🏅' }}</span>
                                    <div style="position: absolute; top: 0; right: 0;">
                                        <i class="bi bi-check-circle-fill text-success" style="font-size: 1.5rem;"></i>
                                    </div>
                                </div>
                                <h5 class="mb-2">{{ $badge->name }}</h5>
                                <p class="text-muted small mb-3">{{ $badge->description }}</p>
                                <span
                                    class="badge 
                                    @if ($badge->badge_type === 'achievement') bg-primary
                                    @elseif($badge->badge_type === 'milestone') bg-success
                                    @elseif($badge->badge_type === 'streak') bg-warning
                                    @else bg-info @endif">
                                    {{ ucfirst($badge->badge_type) }}
                                </span>
                                <div class="mt-3 pt-3 border-top">
                                    <small class="text-muted">
                                        <i class="bi bi-calendar-check me-1"></i>
                                        {{ \Carbon\Carbon::parse($badge->awarded_at)->format('d M Y') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Locked Badges --}}
        @if ($lockedBadges->count() > 0)
            <div class="row">
                <div class="col-12">
                    <h4 class="mb-3">
                        <i class="bi bi-lock text-secondary me-2"></i>
                        Locked Badges
                    </h4>
                </div>
                @foreach ($lockedBadges as $badge)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card shadow-sm h-100" style="opacity: 0.7;">
                            <div class="card-body text-center">
                                <div class="badge-icon-container mb-3" style="filter: grayscale(100%);">
                                    <span style="font-size: 4rem;">{{ $badge->icon ?? '🏅' }}</span>
                                </div>
                                <h5 class="mb-2">{{ $badge->name }}</h5>
                                <p class="text-muted small mb-3">{{ $badge->description }}</p>
                                <span class="badge bg-secondary">
                                    {{ ucfirst($badge->badge_type) }}
                                </span>

                                {{-- Progress Bar --}}
                                @if ($badge->progress['required'] > 0)
                                    <div class="mt-3">
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{ $badge->progress['percentage'] }}%;"
                                                aria-valuenow="{{ $badge->progress['percentage'] }}" aria-valuemin="0"
                                                aria-valuemax="100">
                                                {{ $badge->progress['percentage'] }}%
                                            </div>
                                        </div>
                                        <small class="text-muted mt-2 d-block">
                                            {{ $badge->progress['current'] }} / {{ $badge->progress['required'] }}
                                        </small>
                                    </div>
                                @else
                                    <div class="mt-3">
                                        <small class="text-muted">
                                            <i class="bi bi-lock-fill me-1"></i>
                                            Keep participating to unlock
                                        </small>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Empty State --}}
        @if ($earnedBadges->count() === 0 && $lockedBadges->count() === 0)
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body text-center py-5">
                            <i class="bi bi-award text-muted" style="font-size: 4rem;"></i>
                            <h5 class="mt-3">Belum ada badge</h5>
                            <p class="text-muted">Mulai ikuti kompetisi untuk mendapatkan badge pertama Anda!</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
