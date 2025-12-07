<div class="flex justify-center items-center min-h-[calc(100vh-200px)]">
    <div class="w-full max-w-md slide-in">
        <div class="auth-card backdrop-blur-xl rounded-3xl shadow-2xl border p-8 sm:p-10 relative overflow-hidden">
            <!-- Decorative gradient top -->
            <div class="absolute top-0 left-0 w-full h-2 gradient-primary"></div>

            <div class="text-center mb-10">
                <h1 class="text-3xl font-bold text-secondary mb-2">Selamat Datang! 👋</h1>
                <p class="text-muted">Masuk untuk melanjutkan pembelajaran Anda.</p>
            </div>

            <form wire:submit.prevent="login" class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-medium form-label mb-2">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 icon-color" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                </path>
                            </svg>
                        </div>
                        <input wire:model="email" type="email" id="email"
                            class="form-input w-full pl-11 pr-4 py-3 border rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors outline-none @error('email') border-red-500 ring-red-500 @enderror"
                            placeholder="nama@email.com">
                    </div>
                    @error('email')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-sm font-medium form-label">Password</label>
                        <a href="#"
                            class="text-sm font-medium text-indigo-400 hover:text-indigo-300 transition-colors">Lupa
                            Password?</a>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 icon-color" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </div>
                        <input wire:model="password" type="password" id="password"
                            class="form-input w-full pl-11 pr-4 py-3 border rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors outline-none @error('password') border-red-500 ring-red-500 @enderror"
                            placeholder="••••••••">
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <input wire:model="remember" id="remember-me" type="checkbox"
                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="remember-me" class="ml-2 block text-sm text-muted">
                        Ingat saya
                    </label>
                </div>

                <button type="submit"
                    class="w-full btn-gradient text-white font-bold py-3.5 rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">
                    Masuk Sekarang
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-muted">Belum punya akun?
                    <a href="{{ route('register') }}"
                        class="font-bold text-indigo-400 hover:text-indigo-300 transition-colors">Daftar Gratis</a>
                </p>
            </div>
        </div>
    </div>
</div>
