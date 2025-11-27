<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Questions Management</h3>
                <p class="text-subtitle text-muted">Manage all competition questions and their details.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first d-flex justify-content-end align-items-center">
                <a href="{{ route('admin.questions.create') }}" class="btn btn-primary icon-left">
                    <i class="bi bi-plus-lg"></i> Add New Question
                </a>
            </div>
        </div>
    </div>

    <section class="section">
        @if (session()->has('message'))
            <div class="alert alert-light-success color-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i>
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card mt-4">
            <div class="card-header">
                <h4 class="card-title">Filter Questions</h4>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12 col-md-4 col-lg-3">
                        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search questions..."
                            class="form-control">
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <select wire:model.live="filterCompetition" class="form-select">
                            <option value="">All Competitions</option>
                            @foreach ($competitions as $competition)
                                <option value="{{ $competition->id }}">{{ Str::limit($competition->title, 20) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <select wire:model.live="filterCategory" class="form-select">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <select wire:model.live="filterDifficulty" class="form-select">
                            <option value="">All Difficulties</option>
                            <option value="easy">Easy</option>
                            <option value="medium">Medium</option>
                            <option value="hard">Hard</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <select wire:model.live="filterStatus" class="form-select">
                            <option value="">All Statuses</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="table-responsive">
                    <table class="table table-lg table-hover" id="table1">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-nowrap">ID</th>
                                <th class="text-uppercase">Question</th>
                                <th class="text-uppercase">Competition</th>
                                <th class="text-uppercase">Category</th>
                                <th class="text-uppercase">Difficulty</th>
                                <th class="text-uppercase">Points</th>
                                <th class="text-uppercase">Status</th>
                                <th class="text-uppercase text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($questions as $question)
                                <tr>
                                    <td class="text-bold-500 text-nowrap">{{ $question->id }}</td>
                                    <td>
                                        <div class="text-truncate" style="max-width: 200px;">
                                            {{ Str::limit($question->question_text, 50) }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-truncate" style="max-width: 150px;">
                                            {{ $question->competition->title ?? 'N/A' }}
                                        </div>
                                    </td>
                                    <td class="text-nowrap">{{ $question->category->name ?? 'N/A' }}</td>
                                    <td class="text-nowrap">
                                        <span
                                            class="badge
                                            @if ($question->difficulty_level === 'easy') bg-success
                                            @elseif($question->difficulty_level === 'medium') bg-warning
                                            @else bg-danger @endif">
                                            {{ ucfirst($question->difficulty_level) }}
                                        </span>
                                    </td>
                                    <td>{{ $question->point_weight }}</td>
                                    <td class="text-nowrap">
                                        <span
                                            class="badge
                                            @if ($question->validation_status === 'approved') bg-success
                                            @elseif($question->validation_status === 'pending') bg-info
                                            @else bg-danger @endif">
                                            {{ ucfirst($question->validation_status) }}
                                        </span>
                                    </td>
                                    <td class="text-end text-nowrap">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.questions.view', $question->id) }}"
                                                class="btn btn-sm btn-outline-info" title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.questions.edit', $question->id) }}"
                                                class="btn btn-sm btn-outline-warning" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button onclick="confirmDeleteQuestion({{ $question->id }})"
                                                class="btn btn-sm btn-outline-danger" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox-fill fs-1 mb-3 d-block"></i>
                                        <p class="fs-5">No questions found.</p>
                                        @if ($search || $filterCompetition || $filterCategory || $filterDifficulty || $filterStatus)
                                            <p class="text-sm mt-2">Try adjusting your filter criteria.</p>
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $questions->links() }}
        </div>
    </section>
</div>

<script>
    function confirmDeleteQuestion(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Pertanyaan ini akan dihapus secara permanen beserta semua jawaban!",
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

    window.addEventListener('question-deleted', event => {
        Swal.fire({
            title: 'Berhasil!',
            text: 'Pertanyaan berhasil dihapus.',
            icon: 'success',
            timer: 2000,
            showConfirmButton: false
        });
    });
</script>
