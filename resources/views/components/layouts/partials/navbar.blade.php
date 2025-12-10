<!-- Navbar -->
<nav class="sticky top-0 z-30 bg-slate-900/80 backdrop-blur-md border-b border-slate-700 px-6 py-4">
    <div class="flex items-center justify-between">
        <!-- Mobile Menu Button -->
        <button onclick="toggleSidebar(event)" class="lg:hidden text-slate-400 hover:text-white transition">
            <i class="bi bi-list text-2xl"></i>
        </button>

        <!-- Page Title (optional) -->
        <div class="hidden lg:block">
            <h1 class="text-xl font-bold text-transparent bg-gradient-to-r from-indigo-400 to-pink-400 bg-clip-text">
                Dashboard
            </h1>
        </div>

        <!-- Right Side Actions -->
        <div class="flex items-center gap-4 ml-auto">
            <!-- Search (optional) -->
            {{-- <button class="text-slate-400 hover:text-white transition">
                <i class="bi bi-search text-xl"></i>
            </button> --}}

            <!-- Notifications (optional) -->
            {{-- <button class="text-slate-400 hover:text-white transition relative">
                <i class="bi bi-bell text-xl"></i>
                <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
            </button> --}}

            <!-- User Dropdown -->
            <div class="relative group">
                <button
                    class="flex items-center gap-3 px-4 py-2 rounded-xl bg-slate-800/50 hover:bg-slate-800 transition-all">
                    <div
                        class="w-8 h-8 rounded-full gradient-accent flex items-center justify-center text-white font-bold text-sm">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="hidden md:block text-left">
                        <p class="text-sm font-semibold text-white">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-400">{{ ucfirst(Auth::user()->role) }}</p>
                    </div>
                    <i class="bi bi-chevron-down text-slate-400 text-xs"></i>
                </button>

                <!-- Dropdown Menu -->
                <div
                    class="absolute right-0 mt-2 w-56 bg-slate-800 rounded-xl shadow-xl border border-slate-700 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 overflow-hidden">
                    <div class="p-4 border-b border-slate-700">
                        <p class="text-sm font-semibold text-white">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-400">{{ Auth::user()->email }}</p>
                    </div>

                    <div class="py-2">
                        <a href="{{ route('profile') }}"
                            class="flex items-center gap-3 px-4 py-2 text-slate-300 hover:bg-slate-700/50 hover:text-white transition">
                            <i class="bi bi-person"></i>
                            <span class="text-sm">My Profile</span>
                        </a>
                        <a href="#"
                            class="flex items-center gap-3 px-4 py-2 text-slate-300 hover:bg-slate-700/50 hover:text-white transition">
                            <i class="bi bi-gear"></i>
                            <span class="text-sm">Settings</span>
                        </a>
                    </div>

                    <div class="border-t border-slate-700 py-2">
                        <button onclick="confirmLogout()"
                            class="w-full flex items-center gap-3 px-4 py-2 text-red-400 hover:bg-red-500/10 hover:text-red-300 transition">
                            <i class="bi bi-box-arrow-left"></i>
                            <span class="text-sm">Logout</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Logout Confirmation Script -->
<script>
    function confirmLogout() {
        Swal.fire({
            title: 'Konfirmasi Logout',
            text: 'Apakah Anda yakin ingin keluar dari sistem?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal',
            background: '#1e293b',
            color: '#e2e8f0',
        }).then((result) => {
            if (result.isConfirmed) {
                // Create and submit logout form
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route('logout') }}';

                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';

                form.appendChild(csrfToken);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>

<style>
    /* Light theme for navbar */
    body.light-theme nav {
        background-color: rgba(255, 255, 255, 0.9) !important;
        border-bottom-color: #e2e8f0 !important;
    }

    body.light-theme nav .bg-slate-800\/50 {
        background-color: rgba(241, 245, 249, 0.8) !important;
    }

    body.light-theme nav .bg-slate-800:hover {
        background-color: #f1f5f9 !important;
    }

    body.light-theme nav .text-slate-400 {
        color: #64748b !important;
    }

    body.light-theme nav .text-slate-300 {
        color: #64748b !important;
    }

    body.light-theme nav .text-white {
        color: #0f172a !important;
    }

    body.light-theme nav .bg-slate-800 {
        background-color: white !important;
        border: 1px solid #e2e8f0 !important;
    }

    body.light-theme nav .border-slate-700 {
        border-color: #e2e8f0 !important;
    }

    body.light-theme nav .hover\:bg-slate-700\/50:hover {
        background-color: rgba(241, 245, 249, 0.5) !important;
    }

    body.light-theme nav a:hover .text-slate-300 {
        color: #0f172a !important;
    }
</style>
