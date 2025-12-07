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
                        Edit Category
                    </h1>
                    <p class="text-slate-400">Update the category information below.</p>
                </div>
            </div>
        </div>

        <!-- Alerts -->
        @if (session()->has('success'))
            <div class="mb-6 p-4 bg-green-500/10 border border-green-500/30 rounded-xl flex items-center gap-3">
                <i class="bi bi-check-circle text-green-400 text-xl"></i>
                <span class="text-green-400">{{ session('success') }}</span>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/30 rounded-xl flex items-center gap-3">
                <i class="bi bi-exclamation-triangle text-red-400 text-xl"></i>
                <span class="text-red-400">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Form Card -->
        <div class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-6">
            <h3 class="text-xl font-bold text-white mb-6">Category Details</h3>

            <form wire:submit.prevent="update" class="space-y-6">
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

                <!-- Category Information -->
                <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4">
                    <h4 class="text-sm font-semibold text-slate-300 mb-3">Category Information</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-slate-400">Created At:</span>
                            <span
                                class="text-white font-semibold ml-2">{{ $category->created_at->format('M d, Y H:i') }}</span>
                        </div>
                        <div>
                            <span class="text-slate-400">Updated At:</span>
                            <span
                                class="text-white font-semibold ml-2">{{ $category->updated_at->format('M d, Y H:i') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-4 pt-6 border-t border-slate-700">
                    <a href="{{ route('admin.categories.index') }}"
                        class="px-6 py-3 bg-slate-700 text-white font-semibold rounded-xl hover:bg-slate-600 transition-all">
                        Cancel
                    </a>
                    <button type="button" onclick="confirmUpdate()"
                        class="inline-flex items-center gap-2 px-6 py-3 gradient-primary text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-indigo-500/50 transition-all">
                        <i class="bi bi-save"></i>
                        Update Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function confirmUpdate() {
        Swal.fire({
            title: 'Simpan Perubahan?',
            text: "Apakah Anda yakin ingin memperbarui data kategori ini?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#6366f1',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Simpan!',
            cancelButtonText: 'Batal',
            background: '#1e293b',
            color: '#e2e8f0',
        }).then((result) => {
            if (result.isConfirmed) {
                @this.call('update');
            }
        });
    }

    window.addEventListener('category-updated', event => {
        Swal.fire({
            title: 'Berhasil!',
            text: 'Kategori berhasil diperbarui.',
            icon: 'success',
            timer: 2000,
            showConfirmButton: false,
            background: '#1e293b',
            color: '#e2e8f0',
        }).then(() => {
            window.location.href = "{{ route('admin.categories.index') }}";
        });
    });
</script>

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

    body.light-theme .bg-slate-800\/50 {
        background: #f8fafc !important;
    }
</style>
</div>