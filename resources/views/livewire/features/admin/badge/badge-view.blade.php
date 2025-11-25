<div>
    <div class="page-heading mb-4">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3 class="mb-2">
                        <span style="font-size: 2rem;">{{ $badge->icon ?? '🏅' }}</span>
                        {{ $badge->name }}
                    </h3>
                    <p class="text-subtitle text-muted">{{ $badge->description }}</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.badges.index') }}">Badges</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $badge->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content">
        <div class="row">
            {{-- Badge Info --}}
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <span style="font-size: 5rem;">{{ $badge->icon ?? '🏅' }}</span>
                        <h4 class="mt-3">{{ $badge->name }}</h4>
                        <p class="text-muted">{{ $badge->description }}</p>

                        <div class="mt-4">
                            <span
                                class="badge 
                                @if ($badge->badge_type === 'achievement') bg-primary
                                @elseif($badge->badge_type === 'milestone') bg-success
                                @elseif($badge->badge_type === 'streak') bg-warning
                                @else bg-info @endif
                                p-2">
                                {{ ucfirst($badge->badge_type) }}
                            </span>
                        </div>

                        <div class="mt-4 pt-4 border-top">
                            <h5 class="mb-1">{{ $badge->users->count() }}</h5>
                            <small class="text-muted">Users Earned This Badge</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Users Who Earned This Badge --}}
            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-people-fill text-primary me-2"></i>
                            Users Who Earned This Badge
                        </h5>
                    </div>
                    <div class="card-body">
                        @if ($badge->users->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Awarded At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($badge->users as $user)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-sm me-2">
                                                            <div class="avatar-content bg-primary text-white">
                                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                                            </div>
                                                        </div>
                                                        <strong>{{ $user->name }}</strong>
                                                    </div>
                                                </td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    <small class="text-muted">
                                                        {{ $user->pivot->awarded_at ? \Carbon\Carbon::parse($user->pivot->awarded_at)->format('d M Y H:i') : '-' }}
                                                    </small>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                                <p class="text-muted mt-3">Belum ada user yang mendapatkan badge ini</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Back Button --}}
        <div class="row">
            <div class="col-12">
                <a href="{{ route('admin.badges.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>
</div>
