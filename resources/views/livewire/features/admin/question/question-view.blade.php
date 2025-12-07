<div>
    <div>
        <div>
            <div>
                <!-- Page Header -->
                <div class="mb-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h1
                                class="text-3xl font-bold text-transparent bg-gradient-to-r from-indigo-400 to-pink-400 bg-clip-text mb-2">
                                Question Details
                            </h1>
                            <p class="text-slate-400">View detailed information and answers for this question.</p>
                        </div>
                        <a href="{{ route('admin.questions.index') }}"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-slate-800 border border-slate-700 text-white font-semibold rounded-xl hover:bg-slate-700 transition-all">
                            <i class="bi bi-arrow-left"></i>
                            Back to List
                        </a>
                    </div>
                </div>

                <!-- Main Card -->
                <div
                    class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl overflow-hidden">
                    <!-- Header with Badges and Actions -->
                    <div class="px-6 py-4 bg-slate-900/50 border-b border-slate-700 flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            @if ($question->validation_status === 'approved')
                                <span
                                    class="px-4 py-2 rounded-full text-sm font-semibold bg-green-500/20 text-green-400 border border-green-500/30">Approved</span>
                            @elseif($question->validation_status === 'pending')
                                <span
                                    class="px-4 py-2 rounded-full text-sm font-semibold bg-blue-500/20 text-blue-400 border border-blue-500/30">Pending</span>
                            @else
                                <span
                                    class="px-4 py-2 rounded-full text-sm font-semibold bg-red-500/20 text-red-400 border border-red-500/30">Rejected</span>
                            @endif

                            @if ($question->difficulty_level === 'easy')
                                <span
                                    class="px-4 py-2 rounded-full text-sm font-semibold bg-green-500/20 text-green-400 border border-green-500/30">Easy</span>
                            @elseif($question->difficulty_level === 'medium')
                                <span
                                    class="px-4 py-2 rounded-full text-sm font-semibold bg-yellow-500/20 text-yellow-400 border border-yellow-500/30">Medium</span>
                            @else
                                <span
                                    class="px-4 py-2 rounded-full text-sm font-semibold bg-red-500/20 text-red-400 border border-red-500/30">Hard</span>
                            @endif
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.questions.edit', $question->id) }}"
                                class="inline-flex items-center gap-2 px-4 py-2 gradient-primary text-white font-semibold rounded-lg hover:shadow-lg hover:shadow-indigo-500/50 transition">
                                <i class="bi bi-pencil-square"></i>
                                Edit
                            </a>
                            <button wire:click="confirmDelete"
                                class="inline-flex items-center gap-2 px-4 py-2 bg-red-500/20 text-red-400 border border-red-500/30 font-semibold rounded-lg hover:bg-red-500/30 transition">
                                <i class="bi bi-trash"></i>
                                Delete
                            </button>
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="p-6 space-y-6">
                        <!-- Basic Information -->
                        <div class="border-b border-slate-700 pb-6">
                            <h3 class="text-xl font-bold text-white mb-4">Basic Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4">
                                    <label class="text-xs text-slate-400 mb-1 block">Question ID</label>
                                    <p class="text-white font-semibold">#{{ $question->id }}</p>
                                </div>
                                <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4">
                                    <label class="text-xs text-slate-400 mb-1 block">Point Weight</label>
                                    <p class="text-white font-semibold text-lg">{{ $question->point_weight }} points</p>
                                </div>
                                <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4">
                                    <label class="text-xs text-slate-400 mb-1 block">Competition</label>
                                    <p class="text-white">{{ $question->competition->title ?? 'N/A' }}</p>
                                </div>
                                <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4">
                                    <label class="text-xs text-slate-400 mb-1 block">Category</label>
                                    <p class="text-white">{{ $question->category->name ?? 'N/A' }}</p>
                                </div>
                                @if ($question->verifier)
                                    <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4 md:col-span-2">
                                        <label class="text-xs text-slate-400 mb-1 block">Verified By</label>
                                        <p class="text-white">{{ $question->verifier->name }}
                                            ({{ $question->verifier->email }})</p>
                                    </div>
                                @endif
                                <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4 md:col-span-2">
                                    <label class="text-xs text-slate-400 mb-1 block">Created At</label>
                                    <p class="text-white">{{ $question->created_at->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Question -->
                        <div>
                            <h3 class="text-xl font-bold text-white mb-3">Question</h3>
                            <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-6">
                                <p class="text-white text-lg leading-relaxed">{{ $question->question_text }}</p>
                            </div>
                        </div>

                        <!-- Answers -->
                        <div>
                            <h3 class="text-xl font-bold text-white mb-3">Answers ({{ $question->answers->count() }})
                            </h3>
                            <div class="space-y-3">
                                @forelse($question->answers as $index => $answer)
                                    <div
                                        class="flex items-start gap-3 p-4 rounded-xl border-2 {{ $answer->is_correct ? 'bg-green-500/10 border-green-500/30' : 'bg-slate-800/50 border-slate-700' }}">
                                        <div class="flex-shrink-0 mt-1">
                                            @if ($answer->is_correct)
                                                <i class="bi bi-check-circle-fill text-green-400 text-2xl"></i>
                                            @else
                                                <i class="bi bi-x-circle-fill text-slate-600 text-2xl"></i>
                                            @endif
                                        </div>
                                        <div class="flex-grow">
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="text-xs font-semibold text-slate-400">Answer
                                                    {{ chr(65 + $index) }}</span>
                                                @if ($answer->is_correct)
                                                    <span
                                                        class="px-2 py-1 rounded-full text-xs font-semibold bg-green-500/20 text-green-400 border border-green-500/30">CORRECT</span>
                                                @endif
                                            </div>
                                            <p class="text-white">{{ $answer->answer_text }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-8 bg-slate-800/50 border border-slate-700 rounded-xl">
                                        <i class="bi bi-inbox text-slate-600 text-4xl block mb-2"></i>
                                        <p class="text-slate-400">No answers available for this question.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="px-6 py-4 bg-slate-900/50 border-t border-slate-700">
                        <h4 class="text-sm font-semibold text-white mb-3">Timestamps</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-slate-400">Created:</span>
                                <span
                                    class="text-white font-semibold ml-2">{{ $question->created_at->format('M d, Y H:i:s') }}</span>
                            </div>
                            <div>
                                <span class="text-slate-400">Last Updated:</span>
                                <span
                                    class="text-white font-semibold ml-2">{{ $question->updated_at->format('M d, Y H:i:s') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($deleteId)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
            <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 max-w-md w-full mx-4" wire:click.stop>
                <div class="flex items-center gap-3 mb-4 pb-4 border-b border-slate-700">
                    <div class="p-3 bg-red-500/20 rounded-full">
                        <i class="bi bi-exclamation-octagon-fill text-red-400 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white">Confirm Deletion</h3>
                </div>

                <div class="mb-6">
                    <div class="text-center mb-4">
                        <i class="bi bi-trash-fill text-red-400 text-5xl"></i>
                    </div>
                    <h4 class="text-lg font-bold text-white mb-2 text-center">Are you sure?</h4>
                    <p class="text-slate-400 text-center">Are you sure you want to delete this question? This will also
                        delete all associated answers. This action cannot be undone.</p>
                </div>

                <div class="flex justify-center gap-3">
                    <button type="button" wire:click="$set('deleteId', null)"
                        class="px-6 py-3 bg-slate-700 text-white font-semibold rounded-xl hover:bg-slate-600 transition">
                        Cancel
                    </button>
                    <button type="button" wire:click="delete" wire:loading.attr="disabled"
                        wire:loading.class="opacity-50"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-red-500/20 text-red-400 border border-red-500/30 font-semibold rounded-xl hover:bg-red-500/30 transition">
                        <span wire:loading.remove wire:target="delete">
                            <i class="bi bi-trash"></i>
                            Delete
                        </span>
                        <span wire:loading wire:target="delete" class="flex items-center gap-2">
                            <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            Deleting...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <style>
        body.light-theme .bg-gradient-to-br {
            background: white !important;
            border-color: #e2e8f0 !important;
        }

        body.light-theme .text-white {
            color: #0f172a !important;
        }

        body.light-theme .text-slate-300,
        body.light-theme .text-slate-400 {
            color: #64748b !important;
        }

        body.light-theme .border-slate-700 {
            border-color: #e2e8f0 !important;
        }

        body.light-theme .bg-slate-900,
        body.light-theme .bg-slate-800 {
            background: #f8fafc !important;
        }

        body.light-theme .bg-slate-800\/50 {
            background: #f8fafc !important;
        }

        body.light-theme .bi-inbox,
        body.light-theme .bi-x-circle-fill {
            color: #cbd5e1 !important;
        }
    </style>
</div>
