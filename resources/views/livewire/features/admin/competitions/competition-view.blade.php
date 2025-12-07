<div>
    <div>
    <div>
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1
                        class="text-3xl font-bold text-transparent bg-gradient-to-r from-indigo-400 to-pink-400 bg-clip-text mb-2">
                        Competition Details
                    </h1>
                    <p class="text-slate-400">View detailed information about this competition.</p>
                </div>
                <a href="{{ route('admin.competitions.index') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-slate-800 border border-slate-700 text-white font-semibold rounded-xl hover:bg-slate-700 transition-all">
                    <i class="bi bi-arrow-left"></i>
                    Back to List
                </a>
            </div>
        </div>

        <!-- Main Card -->
        <div class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl overflow-hidden">
            <!-- Card Header -->
            <div class="gradient-primary p-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-white">{{ $competition->title }}</h2>
                    @if ($competition->status === 'draft')
                        <span
                            class="px-4 py-2 rounded-full text-sm font-semibold bg-gray-500/30 text-gray-200 border border-gray-400/30">Draft</span>
                    @elseif($competition->status === 'active')
                        <span
                            class="px-4 py-2 rounded-full text-sm font-semibold bg-green-500/30 text-green-200 border border-green-400/30">Active</span>
                    @else
                        <span
                            class="px-4 py-2 rounded-full text-sm font-semibold bg-red-500/30 text-red-200 border border-red-400/30">Inactive</span>
                    @endif
                </div>
            </div>

            <!-- Card Body -->
            <div class="p-6">
                <!-- Date & Time Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Start Date -->
                    <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4">
                        <h6 class="text-slate-400 text-sm font-semibold mb-2">Start Date & Time</h6>
                        <p class="text-white text-lg font-semibold">{{ $competition->start_date->format('F d, Y') }}</p>
                        <p class="text-slate-400 text-sm">{{ $competition->start_date->format('h:i A') }}</p>
                    </div>

                    <!-- End Date -->
                    <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4">
                        <h6 class="text-slate-400 text-sm font-semibold mb-2">End Date & Time</h6>
                        <p class="text-white text-lg font-semibold">{{ $competition->end_date->format('F d, Y') }}</p>
                        <p class="text-slate-400 text-sm">{{ $competition->end_date->format('h:i A') }}</p>
                    </div>

                    <!-- Creator -->
                    <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4">
                        <h6 class="text-slate-400 text-sm font-semibold mb-2">Created By</h6>
                        <p class="text-white text-lg font-semibold">{{ $competition->creator->name ?? 'Unknown' }}</p>
                        <p class="text-slate-400 text-sm">{{ $competition->creator->email ?? 'N/A' }}</p>
                    </div>

                    <!-- Duration -->
                    <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4">
                        <h6 class="text-slate-400 text-sm font-semibold mb-2">Duration</h6>
                        <p class="text-white text-lg font-semibold">
                            {{ abs($competition->start_date->diffInDays($competition->end_date)) }} days
                        </p>
                    </div>
                </div>

                <!-- Description -->
                @if ($competition->description)
                    <div class="mb-6">
                        <h6 class="text-slate-400 text-sm font-semibold mb-3">Description</h6>
                        <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4">
                            <p class="text-slate-300 leading-relaxed">{{ $competition->description }}</p>
                        </div>
                    </div>
                @endif

                <!-- Metadata -->
                <div class="pt-6 border-t border-slate-700">
                    <h6 class="text-slate-400 text-sm font-semibold mb-4">Metadata</h6>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-slate-400">Created:</span>
                            <span class="text-white font-semibold ml-2">
                                {{ $competition->created_at->format('M d, Y h:i A') }}
                            </span>
                        </div>
                        <div>
                            <span class="text-slate-400">Last Updated:</span>
                            <span class="text-white font-semibold ml-2">
                                {{ $competition->updated_at->format('M d, Y h:i A') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Footer -->
            <div class="p-6 border-t border-slate-700 flex justify-end">
                <a href="{{ route('admin.competitions.edit', $competition) }}"
                    class="inline-flex items-center gap-2 px-6 py-3 gradient-primary text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-indigo-500/50 transition-all">
                    <i class="bi bi-pencil-square"></i>
                    Edit Competition
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    /* Light theme adjustments */
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

    body.light-theme .bg-slate-800 {
        background: #f8fafc !important;
    }

    body.light-theme .bg-slate-800\/50 {
        background: #f8fafc !important;
    }
</style>

</div>