<div>
    <div>
        <div>
            <!-- Page Header -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1
                            class="text-3xl font-bold text-transparent bg-gradient-to-r from-indigo-400 to-pink-400 bg-clip-text mb-2">
                            Edit Competition
                        </h1>
                        <p class="text-slate-400">Update competition data by filling the form below.</p>
                    </div>
                    <a href="{{ route('admin.competitions.index') }}"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-slate-800 border border-slate-700 text-white font-semibold rounded-xl hover:bg-slate-700 transition-all w-full md:w-auto">
                        <i class="bi bi-arrow-left"></i>
                        Back to List
                    </a>
                </div>
            </div>
            <!-- Form Card -->
            <div
                class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl overflow-hidden">
                <!-- Card Header -->
                <div class="px-6 py-4 border-b border-slate-700">
                    <h3 class="text-xl font-bold text-white">Edit Competition Form</h3>
                </div>

                <!-- Card Body -->
                <div class="p-6">
                    <form id="updateForm" wire:submit.prevent="update" class="space-y-6">
                        <!-- Title -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">
                                Title <span class="text-red-400">*</span>
                            </label>
                            <input type="text" wire:model="title"
                                class="w-full px-4 py-3 bg-slate-900 border @error('title') border-red-500 @else border-slate-700 @enderror rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                            @error('title')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Description</label>
                            <textarea wire:model="description" rows="4"
                                class="w-full px-4 py-3 bg-slate-900 border @error('description') border-red-500 @else border-slate-700 @enderror rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"></textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Start & End Date -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Start Date -->
                            <div>
                                <label class="block text-sm font-semibold text-slate-300 mb-2">
                                    Start Date <span class="text-red-400">*</span>
                                </label>
                                <input type="datetime-local" wire:model="start_date"
                                    class="w-full px-4 py-3 bg-slate-900 border @error('start_date') border-red-500 @else border-slate-700 @enderror rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                @error('start_date')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- End Date -->
                            <div>
                                <label class="block text-sm font-semibold text-slate-300 mb-2">
                                    End Date <span class="text-red-400">*</span>
                                </label>
                                <input type="datetime-local" wire:model="end_date"
                                    class="w-full px-4 py-3 bg-slate-900 border @error('end_date') border-red-500 @else border-slate-700 @enderror rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                @error('end_date')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">
                                Status <span class="text-red-400">*</span>
                            </label>
                            <select wire:model="status"
                                class="w-full px-4 py-3 bg-slate-900 border @error('status') border-red-500 @else border-slate-700 @enderror rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                <option value="draft">Draft</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            @error('status')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="flex flex-col-reverse sm:flex-row justify-end gap-4 pt-6 border-t border-slate-700">
                            <a href="{{ route('admin.competitions.index') }}"
                                class="px-6 py-3 bg-slate-700 text-white font-semibold rounded-xl hover:bg-slate-600 transition-all text-center">
                                Cancel
                            </a>
                            <button type="button" onclick="confirmUpdate()"
                                class="inline-flex items-center justify-center gap-2 px-6 py-3 gradient-primary text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-indigo-500/50 transition-all">
                                <i class="bi bi-save"></i>
                                Update Competition
                            </button>
                        </div>
                    </form>

                    <script>
                        function confirmUpdate() {
                            Swal.fire({
                                title: 'Konfirmasi Perubahan',
                                text: "Apakah Anda yakin ingin memperbarui kompetisi ini?",
                                icon: 'question',
                                showCancelButton: true,
                                confirmButtonColor: '#6366f1',
                                cancelButtonColor: '#64748b',
                                confirmButtonText: 'Ya, perbarui!',
                                cancelButtonText: 'Batal',
                                background: '#1e293b',
                                color: '#e2e8f0',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    @this.call('update');
                                }
                            });
                        }
                    </script>
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

        body.light-theme .bg-slate-900,
        body.light-theme .bg-slate-800,
        body.light-theme .bg-slate-700 {
            background: #f8fafc !important;
        }

        body.light-theme input,
        body.light-theme select,
        body.light-theme textarea {
            background: white !important;
            color: #0f172a !important;
            border-color: #cbd5e1 !important;
        }
    </style>
</div>
