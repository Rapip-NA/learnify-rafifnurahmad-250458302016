<div><div>
    <div>
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center gap-4 mb-6">
                <a href="{{ route('admin.categories.index') }}"
                    class="p-3 bg-slate-800 border border-slate-700 text-white rounded-xl hover:bg-slate-700 transition">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <div>
                    <h1
                        class="text-3xl font-bold text-transparent bg-gradient-to-r from-indigo-400 to-pink-400 bg-clip-text">
                        Create New Category
                    </h1>
                    <p class="text-slate-400">Fill in the form below to create a new category.</p>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-6">
            <h3 class="text-xl font-bold text-white mb-6">Category Details</h3>

            <form wire:submit.prevent="save" class="space-y-6">
                <!-- Name -->
                <div>
                    <label class="block text-sm font-semibold text-slate-300 mb-2">
                        Category Name <span class="text-red-400">*</span>
                    </label>
                    <input type="text" wire:model="name"
                        class="w-full px-4 py-3 bg-slate-900 border @error('name') border-red-500 @else border-slate-700 @enderror rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                        placeholder="Enter category name">
                    @error('name')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-semibold text-slate-300 mb-2">Description</label>
                    <textarea wire:model="description" rows="5"
                        class="w-full px-4 py-3 bg-slate-900 border @error('description') border-red-500 @else border-slate-700 @enderror rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                        placeholder="Enter category description"></textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-4 pt-6 border-t border-slate-700">
                    <a href="{{ route('admin.categories.index') }}"
                        class="px-6 py-3 bg-slate-700 text-white font-semibold rounded-xl hover:bg-slate-600 transition-all">
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-3 gradient-primary text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-indigo-500/50 transition-all">
                        <i class="bi bi-save"></i>
                        Save Category
                    </button>
                </div>
            </form>
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

    body.light-theme .bg-slate-900,
    body.light-theme .bg-slate-800,
    body.light-theme .bg-slate-700 {
        background: #f8fafc !important;
    }

    body.light-theme input,
    body.light-theme textarea {
        background: white !important;
        color: #0f172a !important;
        border-color: #cbd5e1 !important;
    }
</style>
</div>