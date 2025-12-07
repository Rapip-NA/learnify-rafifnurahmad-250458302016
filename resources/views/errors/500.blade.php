<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Server Error | Learnify</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Light mode gradient colors */
        .gradient-primary {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        }

        .gradient-accent {
            background: linear-gradient(135deg, #db2777 0%, #dc2626 100%);
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes glow-pulse {

            0%,
            100% {
                box-shadow: 0 0 20px rgba(79, 70, 229, 0.3);
            }

            50% {
                box-shadow: 0 0 40px rgba(124, 58, 237, 0.5);
            }
        }

        @keyframes slide-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes spin-slow {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        @keyframes bounce-infinite {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-30px);
            }
        }

        .float {
            animation: float 3s ease-in-out infinite;
        }

        .glow-pulse {
            animation: glow-pulse 2s ease-in-out infinite;
        }

        .slide-in {
            animation: slide-in 0.6s ease-out forwards;
        }

        .spin-slow {
            animation: spin-slow 20s linear infinite;
        }

        .bounce-big {
            animation: bounce-infinite 2s ease-in-out infinite;
        }

        @keyframes blob {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
        }

        .blob {
            animation: blob 7s infinite;
            position: absolute;
            opacity: 0.08;
            filter: blur(40px);
            z-index: 0;
        }

        .btn-glow {
            position: relative;
            overflow: hidden;
        }

        .btn-glow::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.5s;
        }

        .btn-glow:hover::after {
            left: 100%;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .badge-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        .text-gradient-500 {
            background: linear-gradient(135deg, #dc2626 0%, #f97316 50%, #eab308 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .floating-element {
            animation: float 4s ease-in-out infinite;
            position: absolute;
        }

        .element-1 {
            animation-delay: 0s;
        }

        .element-2 {
            animation-delay: 0.5s;
        }

        .element-3 {
            animation-delay: 1s;
        }

        .element-4 {
            animation-delay: 1.5s;
        }

        .element-5 {
            animation-delay: 2s;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 via-white to-orange-50 overflow-x-hidden">
    <!-- Light mode animated background blobs -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="blob w-96 h-96 rounded-full bg-red-400" style="top: -100px; left: -100px;"></div>
        <div class="blob w-96 h-96 rounded-full bg-orange-400" style="top: 50%; right: -100px; animation-delay: 2s;">
        </div>
        <div class="blob w-80 h-80 rounded-full bg-yellow-400" style="bottom: 0; left: 50%; animation-delay: 4s;"></div>
    </div>

    <!-- Navigation Bar -->
    <nav class="fixed top-0 w-full bg-white bg-opacity-90 backdrop-blur-md shadow-md z-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center gap-2 relative z-10">
                    <div class="w-8 h-8 gradient-primary rounded-lg flex items-center justify-center glow-pulse">
                        <span class="text-white font-bold text-lg">L</span>
                    </div>
                    <span
                        class="font-bold text-xl text-transparent bg-gradient-to-r from-indigo-600 to-pink-600 bg-clip-text">Learnify</span>
                </div>

                <!-- Back Button -->
                <button onclick="window.history.back()"
                    class="gradient-primary text-white px-6 py-2 rounded-full font-semibold btn-glow hover:shadow-lg transition shadow-md relative z-10">
                    ← Kembali
                </button>
            </div>
        </div>
    </nav>

    <!-- 500 Content -->
    <section class="min-h-screen flex items-center justify-center pt-20 pb-20 px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-4xl w-full">
            <!-- Main Content -->
            <div class="text-center space-y-8 slide-in">
                <!-- 500 Error Code Display with gradient and animation -->
                <div class="relative inline-block w-full">
                    <h1 class="text-9xl md:text-[200px] font-black text-gradient-500 leading-none drop-shadow-lg">
                        500
                    </h1>
                    <div class="absolute inset-0 blur-3xl opacity-30 bg-gradient-to-r from-red-500 to-orange-500 rounded-full"
                        style="top: -50px; left: 50%; transform: translateX(-50%);"></div>
                </div>

                <!-- Floating emojis around 500 -->
                <div class="relative h-20 mx-auto">
                    <div class="floating-element element-1 text-6xl" style="left: 10%;">⚠️</div>
                    <div class="floating-element element-2 text-5xl" style="right: 15%;">🔧</div>
                    <div class="floating-element element-3 text-6xl" style="left: 5%; top: 0;">💥</div>
                    <div class="floating-element element-4 text-5xl" style="right: 5%; top: 10px;">🛠️</div>
                </div>

                <!-- Error Message -->
                <div class="space-y-4 slide-in" style="animation-delay: 0.1s;">
                    <h2 class="text-4xl md:text-5xl font-black text-slate-900">
                        Server Mengalami Masalah
                    </h2>
                    <p class="text-xl text-slate-600 max-w-2xl mx-auto leading-relaxed">
                        Ups! Terjadi kesalahan pada server kami. Tim teknis kami sedang bekerja keras untuk
                        memperbaikinya. Silakan coba lagi beberapa saat lagi.
                    </p>
                </div>

                <!-- Illustration Box -->
                <div class="relative h-64 md:h-80 mx-auto max-w-lg slide-in" style="animation-delay: 0.2s;">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-red-500 to-orange-500 opacity-10 rounded-3xl blur-2xl">
                    </div>
                    <div
                        class="relative bg-gradient-to-br from-orange-100 to-yellow-100 rounded-3xl h-full flex flex-col items-center justify-center overflow-hidden border-2 border-orange-200">
                        <div class="text-center space-y-4">
                            <div class="text-8xl bounce-big">⚙️</div>
                            <div class="space-y-2">
                                <p class="text-slate-700 font-bold">Sedang Diperbaiki!</p>
                                <p class="text-slate-600 text-sm">Kami sedang menangani masalah ini</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center slide-in" style="animation-delay: 0.3s;">
                    <a href="/"
                        class="gradient-primary text-white px-8 py-4 rounded-full font-bold text-lg btn-glow hover:shadow-lg transition shadow-md inline-block">
                        🏠 Kembali ke Beranda
                    </a>
                    <button onclick="location.reload()"
                        class="border-2 border-orange-600 text-orange-600 px-8 py-4 rounded-full font-bold text-lg hover:bg-orange-600 hover:text-white transition backdrop-blur-sm inline-block">
                        🔄 Coba Lagi
                    </button>
                </div>

                <!-- Helpful Links -->
                <div class="space-y-6 pt-12 slide-in" style="animation-delay: 0.4s;">
                    <p class="text-slate-600 font-semibold">Hal lain yang bisa Anda lakukan:</p>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <!-- Light mode cards -->
                        <a href="#"
                            class="group bg-white border-2 border-indigo-200 rounded-2xl p-6 hover:border-indigo-400 hover:shadow-lg transition backdrop-blur-sm">
                            <div class="text-4xl mb-3 group-hover:scale-110 transition inline-block">🎪</div>
                            <h3 class="font-bold text-slate-900 group-hover:text-indigo-600 transition">Jelajahi
                                Kompetisi</h3>
                            <p class="text-sm text-slate-600 mt-2">Temukan kompetisi yang sesuai dengan minatmu</p>
                        </a>

                        <a href="#"
                            class="group bg-white border-2 border-pink-200 rounded-2xl p-6 hover:border-pink-400 hover:shadow-lg transition backdrop-blur-sm">
                            <div class="text-4xl mb-3 group-hover:scale-110 transition inline-block">💬</div>
                            <h3 class="font-bold text-slate-900 group-hover:text-pink-600 transition">Hubungi Kami</h3>
                            <p class="text-sm text-slate-600 mt-2">Tim support kami siap membantu Anda</p>
                        </a>

                        <a href="#"
                            class="group bg-white border-2 border-cyan-200 rounded-2xl p-6 hover:border-cyan-400 hover:shadow-lg transition backdrop-blur-sm">
                            <div class="text-4xl mb-3 group-hover:scale-110 transition inline-block">❓</div>
                            <h3 class="font-bold text-slate-900 group-hover:text-cyan-600 transition">FAQ</h3>
                            <p class="text-sm text-slate-600 mt-2">Temukan jawaban atas pertanyaan umum</p>
                        </a>
                    </div>
                </div>

                <!-- Code Block for Developers -->
                <div class="pt-12 slide-in" style="animation-delay: 0.5s;">
                    <div
                        class="bg-white border-2 border-slate-200 rounded-2xl p-6 max-w-2xl mx-auto backdrop-blur-sm text-left">
                        <p class="text-sm font-bold text-slate-600 mb-3 uppercase tracking-wider">Error Code:</p>
                        <div class="bg-slate-50 rounded-lg p-4 font-mono text-sm text-slate-900 overflow-x-auto">
                            <span class="text-red-600">Error:</span> HTTP <span class="text-yellow-600">500</span> -
                            <span class="text-slate-700">Internal Server Error</span><br>
                            <span class="text-slate-500">Endpoint: {window.location.href}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="relative z-10 bg-white border-t border-slate-200 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid md:grid-cols-4 gap-8">
                <!-- Brand -->
                <div class="space-y-4">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 gradient-primary rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold">L</span>
                        </div>
                        <span
                            class="font-bold text-xl text-transparent bg-gradient-to-r from-indigo-600 to-pink-600 bg-clip-text">Learnify</span>
                    </div>
                    <p class="text-slate-600 text-sm">Platform kompetisi pembelajaran terpercaya di Indonesia</p>
                </div>

                <!-- Links -->
                <div class="space-y-3">
                    <h4 class="font-bold text-slate-900">Navigasi</h4>
                    <ul class="space-y-2 text-sm text-slate-600">
                        <li><a href="#" class="hover:text-indigo-600 transition">Beranda</a></li>
                        <li><a href="#" class="hover:text-indigo-600 transition">Kompetisi</a></li>
                        <li><a href="#" class="hover:text-indigo-600 transition">Tentang Kami</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div class="space-y-3">
                    <h4 class="font-bold text-slate-900">Dukungan</h4>
                    <ul class="space-y-2 text-sm text-slate-600">
                        <li><a href="#" class="hover:text-indigo-600 transition">FAQ</a></li>
                        <li><a href="#" class="hover:text-indigo-600 transition">Kontak</a></li>
                        <li><a href="#" class="hover:text-indigo-600 transition">Hubungi Kami</a></li>
                    </ul>
                </div>

                <!-- Legal -->
                <div class="space-y-3">
                    <h4 class="font-bold text-slate-900">Legal</h4>
                    <ul class="space-y-2 text-sm text-slate-600">
                        <li><a href="#" class="hover:text-indigo-600 transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-indigo-600 transition">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-indigo-600 transition">Disclaimer</a></li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-slate-200 mt-12 pt-8 text-center">
                <p class="text-slate-600 text-sm">
                    © 2025 Learnify. Semua hak dilindungi. Dibuat dengan 💜 untuk pelajar Indonesia.
                </p>
            </div>
        </div>
    </footer>
</body>

</html>
