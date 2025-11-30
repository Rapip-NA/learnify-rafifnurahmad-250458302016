<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnify - Platform Belajar Online Terbaik</title>
    <meta name="description"
        content="Learnify adalah platform pembelajaran online yang membantu Anda menguasai keterampilan baru dengan kursus berkualitas dari para ahli.">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Sora:wght@400;600;700&display=swap"
        rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Sora', 'Inter', 'sans-serif'],
                        display: ['Sora', 'sans-serif'],
                    },
                    colors: {
                        primary: '#6366f1',
                        'primary-light': '#818cf8',
                        secondary: '#0f172a',
                        accent: '#06b6d4',
                        'accent-light': '#22d3ee',
                        success: '#10b981',
                        muted: '#64748b',
                        background: '#ffffff',
                        'background-alt': '#f8fafc',
                        foreground: '#0f172a',
                    },
                    backgroundImage: {
                        'gradient-primary': 'linear-gradient(135deg, #6366f1 0%, #a855f7 100%)',
                        'gradient-accent': 'linear-gradient(135deg, #06b6d4 0%, #0891b2 100%)',
                        'gradient-dark': 'linear-gradient(135deg, #0f172a 0%, #1e293b 100%)',
                        'gradient-light': 'linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%)',
                    },
                    keyframes: {
                        'float': {
                            '0%, 100%': {
                                transform: 'translateY(0px)'
                            },
                            '50%': {
                                transform: 'translateY(-20px)'
                            },
                        },
                        'pulse-glow': {
                            '0%, 100%': {
                                boxShadow: '0 0 20px rgba(99, 102, 241, 0.5)'
                            },
                            '50%': {
                                boxShadow: '0 0 40px rgba(99, 102, 241, 0.8)'
                            },
                        },
                        'slide-in': {
                            '0%': {
                                transform: 'translateY(30px)',
                                opacity: '0'
                            },
                            '100%': {
                                transform: 'translateY(0)',
                                opacity: '1'
                            },
                        },
                    },
                    animation: {
                        'float': 'float 3s ease-in-out infinite',
                        'pulse-glow': 'pulse-glow 2s ease-in-out infinite',
                        'slide-in': 'slide-in 0.6s ease-out',
                    },
                }
            }
        }
    </script>
    <style>
        html {
            scroll-behavior: smooth;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Custom animations and effects */
        .hero-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(40px);
            opacity: 0.4;
        }

        .blob-1 {
            width: 600px;
            height: 600px;
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            top: -200px;
            right: -100px;
            animation: float 8s ease-in-out infinite;
        }

        .blob-2 {
            width: 500px;
            height: 500px;
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            bottom: -150px;
            left: -100px;
            animation: float 10s ease-in-out infinite 1s;
        }

        .text-gradient {
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .text-gradient-cyan {
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(99, 102, 241, 0.15);
        }

        .btn-gradient {
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            transition: all 0.3s ease;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.3);
        }

        .btn-outline:hover {
            background: rgba(99, 102, 241, 0.1);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(168, 85, 247, 0.1) 100%);
            transition: all 0.3s ease;
        }

        .card-hover:hover .feature-icon {
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            color: white;
            transform: scale(1.1);
        }

        .gradient-border {
            position: relative;
            background: white;
            border: 1px solid transparent;
            background-clip: padding-box;
        }

        .gradient-border::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            border-radius: 16px;
            padding: 1px;
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gradient-border:hover::before {
            opacity: 1;
        }

        @media (max-width: 768px) {

            .blob-1,
            .blob-2 {
                display: none;
            }
        }
    </style>
</head>

<body class="font-sans text-foreground bg-background">

    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 bg-white/80 backdrop-blur-xl z-50 border-b border-gray-100/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-20">
                <!-- Logo -->
                <a href="#" class="flex items-center gap-3 group">
                    <div
                        class="w-10 h-10 bg-gradient-primary rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-primary bg-clip-text text-transparent">Learnify</span>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center gap-12">
                    <a href="#features"
                        class="text-muted hover:text-primary transition-colors font-medium text-sm">Fitur</a>
                    <a href="#courses"
                        class="text-muted hover:text-primary transition-colors font-medium text-sm">Kursus</a>
                    <a href="#testimonials"
                        class="text-muted hover:text-primary transition-colors font-medium text-sm">Testimoni</a>
                </div>

                <!-- CTA Buttons -->
                <div class="hidden md:flex items-center gap-4">
                    <a href="{{ route('login') }}"
                        class="text-secondary font-semibold hover:text-primary transition-colors text-sm">Masuk</a>
                    <a href="{{ route('register') }}"
                        class="btn-gradient text-white px-6 py-2.5 rounded-full font-semibold text-sm">Daftar Gratis</a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden hidden bg-white border-t border-gray-100">
            <div class="px-4 py-4 space-y-3">
                <a href="#features"
                    class="block text-muted hover:text-primary transition-colors font-medium py-2">Fitur</a>
                <a href="#courses"
                    class="block text-muted hover:text-primary transition-colors font-medium py-2">Kursus</a>
                <a href="#pricing"
                    class="block text-muted hover:text-primary transition-colors font-medium py-2">Harga</a>
                <a href="#testimonials"
                    class="block text-muted hover:text-primary transition-colors font-medium py-2">Testimoni</a>
                <div class="pt-4 border-t border-gray-100 space-y-3">
                    <a href="{{ route('login') }}" class="block text-secondary font-medium py-2">Masuk</a>
                    <a href="{{ route('register') }}"
                        class="block btn-gradient text-white px-5 py-2.5 rounded-full font-medium text-center">Daftar
                        Gratis</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section
        class="relative min-h-screen flex items-center pt-24 lg:pt-32 pb-16 lg:pb-24 overflow-hidden bg-gradient-to-b from-gray-50 to-white">
        <!-- Animated Blobs -->
        <div class="hero-blob blob-1"></div>
        <div class="hero-blob blob-2"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="flex flex-col justify-center animate-slide-in">


                    <!-- Main Heading -->
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold leading-tight mb-6">
                        Evaluasi
                        <span class="text-gradient"> Lebih Cerdas,</span>
                        <br />
                        Raih Hasil Terbaik
                    </h1>

                    <!-- Subheading -->
                    <p class="text-lg sm:text-xl text-muted leading-relaxed mb-8 max-w-xl">
                        Platform evaluasi online yang menyediakan berbagai alat penilaian modern untuk mengukur
                        kompetensi secara akurat. Mulai tingkatkan kualitas evaluasi Anda hari ini.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 mb-12">
                        <a href="#"
                            class="btn-gradient text-white px-8 py-4 rounded-full font-bold text-lg inline-flex items-center justify-center gap-2 group">
                            <span>Mulai Evaluasi Gratis</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="flex flex-wrap gap-8">
                        <div>
                            <p class="text-4xl font-bold text-gradient">50K+</p>
                            <p class="text-muted font-medium">Peserta Aktif</p>
                        </div>
                        <div>
                            <p class="text-4xl font-bold text-gradient">500+</p>
                            <p class="text-muted font-medium">Evaluasi</p>
                        </div>
                    </div>
                </div>

                <!-- Right - Illustration/Image -->
                <div class="hidden lg:flex justify-center animate-slide-in" style="animation-delay: 0.2s;">
                    <div class="relative w-full max-w-md">
                        <!-- Card with gradient border -->
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-primary rounded-3xl opacity-20 blur-2xl"></div>
                            <div
                                class="relative bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100 p-6">
                                <div class="space-y-4">
                                    <div class="h-3 bg-primary/20 rounded-full w-3/4"></div>
                                    <div class="space-y-3">
                                        <div class="h-3 bg-primary/10 rounded-full"></div>
                                        <div class="h-3 bg-primary/10 rounded-full w-5/6"></div>
                                        <div class="h-3 bg-primary/10 rounded-full w-4/6"></div>
                                    </div>
                                </div>
                                <img src="/placeholder.svg?height=400&width=400" alt="Learnify Dashboard"
                                    class="w-full mt-6 rounded-2xl">
                                <div class="mt-6 flex items-center gap-3">
                                    <div class="w-12 h-12 bg-gradient-primary rounded-full"></div>
                                    <div class="flex-1">
                                        <div class="h-2 bg-gray-300 rounded-full w-2/3 mb-2"></div>
                                        <div class="h-2 bg-gray-200 rounded-full w-1/2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Floating Elements -->
                        <div class="absolute -bottom-4 -left-4 bg-white rounded-2xl shadow-xl p-4 border border-gray-100 animate-float"
                            style="animation-delay: 0.5s;">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 bg-gradient-accent rounded-lg flex items-center justify-center text-white font-bold">
                                    ✓</div>
                                <div>
                                    <p class="font-bold text-sm text-secondary">150+ Kursus</p>
                                    <p class="text-xs text-muted">Telah Selesai</p>
                                </div>
                            </div>
                        </div>

                        <div class="absolute -top-4 -right-4 bg-white rounded-2xl shadow-xl p-4 border border-gray-100 animate-float"
                            style="animation-delay: 1s;">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 bg-gradient-primary rounded-lg flex items-center justify-center text-white font-bold">
                                    ⚡</div>
                                <div>
                                    <p class="font-bold text-sm text-secondary">2x Lebih Cepat</p>
                                    <p class="text-xs text-muted">Pembelajaran Efektif</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 lg:py-32 bg-gradient-to-b from-white to-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-20">
                <span class="inline-block bg-primary/10 text-primary px-4 py-2 rounded-full text-sm font-bold mb-4">✨
                    FITUR UNGGULAN</span>
                <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight mb-6 text-secondary">
                    Segalanya yang Anda Butuhkan untuk <span class="text-gradient">Evaluasi yang Lebih Akurat</span>
                </h2>
                <p class="text-lg text-muted leading-relaxed">
                    Platform evaluasi lengkap dengan teknologi cerdas untuk memastikan proses penilaian yang cepat,
                    objektif, dan terpercaya.
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                <!-- Feature Cards -->
                <div class="card-hover bg-white rounded-2xl p-8 border border-gray-100">
                    <div class="feature-icon mb-6">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-secondary mb-3">Beragam Jenis Soal</h3>
                    <p class="text-muted leading-relaxed">Dukungan beragam jenis soal untuk memastikan evaluasi yang
                        akurat dan efektif.</p>
                </div>

                <div class="card-hover bg-white rounded-2xl p-8 border border-gray-100">
                    <div class="feature-icon mb-6">
                        <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-secondary mb-3">Analisis Hasil yang Mendalam</h3>
                    <p class="text-muted leading-relaxed">Analisis hasil yang mendalam untuk memahami kelebihan dan
                        kekurangan peserta.</p>
                </div>

                <div class="card-hover bg-white rounded-2xl p-8 border border-gray-100">
                    <div class="feature-icon mb-6">
                        <svg class="w-8 h-8 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3H7a3 3 0 110-6h13a3 3 0 110 6z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-secondary mb-3">Penjadwalan Ujian yang Fleksibel</h3>
                    <p class="text-muted leading-relaxed">Penjadwalan ujian yang fleksibel untuk memudahkan pengguna
                        dalam mengatur waktu evaluasi.</p>
                </div>

                <div class="card-hover bg-white rounded-2xl p-8 border border-gray-100">
                    <div class="feature-icon mb-6">
                        <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-secondary mb-3">Mobile-Friendly</h3>
                    <p class="text-muted leading-relaxed">Akses evaluasi di mana saja, kapan saja dengan fitur
                        mobile-friendly.</p>
                </div>

                <div class="card-hover bg-white rounded-2xl p-8 border border-gray-100">
                    <div class="feature-icon mb-6">
                        <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z "></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-secondary mb-3">Sistem Penilaian Otomatis & Real-Time</h3>
                    <p class="text-muted leading-relaxed">Sistem penilaian otomatis dan real-time untuk memastikan
                        evaluasi yang cepat dan akurat.</p>
                </div>

                <div class="card-hover bg-white rounded-2xl p-8 border border-gray-100">
                    <div class="feature-icon mb-6">
                        <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-secondary mb-3">Akses Gratis</h3>
                    <p class="text-muted leading-relaxed">Akses evaluasi gratis untuk semua pengguna.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Courses Section -->
    <section id="courses" class="py-20 lg:py-32 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6 mb-16">
                <div>
                    <span
                        class="inline-block bg-accent/10 text-accent px-4 py-2 rounded-full text-sm font-bold mb-4">🎓
                        KOMPETISI POPULER</span>
                    <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-secondary leading-tight">
                        Kompetensi <span class="text-gradient-cyan">Terbaik</span>
                    </h2>
                </div>
                {{-- <a href="#"
                    class="inline-flex items-center gap-2 text-primary font-bold text-lg hover:gap-4 transition-all group">
                    Lihat Semua
                    <svg class="w-6 h-6 group-hover:translate-x-2 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a> --}}
            </div>

            <!-- Courses Grid -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @forelse($competitions as $competition)
                    <!-- Competition Card -->
                    <div class="card-hover group rounded-2xl overflow-hidden border border-gray-100 bg-white">
                        <div class="relative overflow-hidden h-48">
                            <img src="/placeholder.svg?height=300&width=400" alt="{{ $competition->title }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                            {{-- <span
                                class="absolute bottom-4 right-4 bg-white/20 backdrop-blur text-white text-sm font-bold px-3 py-1 rounded-full">
                                {{ gmdate('H', $competition->duration_seconds) }} Jam
                                {{ gmdate('i', $competition->duration_seconds) }} Menit
                            </span> --}}
                        </div>
                        <div class="p-6">
                            <h3
                                class="text-lg font-bold text-secondary mb-2 group-hover:text-primary transition-colors">
                                {{ $competition->title }}</h3>
                            <p class="text-muted text-sm mb-4 leading-relaxed line-clamp-2">
                                {{ $competition->description }}</p>

                            <!-- Creator -->
                            <div class="flex items-center gap-3 pb-4 border-b border-gray-100 mb-4">
                                <div
                                    class="w-8 h-8 bg-gradient-primary rounded-full flex items-center justify-center text-white font-bold text-xs">
                                    {{ strtoupper(substr($competition->creator->name ?? 'A', 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-secondary">
                                        {{ $competition->creator->name ?? 'Admin' }}</p>
                                    <p class="text-xs text-muted">{{ $competition->start_date->format('d M Y') }} -
                                        {{ $competition->end_date->format('d M Y') }}</p>
                                </div>
                            </div>

                            <!-- CTA -->
                            <div class="flex items-center justify-between" >
                                <button  
                                    class="btn-gradient text-white px-4 py-2.5 rounded-lg font-semibold text-sm"><a href="{{ route('register') }}">Daftar</a></button>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Empty State -->
                    <div class="col-span-full text-center py-16">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-secondary mb-2">Belum Ada Kompetisi</h3>
                        <p class="text-muted">Belum ada kompetisi aktif saat ini. Silakan cek kembali nanti.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-20 lg:py-32 bg-gradient-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <span class="inline-block bg-primary/20 text-accent px-4 py-2 rounded-full text-sm font-bold mb-4">🎯
                    CARA KERJA</span>
                <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                    Mulai Evaluasi Hanya dalam <span class="text-gradient-cyan">3 Langkah</span>
                </h2>
                <p class="text-lg text-gray-300 leading-relaxed">
                    Proses yang sederhana dan cepat untuk memulai penilaian Anda.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="relative">
                    <div class="flex flex-col items-center text-center">
                        <div
                            class="w-20 h-20 rounded-2xl bg-gradient-primary flex items-center justify-center mb-8 text-white text-4xl font-bold">
                            1</div>
                        <h3 class="text-2xl font-bold text-white mb-3">Daftar Gratis</h3>
                        <p class="text-gray-300 leading-relaxed">Buat akun Anda dalam hitungan detik dengan email</p>
                    </div>
                    <div
                        class="hidden md:block absolute top-20 -right-4 w-8 h-1 bg-gradient-primary transform -translate-y-1/2">
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="relative">
                    <div class="flex flex-col items-center text-center">
                        <div
                            class="w-20 h-20 rounded-2xl bg-gradient-accent flex items-center justify-center mb-8 text-white text-4xl font-bold">
                            2</div>
                        <h3 class="text-2xl font-bold text-white mb-3">Pilih Kompetisi</h3>
                        <p class="text-gray-300 leading-relaxed">Pilih kompetisi yang sesuai dengan tujuan evaluasi
                            Anda.</p>
                    </div>
                    <div
                        class="hidden md:block absolute top-20 -right-4 w-8 h-1 bg-gradient-accent transform -translate-y-1/2">
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="relative">
                    <div class="flex flex-col items-center text-center">
                        <div
                            class="w-20 h-20 rounded-2xl bg-gradient-primary flex items-center justify-center mb-8 text-white text-4xl font-bold">
                            3</div>
                        <h3 class="text-2xl font-bold text-white mb-3">Mulai Evaluasi</h3>
                        <p class="text-gray-300 leading-relaxed">Mulai evaluasi Anda dan dapatkan Poin untuk
                            meningkatkan Poin Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Final -->
    <section class="py-20 lg:py-32 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-primary opacity-90"></div>
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center">
                <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                    Siap untuk Mengubah Hidup Anda?
                </h2>
                <p class="text-lg sm:text-xl text-blue-100 max-w-2xl mx-auto mb-10 leading-relaxed">
                    Bergabunglah dengan lebih dari 50,000 Peserta yang telah mencapai tujuan mereka melalui Learnify.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}"
                        class="bg-white text-primary px-8 py-4 rounded-full font-bold text-lg hover:bg-blue-50 transition-all inline-flex items-center justify-center gap-2 group">
                        <span>Daftar Sekarang</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-secondary text-white py-16 lg:py-20 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid sm:grid-cols-2 lg:grid-cols-5 gap-12 mb-12">
                <!-- Brand -->
                <div class="col-span-1">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-10 h-10 bg-gradient-primary rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold">Learnify</span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">Platform pembelajaran online terpercaya dengan
                        ribuan kursus berkualitas tinggi.</p>
                    <div class="flex items-center gap-3 mt-6">
                        <a href="#"
                            class="w-10 h-10 rounded-lg bg-gray-800 hover:bg-primary transition-colors flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-lg bg-gray-800 hover:bg-primary transition-colors flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2s9 5 20 5a9.5 9.5 0 00-9-5.5c4.75-2.45 7-5 7-5s-1 3-5 4.2a5.5 5.5 0 015-9.7 4.48 4.48 0 00-1.53-3.14" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-lg bg-gray-800 hover:bg-primary transition-colors flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Product -->
                <div>
                    <h4 class="font-bold mb-4">Produk</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Kursus</a>
                        </li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Pricing</a>
                        </li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Fitur</a>
                        </li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Mobile
                                App</a></li>
                    </ul>
                </div>

                <!-- Company -->
                <div>
                    <h4 class="font-bold mb-4">Perusahaan</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Tentang</a>
                        </li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Blog</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Karir</a>
                        </li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Kontak</a>
                        </li>
                    </ul>
                </div>

                <!-- Resources -->
                <div>
                    <h4 class="font-bold mb-4">Resources</h4>
                    <ul class="space-y-3">
                        <li><a href="#"
                                class="text-gray-400 hover:text-primary transition-colors">Dokumentasi</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Help
                                Center</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">API</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Status</a>
                        </li>
                    </ul>
                </div>

                <!-- Legal -->
                <div>
                    <h4 class="font-bold mb-4">Legal</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Privacy</a>
                        </li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Terms</a>
                        </li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Cookies</a>
                        </li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">License</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="border-t border-gray-800 pt-8">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    <p class="text-gray-400 text-sm">© 2025 Learnify. All rights reserved.</p>
                    <p class="text-gray-400 text-sm">Made with ❤️ Rapip</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Script -->
    <script>
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuBtn?.addEventListener('click', () => {
            mobileMenu?.classList.toggle('hidden');
        });

        // Close menu when clicking on links
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu?.classList.add('hidden');
            });
        });
    </script>
</body>

</html>
