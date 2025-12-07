<div><div>
    <div>
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.categories.index') }}"
                        class="p-3 bg-slate-800 border border-slate-700 text-white rounded-xl hover:bg-slate-700 transition">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <div>
                        <h1
                            class="text-3xl font-bold text-transparent bg-gradient-to-r from-indigo-400 to-pink-400 bg-clip-text">
                            Category Details
                        </h1>
                        <p class="text-slate-400">Detailed information about the category.</p>
                    </div>
                </div>
                <a href="{{ route('admin.categories.edit', $category) }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-yellow-500/20 text-yellow-400 border border-yellow-500/30 font-semibold rounded-xl hover:bg-yellow-500/30 transition-all">
                    <i class="bi bi-pencil-square"></i>
                    Edit
                </a>
            </div>
        </div>

        <!-- Main Card -->
        <div class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl overflow-hidden">
            <!-- Header -->
            <div class="gradient-primary p-6">
                <div class="flex items-center gap-3">
                    <i class="bi bi-folder-open text-3xl text-white"></i>
                    <div>
                        <h2 class="text-2xl font-bold text-white">{{ $category->name }}</h2>
                        <p class="text-white/70 text-sm">Category ID: #{{ $category->id }}</p>
                    </div>
                </div>
            </div>

            <!-- Body -->
            <div class="p-6 space-y-6">
                <!-- Description -->
                <div>
                    <div class="flex items-center gap-2 mb-3 pb-2 border-b border-slate-700">
                        <i class="bi bi-text-left text-indigo-400"></i>
                        <h3 class="text-lg font-semibold text-white">Description</h3>
                    </div>
                    <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4">
                        @if ($category->description)
                            <p class="text-slate-300 leading-relaxed">{{ $category->description }}</p>
                        @else
                            <p class="text-slate-500 italic">No description provided.</p>
                        @endif
                    </div>
                </div>

                <!-- Metadata -->
                <div>
                    <div class="flex items-center gap-2 mb-4 pb-2 border-b border-slate-700">
                        <i class="bi bi-info-circle text-indigo-400"></i>
                        <h3 class="text-lg font-semibold text-white">Metadata</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Created At -->
                        <div class="bg-green-500/10 border border-green-500/30 rounded-xl p-4">
                            <div class="flex items-center gap-3">
                                <div class="p-3 bg-green-500/20 rounded-lg">
                                    <i class="bi bi-calendar-plus-fill text-green-400 text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-400 mb-1">Created At</p>
                                    <p class="font-semibold text-white">{{ $category->created_at->format('M d, Y') }}
                                    </p>
                                    <p class="text-xs text-slate-400">{{ $category->created_at->format('H:i A') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Last Updated -->
                        <div class="bg-blue-500/10 border border-blue-500/30 rounded-xl p-4">
                            <div class="flex items-center gap-3">
                                <div class="p-3 bg-blue-500/20 rounded-lg">
                                    <i class="bi bi-calendar-check-fill text-blue-400 text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-400 mb-1">Last Updated</p>
                                    <p class="font-semibold text-white">{{ $category->updated_at->format('M d, Y') }}
                                    </p>
                                    <p class="text-xs text-slate-400">{{ $category->updated_at->format('H:i A') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Created Ago -->
                        <div class="bg-slate-500/10 border border-slate-500/30 rounded-xl p-4">
                            <div class="flex items-center gap-3">
                                <div class="p-3 bg-slate-500/20 rounded-lg">
                                    <i class="bi bi-clock-history text-slate-400 text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-400 mb-1">Created</p>
                                    <p class="font-semibold text-white">{{ $category->created_at->diffForHumans() }}</p>
                                    <p class="text-xs text-slate-400">Ago</p>
                                </div>
                            </div>
                        </div>

                        <!-- Updated Ago -->
                        <div class="bg-cyan-500/10 border border-cyan-500/30 rounded-xl p-4">
                            <div class="flex items-center gap-3">
                                <div class="p-3 bg-cyan-500/20 rounded-lg">
                                    <i class="bi bi-arrow-repeat text-cyan-400 text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-400 mb-1">Updated</p>
                                    <p class="font-semibold text-white">{{ $category->updated_at->diffForHumans() }}
                                    </p>
                                    <p class="text-xs text-slate-400">Ago</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Associated Questions -->
                @if (method_exists($category, 'questions'))
                    <div class="border-t border-slate-700 pt-6">
                        <div class="flex items-center gap-2 mb-4 pb-2 border-b border-slate-700">
                            <i class="bi bi-patch-question text-indigo-400"></i>
                            <h3 class="text-lg font-semibold text-white">Associated Questions</h3>
                        </div>
                        <div class="bg-indigo-500/10 border border-indigo-500/30 rounded-xl p-6">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-4xl font-bold text-indigo-400">{{ $category->questions->count() }}
                                    </p>
                                    <p class="text-slate-400 mt-2">Total Questions Linked to this Category</p>
                                </div>
                                <i class="bi bi-chat-square-text text-indigo-400/30 text-6xl"></i>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Footer -->
            <div class="p-6 border-t border-slate-700 flex justify-between">
                <a href="{{ route('admin.categories.index') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-slate-700 text-white font-semibold rounded-xl hover:bg-slate-600 transition-all">
                    <i class="bi bi-list"></i>
                    Back to List
                </a>
                <a href="{{ route('admin.categories.edit', $category) }}"
                    class="inline-flex items-center gap-2 px-6 py-3 gradient-primary text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-indigo-500/50 transition-all">
                    <i class="bi bi-pencil-square"></i>
                    Edit Category
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

    body.light-theme .bg-slate-800\/50 {
        background: #f8fafc !important;
    }
</style>
</div>