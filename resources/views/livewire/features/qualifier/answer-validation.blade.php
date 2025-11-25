<div>
    <div class="page-heading mb-4">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3 class="mb-2">
                        <i class="bi bi-check2-square text-primary me-2"></i>
                        Answer Validation
                    </h3>
                    <p class="text-subtitle text-muted">Validasi jawaban peserta</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('qualifier.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Answer Validation</li>
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

        {{-- Statistics Cards --}}
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h3 class="text-warning mb-1">{{ $statistics['pending'] }}</h3>
                        <p class="text-muted mb-0">Pending</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h3 class="text-success mb-1">{{ $statistics['approved'] }}</h3>
                        <p class="text-muted mb-0">Approved</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h3 class="text-danger mb-1">{{ $statistics['rejected'] }}</h3>
                        <p class="text-muted mb-0">Rejected</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filters --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Status Filter</label>
                                <select wire:model.live="statusFilter" class="form-select">
                                    <option value="all">All Status</option>
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Competition Filter</label>
                                <select wire:model.live="competitionFilter" class="form-select">
                                    <option value="">All Competitions</option>
                                    @foreach ($competitions as $competition)
                                        <option value="{{ $competition->id }}">{{ $competition->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label fw-bold">Search Participant</label>
                                <input type="text" wire:model.live.debounce.300ms="search" class="form-control"
                                    placeholder="Search by participant name...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Answers Table --}}
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Participant Answers</h5>
                    </div>
                    <div class="card-body">
                        @if ($answers->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Participant</th>
                                            <th>Competition</th>
                                            <th>Question</th>
                                            <th>Answer</th>
                                            <th>Correct</th>
                                            <th>Status</th>
                                            <th>Verified By</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($answers as $answer)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-sm me-2">
                                                            <div class="avatar-content bg-primary text-white">
                                                                {{ strtoupper(substr($answer->competitionParticipant->user->name, 0, 1)) }}
                                                            </div>
                                                        </div>
                                                        <strong>{{ $answer->competitionParticipant->user->name }}</strong>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info">
                                                        {{ $answer->competitionParticipant->competition->title }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <small>
                                                        {{ Str::limit($answer->question->question_text, 50) }}
                                                    </small>
                                                </td>
                                                <td>
                                                    <small>{{ Str::limit($answer->answer->answer_text, 30) }}</small>
                                                </td>
                                                <td>
                                                    @if ($answer->is_correct)
                                                        <i class="bi bi-check-circle-fill text-success"></i>
                                                    @else
                                                        <i class="bi bi-x-circle-fill text-danger"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($answer->validation_status === 'pending')
                                                        <span class="badge bg-warning">Pending</span>
                                                    @elseif ($answer->validation_status === 'approved')
                                                        <span class="badge bg-success">Approved</span>
                                                    @else
                                                        <span class="badge bg-danger">Rejected</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <small class="text-muted">
                                                        {{ $answer->verifier->name ?? '-' }}
                                                    </small>
                                                </td>
                                                <td>
                                                    <small class="text-muted">
                                                        {{ $answer->answered_at ? $answer->answered_at->format('d M Y H:i') : '-' }}
                                                    </small>
                                                </td>
                                                <td>
                                                    @if ($answer->validation_status === 'pending')
                                                        <button wire:click="approveAnswer({{ $answer->id }})"
                                                            class="btn btn-sm btn-success me-1">
                                                            <i class="bi bi-check"></i>
                                                        </button>
                                                        <button wire:click="rejectAnswer({{ $answer->id }})"
                                                            class="btn btn-sm btn-danger">
                                                            <i class="bi bi-x"></i>
                                                        </button>
                                                    @else
                                                        <span class="badge bg-secondary">Validated</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pagination --}}
                            <div class="mt-3">
                                {{ $answers->links() }}
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                                <p class="text-muted mt-3">Tidak ada jawaban yang ditemukan</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
