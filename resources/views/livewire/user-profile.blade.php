<div>
    <div class="page-heading mb-4">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3 class="mb-2">
                        <i class="bi bi-person-circle text-primary me-2"></i>
                        My Profile
                    </h3>
                    <p class="text-subtitle text-muted">View your profile information and achievements</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('peserta.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <!-- Profile Header Card -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-2 text-center mb-3 mb-md-0">
                        <!-- Avatar with initials -->
                        <div class="avatar avatar-xl bg-gradient-primary text-white d-inline-flex align-items-center justify-center rounded-circle shadow-lg"
                            style="width: 100px; height: 100px; font-size: 2.5rem; font-weight: bold;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    </div>
                    <div class="col-md-10">
                        <h4 class="mb-1">{{ $user->name }}</h4>
                        <p class="text-muted mb-2">
                            <i class="bi bi-envelope me-1"></i> {{ $user->email }}
                        </p>
                        <span class="badge bg-primary">{{ ucfirst($user->role) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="mb-2">
                            <i class="bi bi-award-fill text-warning" style="font-size: 2.5rem;"></i>
                        </div>
                        <h3 class="mb-1">{{ $totalBadges }}</h3>
                        <p class="text-muted mb-0">Badges Earned</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="mb-2">
                            <i class="bi bi-trophy-fill text-success" style="font-size: 2.5rem;"></i>
                        </div>
                        <h3 class="mb-1">{{ $totalCompletedCompetitions }}</h3>
                        <p class="text-muted mb-0">Competitions Completed</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="mb-2">
                            <i class="bi bi-graph-up-arrow text-info" style="font-size: 2.5rem;"></i>
                        </div>
                        <h3 class="mb-1">{{ $averageScore }}</h3>
                        <p class="text-muted mb-0">Average Score</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Badges Section -->
        <div class="card mb-4">
            <div class="card-header bg-gradient-primary text-white">
                <h5 class="mb-0">
                    <i class="bi bi-award me-2"></i>
                    My Badges
                </h5>
            </div>
            <div class="card-body">
                @if ($badges->count() > 0)
                    <div class="row">
                        @foreach ($badges as $userBadge)
                            <div class="col-md-3 col-sm-6 mb-4">
                                <div class="card h-100 border-0 shadow-sm text-center">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            @if ($userBadge->badge->icon)
                                                <i class="{{ $userBadge->badge->icon }} text-warning"
                                                    style="font-size: 3rem;"></i>
                                            @else
                                                <i class="bi bi-award-fill text-warning" style="font-size: 3rem;"></i>
                                            @endif
                                        </div>
                                        <h6 class="mb-2">{{ $userBadge->badge->name }}</h6>
                                        <p class="text-muted small mb-2">{{ $userBadge->badge->description }}</p>
                                        <small class="text-muted">
                                            <i class="bi bi-calendar-check me-1"></i>
                                            {{ $userBadge->awarded_at->format('M d, Y') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-award text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
                        <h5 class="text-muted mt-3">No badges earned yet</h5>
                        <p class="text-muted">Complete competitions to earn badges!</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Completed Competitions Section -->
        <div class="card">
            <div class="card-header bg-gradient-primary text-white">
                <h5 class="mb-0">
                    <i class="bi bi-trophy me-2"></i>
                    Completed Competitions
                </h5>
            </div>
            <div class="card-body">
                @if ($completedCompetitions->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Competition Title</th>
                                    <th>Completed At</th>
                                    <th class="text-end">Score</th>
                                    <th class="text-end">Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($completedCompetitions as $participant)
                                    <tr>
                                        <td>
                                            <strong>{{ $participant->competition->title }}</strong>
                                        </td>
                                        <td>
                                            <i class="bi bi-calendar-check me-1"></i>
                                            {{ $participant->finished_at->format('M d, Y H:i') }}
                                        </td>
                                        <td class="text-end">
                                            <span class="badge bg-success">{{ $participant->total_score }} pts</span>
                                        </td>
                                        <td class="text-end">
                                            <span class="badge bg-info">{{ $participant->progress_percentage }}%</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-trophy text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
                        <h5 class="text-muted mt-3">No completed competitions yet</h5>
                        <p class="text-muted">Start competing to see your achievements here!</p>
                        <a href="{{ route('peserta.competitions.list') }}" class="btn btn-primary mt-3">
                            <i class="bi bi-lightning-charge me-2"></i>
                            Browse Competitions
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .avatar {
            transition: transform 0.3s ease;
        }

        .avatar:hover {
            transform: scale(1.05);
        }

        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1) !important;
        }
    </style>
</div>
