<div class="space-y-8">
    <!-- Page Header -->
    <div class="space-y-4">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1
                    class="text-4xl md:text-5xl font-black text-transparent bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 bg-clip-text">
                    Answer Validation
                </h1>
                <p class="text-lg text-slate-400 mt-2">Validasi jawaban peserta</p>
            </div>

            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-sm">
                <a href="{{ route('qualifier.dashboard') }}" class="text-slate-400 hover:text-white transition">
                    Dashboard
                </a>
                <span class="text-slate-600">/</span>
                <span class="text-white font-medium">Answer Validation</span>
            </nav>
        </div>
    </div>

    {{-- Success Message --}}
    @if (session()->has('success'))
        <div
            class="bg-gradient-to-br from-green-800 to-green-900 border border-green-700 rounded-2xl p-4 flex items-center gap-3">
            <div class="w-10 h-10 bg-green-500 bg-opacity-20 rounded-lg flex items-center justify-center">
                <i class="bi bi-check-circle text-green-400 text-xl"></i>
            </div>
            <p class="text-green-100">{{ session('success') }}</p>
        </div>
    @endif

    {{-- Statistics Cards --}}
    <div class="grid md:grid-cols-3 gap-6">
        <!-- Pending Card -->
        <div
            class="relative overflow-hidden bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-6 group hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
            <div
                class="absolute top-0 right-0 w-32 h-32 bg-yellow-500 opacity-0 group-hover:opacity-10 rounded-full blur-3xl transition-all duration-500">
            </div>

            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-slate-400 text-sm font-medium mb-1">Pending</p>
                    <h3
                        class="text-4xl font-black text-transparent bg-gradient-to-r from-yellow-400 to-orange-400 bg-clip-text">
                        {{ $statistics['pending'] }}
                    </h3>
                </div>
                <div class="w-14 h-14 bg-yellow-500 bg-opacity-20 rounded-xl flex items-center justify-center text-2xl">
                    ⏳
                </div>
            </div>
        </div>

        <!-- Approved Card -->
        <div
            class="relative overflow-hidden bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-6 group hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
            <div
                class="absolute top-0 right-0 w-32 h-32 bg-green-500 opacity-0 group-hover:opacity-10 rounded-full blur-3xl transition-all duration-500">
            </div>

            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-slate-400 text-sm font-medium mb-1">Approved</p>
                    <h3
                        class="text-4xl font-black text-transparent bg-gradient-to-r from-green-400 to-emerald-400 bg-clip-text">
                        {{ $statistics['approved'] }}
                    </h3>
                </div>
                <div class="w-14 h-14 bg-green-500 bg-opacity-20 rounded-xl flex items-center justify-center text-2xl">
                    ✅
                </div>
            </div>
        </div>

        <!-- Rejected Card -->
        <div
            class="relative overflow-hidden bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-6 group hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
            <div
                class="absolute top-0 right-0 w-32 h-32 bg-red-500 opacity-0 group-hover:opacity-10 rounded-full blur-3xl transition-all duration-500">
            </div>

            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-slate-400 text-sm font-medium mb-1">Rejected</p>
                    <h3
                        class="text-4xl font-black text-transparent bg-gradient-to-r from-red-400 to-pink-400 bg-clip-text">
                        {{ $statistics['rejected'] }}
                    </h3>
                </div>
                <div class="w-14 h-14 bg-red-500 bg-opacity-20 rounded-xl flex items-center justify-center text-2xl">
                    ❌
                </div>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-6">
        <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
            <span class="text-2xl">🔍</span>
            Filters
        </h3>
        <div class="grid md:grid-cols-12 gap-4">
            <div class="md:col-span-3">
                <label class="block text-sm font-semibold text-slate-300 mb-2">Status Filter</label>
                <select wire:model.live="statusFilter"
                    class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                    <option value="all">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>
            <div class="md:col-span-4">
                <label class="block text-sm font-semibold text-slate-300 mb-2">Competition Filter</label>
                <select wire:model.live="competitionFilter"
                    class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                    <option value="">All Competitions</option>
                    @foreach ($competitions as $competition)
                        <option value="{{ $competition->id }}">{{ $competition->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-5">
                <label class="block text-sm font-semibold text-slate-300 mb-2">Search Participant</label>
                <input type="text" wire:model.live.debounce.300ms="search"
                    class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                    placeholder="Search by participant name...">
            </div>
        </div>
    </div>

    {{-- Answers Table --}}
    <div class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl overflow-hidden">
        <div class="p-6 border-b border-slate-700">
            <h3 class="text-xl font-bold text-white flex items-center gap-2">
                <span class="text-2xl">📝</span>
                Participant Answers
            </h3>
        </div>
        <div class="p-6">
            @if ($answers->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-slate-700">
                                <th class="text-left py-4 px-4 text-sm font-semibold text-slate-300">Participant</th>
                                <th class="text-left py-4 px-4 text-sm font-semibold text-slate-300">Competition</th>
                                <th class="text-left py-4 px-4 text-sm font-semibold text-slate-300">Question</th>
                                <th class="text-left py-4 px-4 text-sm font-semibold text-slate-300">Answer</th>
                                <th class="text-center py-4 px-4 text-sm font-semibold text-slate-300">Correct</th>
                                <th class="text-center py-4 px-4 text-sm font-semibold text-slate-300">Status</th>
                                <th class="text-left py-4 px-4 text-sm font-semibold text-slate-300">Verified By</th>
                                <th class="text-left py-4 px-4 text-sm font-semibold text-slate-300">Date</th>
                                <th class="text-center py-4 px-4 text-sm font-semibold text-slate-300">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($answers as $answer)
                                <tr class="border-b border-slate-700 hover:bg-slate-700 hover:bg-opacity-30 transition">
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 gradient-primary rounded-lg flex items-center justify-center text-white font-bold">
                                                {{ strtoupper(substr($answer->competitionParticipant->user->name, 0, 1)) }}
                                            </div>
                                            <span
                                                class="font-semibold text-white">{{ $answer->competitionParticipant->user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <span
                                            class="px-3 py-1 bg-cyan-500 bg-opacity-20 text-cyan-300 rounded-full text-xs font-semibold border border-cyan-500 border-opacity-30">
                                            {{ $answer->competitionParticipant->competition->title }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <span
                                            class="text-sm text-slate-300">{{ Str::limit($answer->question->question_text, 50) }}</span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <span
                                            class="text-sm text-slate-300">{{ Str::limit($answer->answer->answer_text, 30) }}</span>
                                    </td>
                                    <td class="py-4 px-4 text-center">
                                        @if ($answer->is_correct)
                                            <div
                                                class="inline-flex w-8 h-8 bg-green-500 bg-opacity-20 rounded-lg items-center justify-center">
                                                <i class="bi bi-check-circle-fill text-green-400"></i>
                                            </div>
                                        @else
                                            <div
                                                class="inline-flex w-8 h-8 bg-red-500 bg-opacity-20 rounded-lg items-center justify-center">
                                                <i class="bi bi-x-circle-fill text-red-400"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="py-4 px-4 text-center">
                                        @if ($answer->validation_status === 'pending')
                                            <span
                                                class="px-3 py-1 bg-yellow-500 bg-opacity-20 text-yellow-300 rounded-full text-xs font-semibold border border-yellow-500 border-opacity-30">Pending</span>
                                        @elseif ($answer->validation_status === 'approved')
                                            <span
                                                class="px-3 py-1 bg-green-500 bg-opacity-20 text-green-300 rounded-full text-xs font-semibold border border-green-500 border-opacity-30">Approved</span>
                                        @else
                                            <span
                                                class="px-3 py-1 bg-red-500 bg-opacity-20 text-red-300 rounded-full text-xs font-semibold border border-red-500 border-opacity-30">Rejected</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-4">
                                        <span
                                            class="text-sm text-slate-400">{{ $answer->verifier->name ?? '-' }}</span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <span
                                            class="text-sm text-slate-400">{{ $answer->answered_at ? $answer->answered_at->format('d M Y H:i') : '-' }}</span>
                                    </td>
                                    <td class="py-4 px-4 text-center">
                                        @if ($answer->validation_status === 'pending')
                                            <div class="flex items-center justify-center gap-2">
                                                <button wire:click="approveAnswer({{ $answer->id }})"
                                                    class="w-8 h-8 bg-green-500 bg-opacity-20 hover:bg-opacity-30 rounded-lg flex items-center justify-center text-green-400 hover:text-green-300 transition">
                                                    <i class="bi bi-check"></i>
                                                </button>
                                                <button wire:click="rejectAnswer({{ $answer->id }})"
                                                    class="w-8 h-8 bg-red-500 bg-opacity-20 hover:bg-opacity-30 rounded-lg flex items-center justify-center text-red-400 hover:text-red-300 transition">
                                                    <i class="bi bi-x"></i>
                                                </button>
                                            </div>
                                        @else
                                            <span
                                                class="px-3 py-1 bg-slate-700 text-slate-400 rounded-full text-xs font-semibold">Validated</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-6">
                    {{ $answers->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-slate-700 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="bi bi-inbox text-slate-400" style="font-size: 2.5rem;"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">No Answers Found</h3>
                    <p class="text-slate-400">Tidak ada jawaban yang ditemukan</p>
                </div>
            @endif
        </div>
    </div>
</div>
