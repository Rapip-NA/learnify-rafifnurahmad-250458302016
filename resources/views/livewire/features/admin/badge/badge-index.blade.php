<div>
    <div class="page-heading mb-4">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3 class="mb-2">
                        <i class="bi bi-award text-primary me-2"></i>
                        Badge Management
                    </h3>
                    <p class="text-subtitle text-muted">Kelola badge dan reward sistem</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Badges</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content">
        {{-- Success Message --}}
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Search and Actions --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <input type="text" wire:model.live.debounce.300ms="search" class="form-control"
                                    placeholder="Cari badge...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Badge Cards --}}
        <div class="row">
            @forelse ($badges as $badge)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-start mb-3">
                                <div class="flex-shrink-0">
                                    <span style="font-size: 3rem;">{{ $badge->icon ?? '🏅' }}</span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="card-title mb-1">{{ $badge->name }}</h5>
                                    <span
                                        class="badge 
                                        @if ($badge->badge_type === 'achievement') bg-primary
                                        @elseif($badge->badge_type === 'milestone') bg-success
                                        @elseif($badge->badge_type === 'streak') bg-warning
                                        @else bg-info @endif">
                                        {{ ucfirst($badge->badge_type) }}
                                    </span>
                                </div>
                            </div>

                            <p class="card-text text-muted small">{{ $badge->description }}</p>

                            <div class="mt-3 pt-3 border-top">
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="bi bi-people-fill me-1"></i>
                                        {{ $badge->users_count }} user earned
                                    </small>
                                    <div>
                                        <a href="{{ route('admin.badges.view', $badge->id) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <button wire:click="deleteBadge({{ $badge->id }})"
                                            wire:confirm="Hapus badge ini?" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body text-center py-5">
                            <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-3">Belum ada badge</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if ($badges->hasPages())
            <div class="mt-4">
                {{ $badges->links() }}
            </div>
        @endif
    </div>
</div>
