\u003cdiv class=\"page-heading\"\u003e
    \u003cdiv class=\"page-title\"\u003e
        \u003cdiv class=\"row\"\u003e
            \u003cdiv class=\"col-12 col-md-8 order-md-1 order-last\"\u003e
                \u003ch3\u003eEssay Grading\u003c/h3\u003e
                \u003cp class=\"text-subtitle text-muted\"\u003eReview and grade participant essay submissions.\u003c/p\u003e
            \u003c/div\u003e
        \u003c/div\u003e
    \u003c/div\u003e

    \u003csection class=\"section\"\u003e
        @if(session()->has('message'))
        \u003cdiv class=\"alert alert-success alert-dismissible fade show\" role=\"alert\"\u003e
            {{ session('message') }}
            \u003cbutton type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"\u003e\u003c/button\u003e
        \u003c/div\u003e
        @endif

        \u003c!-- Competition Filter --\u003e
        \u003cdiv class=\"row mb-4\"\u003e
            \u003cdiv class=\"col-md-6\"\u003e
                \u003cdiv class=\"card\"\u003e
                    \u003cdiv class=\"card-body\"\u003e
                        \u003clabel class=\"form-label\"\u003eSelect Competition\u003c/label\u003e
                        \u003cselect wire:model.live=\"selectedCompetitionId\" class=\"form-select\"\u003e
                            \u003coption value=\"\"\u003e-- Select Competition --\u003c/option\u003e
                            @foreach($competitions as $comp)
                            \u003coption value=\"{{ $comp->id }}\"\u003e
                                {{ $comp->title }} ({{ $comp->questions_count }} essay questions)
                            \u003c/option\u003e
                            @endforeach
                        \u003c/select\u003e
                    \u003c/div\u003e
                \u003c/div\u003e
            \u003c/div\u003e
        \u003c/div\u003e

        \u003c!-- Pending Essays Table --\u003e
        @if($selectedCompetitionId)
        \u003cdiv class=\"row\"\u003e
            \u003cdiv class=\"col-12\"\u003e
                \u003cdiv class=\"card\"\u003e
                    \u003cdiv class=\"card-header\"\u003e
                        \u003ch4 class=\"card-title\"\u003ePending Essay Submissions\u003c/h4\u003e
                    \u003c/div\u003e
                    \u003cdiv class=\"card-body\"\u003e
                        @if($pendingAnswers->count() \u003e 0)
                        \u003cdiv class=\"table-responsive\"\u003e
                            \u003ctable class=\"table table-striped\"\u003e
                                \u003cthead\u003e
                                    \u003ctr\u003e
                                        \u003cth\u003eParticipant\u003c/th\u003e
                                        \u003cth\u003eQuestion\u003c/th\u003e
                                        \u003cth\u003eSubmitted\u003c/th\u003e
                                        \u003cth\u003eMax Points\u003c/th\u003e
                                        \u003cth\u003eAction\u003c/th\u003e
                                    \u003c/tr\u003e
                                \u003c/thead\u003e
                                \u003ctbody\u003e
                                    @foreach($pendingAnswers as $answer)
                                    \u003ctr\u003e
                                        \u003ctd\u003e{{ $answer->competitionParticipant->user->name }}\u003c/td\u003e
                                        \u003ctd\u003e
                                            \u003csmall class=\"text-muted\"\u003e
                                                {{ Str::limit($answer->question->question_text, 50) }}
                                            \u003c/small\u003e
                                        \u003c/td\u003e
                                        \u003ctd\u003e{{ $answer->answered_at?->format('M d, Y H:i') }}\u003c/td\u003e
                                        \u003ctd\u003e\u003cspan class=\"badge bg-primary\"\u003e{{ $answer->question->point_weight }}\u003c/span\u003e\u003c/td\u003e
                                        \u003ctd\u003e
                                            \u003cbutton wire:click=\"selectAnswer({{ $answer->id }}, {{ $answer->question->point_weight }})\"
                                                class=\"btn btn-sm btn-primary\" data-bs-toggle=\"modal\"
                                                data-bs-target=\"#gradingModal\"\u003e
                                                \u003ci class=\"bi bi-pencil-square\"\u003e\u003c/i\u003e Grade
                                            \u003c/button\u003e
                                        \u003c/td\u003e
                                    \u003c/tr\u003e
                                    @endforeach
                                \u003c/tbody\u003e
                            \u003c/table\u003e
                        \u003c/div\u003e

                        {{ $pendingAnswers->links() }}
                        @else
                        \u003cdiv class=\"alert alert-info\"\u003e
                            \u003ci class=\"bi bi-check-circle\"\u003e\u003c/i\u003e No pending essay submissions for this competition.
                        \u003c/div\u003e
                        @endif
                    \u003c/div\u003e
                \u003c/div\u003e
            \u003c/div\u003e
        \u003c/div\u003e
        @else
        \u003cdiv class=\"alert alert-warning\"\u003e
            \u003ci class=\"bi bi-exclamation-triangle\"\u003e\u003c/i\u003e Please select a competition to view pending essay submissions.
        \u003c/div\u003e
        @endif
    \u003c/section\u003e

    \u003c!-- Grading Modal --\u003e
    \u003cdiv class=\"modal fade\" id=\"gradingModal\" tabindex=\"-1\" wire:ignore.self\u003e
        \u003cdiv class=\"modal-dialog modal-lg\"\u003e
            \u003cdiv class=\"modal-content\"\u003e
                \u003cdiv class=\"modal-header\"\u003e
                    \u003ch5 class=\"modal-title\"\u003eGrade Essay Submission\u003c/h5\u003e
                    \u003cbutton type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\"\u003e\u003c/button\u003e
                \u003c/div\u003e
                @if($gradingAnswerId)
                @php
                    $selectedAnswer = $pendingAnswers->firstWhere('id', $gradingAnswerId);
                @endphp
                @if($selectedAnswer)
                \u003cdiv class=\"modal-body\"\u003e
                    \u003cdiv class=\"mb-3\"\u003e
                        \u003clabel class=\"fw-bold\"\u003eParticipant:\u003c/label\u003e
                        \u003cp\u003e{{ $selectedAnswer->competitionParticipant->user->name }}\u003c/p\u003e
                    \u003c/div\u003e

                    \u003cdiv class=\"mb-3\"\u003e
                        \u003clabel class=\"fw-bold\"\u003eQuestion:\u003c/label\u003e
                        \u003cp\u003e{{ $selectedAnswer->question->question_text }}\u003c/p\u003e
                    \u003c/div\u003e

                    \u003cdiv class=\"mb-3\"\u003e
                        \u003clabel class=\"fw-bold\"\u003eEssay Answer:\u003c/label\u003e
                        \u003cdiv class=\"p-3 bg-light rounded border\"\u003e
                            {{ $selectedAnswer->essay_answer_text }}
                        \u003c/div\u003e
                    \u003c/div\u003e

                    \u003cdiv class=\"mb-3\"\u003e
                        \u003clabel class=\"fw-bold\"\u003eTime Spent:\u003c/label\u003e
                        \u003cp\u003e{{ $selectedAnswer->time_spent }} seconds\u003c/p\u003e
                    \u003c/div\u003e

                    \u003chr\u003e

                    \u003cform wire:submit.prevent=\"gradeAnswer\"\u003e
                        \u003cdiv class=\"mb-3\"\u003e
                            \u003clabel class=\"form-label\"\u003eScore \u003cspan class=\"text-danger\"\u003e*\u003c/span\u003e (Max: {{ $maxScore }})\u003c/label\u003e
                            \u003cinput type=\"number\" wire:model=\"gradingScore\" min=\"0\" max=\"{{ $maxScore }}\"
                                step=\"0.01\" class=\"form-control @error('gradingScore') is-invalid @enderror\"\u003e
                            @error('gradingScore')
                            \u003cdiv class=\"invalid-feedback\"\u003e{{ $message }}\u003c/div\u003e
                            @enderror
                        \u003c/div\u003e

                        \u003cdiv class=\"mb-3\"\u003e
                            \u003clabel class=\"form-label\"\u003eGrading Notes/Feedback (Optional)\u003c/label\u003e
                            \u003ctextarea wire:model=\"gradingNotes\" rows=\"3\"
                                class=\"form-control @error('gradingNotes') is-invalid @enderror\"
                                placeholder=\"Add feedback for student...\"\u003e\u003c/textarea\u003e
                            @error('gradingNotes')
                            \u003cdiv class=\"invalid-feedback\"\u003e{{ $message }}\u003c/div\u003e
                            @enderror
                        \u003c/div\u003e

                        \u003cdiv class=\"d-flex gap-2 justify-content-end\"\u003e
                            \u003cbutton type=\"button\" class=\"btn btn-secondary\" data-bs-dismiss=\"modal\"\u003eCancel\u003c/button\u003e
                            \u003cbutton type=\"submit\" class=\"btn btn-primary\" wire:loading.attr=\"disabled\"\u003e
                                \u003cspan wire:loading.remove\u003eSubmit Grade\u003c/span\u003e
                                \u003cspan wire:loading\u003eSubmitting...\u003c/span\u003e
                            \u003c/button\u003e
                        \u003c/div\u003e
                    \u003c/form\u003e
                \u003c/div\u003e
                @endif
                @endif
            \u003c/div\u003e
        \u003c/div\u003e
    \u003c/div\u003e
\u003c/div\u003e

@push('scripts')
\u003cscript\u003e
    window.addEventListener('close-modal', event =\u003e {
        let modal = bootstrap.Modal.getInstance(document.getElementById('gradingModal'));
        if (modal) modal.hide();
    });

    Livewire.on('essayGraded', () =\u003e {
        let modal = bootstrap.Modal.getInstance(document.getElementById('gradingModal'));
        if (modal) modal.hide();
    });
\u003c/script\u003e
@endpush
