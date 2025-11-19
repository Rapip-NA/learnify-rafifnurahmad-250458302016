<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Question Details</h3>
                <p class="text-subtitle text-muted">View detailed information and answers for this question.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first d-flex justify-content-end align-items-center">
                <a href="{{ route('admin.questions.index') }}" class="btn btn-outline-secondary icon-left">
                    <i class="bi bi-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="card">

                    <div class="card-header d-flex justify-content-between align-items-center bg-light border-bottom">
                        <div class="d-flex gap-2">
                            <span class="badge **fs-6** @if($question->validation_status === 'approved') bg-success
                                @elseif($question->validation_status === 'pending') bg-info
                                @else bg-danger
                                @endif">
                                {{ ucfirst($question->validation_status) }}
                            </span>
                            <span class="badge **fs-6**
                                @if($question->difficulty_level === 'easy') bg-success
                                @elseif($question->difficulty_level === 'medium') bg-warning
                                @else bg-danger
                                @endif">
                                {{ ucfirst($question->difficulty_level) }}
                            </span>
                        </div>
                        <div class="btn-group gap-2">
                            <a href="{{ route('admin.questions.edit', $question->id) }}"
                                class="btn btn-primary icon-left btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <button wire:click="confirmDelete" class="btn btn-danger icon-left btn-sm">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="mb-5 border-bottom pb-4">
                            <h4 class="fw-bold text-dark mb-4">Basic Information</h4>
                            <div class="row g-4">
                                <div class="col-md-3 col-sm-6">
                                    <label class="form-label text-sm text-muted mb-1">Question ID</label>
                                    <p class="text-dark fw-bold mb-0">#{{ $question->id }}</p>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <label class="form-label text-sm text-muted mb-1">Point Weight</label>
                                    <p class="text-dark fw-bold mb-0 fs-5">{{ $question->point_weight }} points</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-sm text-muted mb-1">Competition</label>
                                    <p class="text-dark mb-0">{{ $question->competition->title ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-sm text-muted mb-1">Category</label>
                                    <p class="text-dark mb-0">{{ $question->category->name ?? 'N/A' }}</p>
                                </div>
                                @if($question->verifier)
                                <div class="col-md-6">
                                    <label class="form-label text-sm text-muted mb-1">Verified By</label>
                                    <p class="text-dark mb-0">{{ $question->verifier->name }} ({{
                                        $question->verifier->email }})</p>
                                </div>
                                @endif
                                <div class="col-md-6">
                                    <label class="form-label text-sm text-muted mb-1">Created At</label>
                                    <p class="text-dark mb-0">{{ $question->created_at->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-5">
                            <h4 class="fw-bold text-dark mb-3">Question</h4>
                            <div class="bg-light p-4 rounded border">
                                <p class="text-dark fs-5 lh-base">{{ $question->question_text }}</p>
                            </div>
                        </div>

                        <div class="mb-5">
                            <h4 class="fw-bold text-dark mb-3">Answers ({{ $question->answers->count() }})</h4>
                            <div class="space-y-3">
                                @forelse($question->answers as $index => $answer)
                                <div
                                    class="d-flex align-items-start gap-3 p-3 rounded border-2
                                        {{ $answer->is_correct ? 'bg-success-light border-success' : 'bg-light border-secondary' }}">

                                    <div class="flex-shrink-0 mt-1">
                                        @if($answer->is_correct)
                                        <i class="bi bi-check-circle-fill text-success fs-4"></i>
                                        @else
                                        <i class="bi bi-x-circle-fill text-secondary fs-4"></i>
                                        @endif
                                    </div>

                                    <div class="flex-grow-1">
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <span class="text-sm fw-bold text-muted">Answer {{ chr(65 + $index)
                                                }}</span>
                                            @if($answer->is_correct)
                                            <span class="badge bg-success">CORRECT</span>
                                            @endif
                                        </div>
                                        <p class="text-dark mb-0">{{ $answer->answer_text }}</p>
                                    </div>
                                </div>
                                @empty
                                <div class="text-center py-4 text-muted border rounded bg-light">
                                    No answers available for this question.
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-white pt-3 border-top">
                        <h6 class="fw-bold text-dark mb-3">Timestamps</h6>
                        <div class="row text-sm">
                            <div class="col-md-6">
                                <span class="text-muted">Created:</span>
                                <span class="fw-semibold ms-2">{{ $question->created_at->format('M d, Y H:i:s')
                                    }}</span>
                            </div>
                            <div class="col-md-6">
                                <span class="text-muted">Last Updated:</span>
                                <span class="fw-semibold ms-2">{{ $question->updated_at->format('M d, Y H:i:s')
                                    }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@if($deleteId)
<div class="modal fade show d-block" tabindex="-1" role="dialog" style="background-color: rgba(0, 0, 0, 0.5);"
    aria-modal="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" wire:click.stop>
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white"><i class="bi bi-exclamation-octagon-fill me-2"></i> Confirm Deletion
                </h5>
            </div>
            <div class="modal-body text-center">
                <div class="text-center mb-3">
                    <i class="bi bi-trash-fill text-danger fs-1"></i>
                </div>
                <h5 class="fw-bold">Are you sure?</h5>
                <p class="text-muted">Are you sure you want to delete this question? This will also delete all
                    associated answers. This action cannot be undone.</p>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-light-secondary" wire:click="$set('deleteId', null)">
                    Cancel
                </button>
                <button type="button" class="btn btn-danger" wire:click="delete" wire:loading.attr="disabled"
                    wire:loading.class="opacity-50 cursor-not-allowed">
                    <span wire:loading.remove wire:target="delete"><i class="bi bi-trash me-1"></i> Delete</span>
                    <span wire:loading wire:target="delete"><span class="spinner-border spinner-border-sm" role="status"
                            aria-hidden="true"></span> Deleting...</span>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal-backdrop fade show"></div>
@endif