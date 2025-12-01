<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-8 order-md-1 order-last">
                <h3>Create New Question</h3>
                <p class="text-subtitle text-muted">Fill in the details and answers for the new question.</p>
            </div>
            <div class="col-12 col-md-4 order-md-2 order-first d-flex justify-content-end align-items-center">
                <a href="{{ route('admin.questions.index') }}" class="btn btn-outline-secondary icon-left">
                    <i class="bi bi-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-12 mt-4">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form wire:submit.prevent="save">
                                <div class="form-group mb-4">
                                    <label class="form-label">Competition <span class="text-danger">*</span></label>
                                    <select wire:model="competition_id"
                                        class="form-select @error('competition_id') is-invalid @enderror">
                                        <option value="">Select Competition</option>
                                        @foreach ($competitions as $competition)
                                            <option value="{{ $competition->id }}">{{ $competition->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('competition_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label class="form-label">Category <span class="text-danger">*</span></label>
                                    <select wire:model="category_id"
                                        class="form-select @error('category_id') is-invalid @enderror">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label class="form-label">Question Text <span class="text-danger">*</span></label>
                                    <textarea wire:model="question_text" rows="4" class="form-control @error('question_text') is-invalid @enderror"
                                        placeholder="Enter your question here..."></textarea>
                                    @error('question_text')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label class="form-label">Question Type <span class="text-danger">*</span></label>
                                    <select wire:model.live="question_type"
                                        class="form-select @error('question_type') is-invalid @enderror">
                                        <option value="multiple_choice">Multiple Choice</option>
                                        <option value="essay">Essay</option>
                                    </select>
                                    <small class="text-muted">
                                        Essay questions require manual grading by admin.
                                    </small>
                                    @error('question_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row mb-4 g-4">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Difficulty <span
                                                    class="text-danger">*</span></label>
                                            <select wire:model="difficulty_level"
                                                class="form-select @error('difficulty_level') is-invalid @enderror">
                                                <option value="easy">Easy</option>
                                                <option value="medium">Medium</option>
                                                <option value="hard">Hard</option>
                                            </select>
                                            @error('difficulty_level')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Point Weight <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" wire:model="point_weight" min="1"
                                                max="1000"
                                                class="form-control @error('point_weight') is-invalid @enderror"
                                                placeholder="100">
                                            @error('point_weight')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Status <span class="text-danger">*</span></label>
                                            <select wire:model="validation_status"
                                                class="form-select @error('validation_status') is-invalid @enderror">
                                                <option value="pending">Pending</option>
                                                <option value="approved">Approved</option>
                                                <option value="rejected">Rejected</option>
                                            </select>
                                            @error('validation_status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                @if ($question_type === 'multiple_choice')
                                    <div class="mb-5 p-4 border rounded bg-light">
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <label class="form-label fw-bold mb-0">Answers <span
                                                    class="text-danger">*</span> (at least 2 required)</label>
                                            <button type="button" wire:click="addAnswer"
                                                class="btn btn-success icon-left btn-sm">
                                                <i class="bi bi-plus-lg"></i> Add Answer
                                            </button>
                                        </div>

                                        @error('answers')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                        @foreach ($answers as $index => $answer)
                                            <div
                                                class="d-flex gap-3 mb-3 align-items-center p-3 rounded bg-white border">
                                                <div class="form-check form-check-inline">
                                                    <input type="radio"
                                                        wire:click="setCorrectAnswer({{ $index }})"
                                                        name="correct_answer"
                                                        {{ $answer['is_correct'] ? 'checked' : '' }}
                                                        class="form-check-input cursor-pointer">
                                                    <label class="form-check-label text-sm text-muted">Correct?</label>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <input type="text"
                                                        wire:model="answers.{{ $index }}.answer_text"
                                                        placeholder="Answer {{ $index + 1 }}"
                                                        class="form-control form-control-sm @error('answers.' . $index . '.answer_text') is-invalid @enderror">
                                                    @error('answers.' . $index . '.answer_text')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                @if (count($answers) > 2)
                                                    <button type="button"
                                                        wire:click="removeAnswer({{ $index }})"
                                                        class="btn btn-danger btn-sm icon-left text-nowrap"
                                                        title="Remove Answer">
                                                        <i class="bi bi-x-lg"></i> Remove
                                                    </button>
                                                @endif
                                            </div>
                                        @endforeach

                                        <p class="text-sm text-muted mt-3">
                                            <strong>Tip:</strong> Use the radio button next to the field to mark the
                                            correct
                                            answer.
                                        </p>
                                    </div>
                                @else
                                    <div class="alert alert-info mb-5">
                                        <i class="bi bi-info-circle"></i>
                                        <strong>Essay Question:</strong> This question type does not require predefined
                                        answers.
                                        Participants will submit text responses that require manual grading by
                                        administrators.
                                    </div>
                                @endif

                                <div class="d-flex gap-3 pt-3 border-top justify-content-end">
                                    <a href="{{ route('admin.questions.index') }}"
                                        class="btn btn-light-secondary px-4 py-2">
                                        Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary icon-left px-4 py-2"
                                        wire:loading.attr="disabled"
                                        wire:loading.class="opacity-50 cursor-not-allowed">
                                        <span wire:loading.remove wire:target="save">
                                            <i class="bi bi-check-circle"></i> Create Question
                                        </span>
                                        <span wire:loading wire:target="save">
                                            <span class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true"></span> Creating...
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
