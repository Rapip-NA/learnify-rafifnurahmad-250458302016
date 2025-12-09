<div class="space-y-8">
    <!-- Page Header -->
    <div class="space-y-4">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1
                    class="text-4xl md:text-5xl font-black text-transparent bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 bg-clip-text">
                    Qualifier Dashboard
                </h1>
                <p class="text-lg text-slate-400 mt-2">Manage and monitor qualifier activities</p>
            </div>

            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-sm">
                <a href="{{ route('qualifier.dashboard') }}" class="text-slate-400 hover:text-white transition">
                    Dashboard
                </a>
                <span class="text-slate-600">/</span>
                <span class="text-white font-medium">Qualifier Dashboard</span>
            </nav>
        </div>
    </div>

    <!-- Welcome Section -->
    <div class="grid md:grid-cols-2 gap-6">
        <!-- Welcome Card -->
        <div
            class="relative overflow-hidden bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-8 space-y-4 group hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
            <!-- Decorative glow effect -->
            <div
                class="absolute top-0 right-0 w-40 h-40 bg-indigo-500 opacity-0 group-hover:opacity-10 rounded-full blur-3xl transition-all duration-500">
            </div>

            <!-- Icon -->
            <div
                class="w-16 h-16 gradient-primary rounded-xl flex items-center justify-center text-3xl glow-pulse relative z-10">
                👋
            </div>

            <!-- Content -->
            <div class="relative z-10">
                <h2 class="text-2xl font-black text-white mb-2">Welcome, Qualifier!</h2>
                <p class="text-slate-300 leading-relaxed">
                    Welcome to your dashboard. Here you can manage your tasks, review submissions, and monitor
                    participant activities efficiently.
                </p>
            </div>
        </div>

        <!-- Quick Info Card -->
        <div
            class="relative overflow-hidden bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-8 space-y-4 group hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
            <!-- Decorative glow effect -->
            <div
                class="absolute top-0 right-0 w-40 h-40 bg-pink-500 opacity-0 group-hover:opacity-10 rounded-full blur-3xl transition-all duration-500">
            </div>

            <!-- Icon -->
            <div
                class="w-16 h-16 gradient-accent rounded-xl flex items-center justify-center text-3xl glow-pulse relative z-10">
                ℹ️
            </div>

            <!-- Content -->
            <div class="relative z-10">
                <h2 class="text-2xl font-black text-white mb-2">Getting Started</h2>
                <p class="text-slate-300 leading-relaxed">
                    Use the navigation menu on the left to access different qualifier tools and features. Start by
                    checking pending validations.
                </p>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-6">
        <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
            <span class="text-2xl">⚡</span>
            Quick Actions
        </h3>
        <div class="grid md:grid-cols-3 gap-4">
            <!-- Action Card 1 -->
            <a href="{{ route('qualifier.answer-validation') }}"
                class="group relative overflow-hidden bg-slate-800 bg-opacity-50 border border-slate-700 rounded-xl p-4 hover:border-indigo-500 transition-all hover:shadow-lg">
                <div class="flex items-center gap-3">
                    <div
                        class="w-12 h-12 bg-indigo-500 bg-opacity-20 rounded-lg flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                        ✅
                    </div>
                    <div>
                        <h4 class="font-bold text-white">Answer Validation</h4>
                        <p class="text-sm text-slate-400">Review submissions</p>
                    </div>
                </div>
            </a>

            <!-- Action Card 2 -->
            <div
                class="group relative overflow-hidden bg-slate-800 bg-opacity-50 border border-slate-700 rounded-xl p-4 hover:border-pink-500 transition-all cursor-pointer hover:shadow-lg">
                <div class="flex items-center gap-3">
                    <div
                        class="w-12 h-12 bg-pink-500 bg-opacity-20 rounded-lg flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                        📊
                    </div>
                    <div>
                        <h4 class="font-bold text-white">Reports</h4>
                        <p class="text-sm text-slate-400">View statistics</p>
                    </div>
                </div>
            </div>

            <!-- Action Card 3 -->
            <div
                class="group relative overflow-hidden bg-slate-800 bg-opacity-50 border border-slate-700 rounded-xl p-4 hover:border-cyan-500 transition-all cursor-pointer hover:shadow-lg">
                <div class="flex items-center gap-3">
                    <div
                        class="w-12 h-12 bg-cyan-500 bg-opacity-20 rounded-lg flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                        ⚙️
                    </div>
                    <div>
                        <h4 class="font-bold text-white">Settings</h4>
                        <p class="text-sm text-slate-400">Manage preferences</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
