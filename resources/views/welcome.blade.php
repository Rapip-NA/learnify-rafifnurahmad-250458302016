<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Learnify - Platform Belajar Online Terbaik</title>
  <meta name="description" content="Learnify adalah platform pembelajaran online yang membantu Anda menguasai keterampilan baru dengan kursus berkualitas dari para ahli.">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Sora:wght@400;600;700&display=swap" rel="stylesheet">
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
              '0%, 100%': { transform: 'translateY(0px)' },
              '50%': { transform: 'translateY(-20px)' },
            },
            'pulse-glow': {
              '0%, 100%': { boxShadow: '0 0 20px rgba(99, 102, 241, 0.5)' },
              '50%': { boxShadow: '0 0 40px rgba(99, 102, 241, 0.8)' },
            },
            'slide-in': {
              '0%': { transform: 'translateY(30px)', opacity: '0' },
              '100%': { transform: 'translateY(0)', opacity: '1' },
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
      .blob-1, .blob-2 {
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
          <div class="w-10 h-10 bg-gradient-primary rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
          </div>
          <span class="text-2xl font-bold bg-gradient-primary bg-clip-text text-transparent">Learnify</span>
        </a>

        <!-- Desktop Navigation -->
        <div class="hidden md:flex items-center gap-12">
          <a href="#features" class="text-muted hover:text-primary transition-colors font-medium text-sm">Fitur</a>
          <a href="#courses" class="text-muted hover:text-primary transition-colors font-medium text-sm">Kursus</a>
          <a href="#pricing" class="text-muted hover:text-primary transition-colors font-medium text-sm">Harga</a>
          <a href="#testimonials" class="text-muted hover:text-primary transition-colors font-medium text-sm">Testimoni</a>
        </div>

        <!-- CTA Buttons -->
        <div class="hidden md:flex items-center gap-4">
          <a href="{{ route('login') }}" class="text-secondary font-semibold hover:text-primary transition-colors text-sm">Masuk</a>
          <a href="{{ route('register') }}" class="btn-gradient text-white px-6 py-2.5 rounded-full font-semibold text-sm">Daftar Gratis</a>
        </div>

        <!-- Mobile Menu Button -->
        <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden bg-white border-t border-gray-100">
      <div class="px-4 py-4 space-y-3">
        <a href="#features" class="block text-muted hover:text-primary transition-colors font-medium py-2">Fitur</a>
        <a href="#courses" class="block text-muted hover:text-primary transition-colors font-medium py-2">Kursus</a>
        <a href="#pricing" class="block text-muted hover:text-primary transition-colors font-medium py-2">Harga</a>
        <a href="#testimonials" class="block text-muted hover:text-primary transition-colors font-medium py-2">Testimoni</a>
        <div class="pt-4 border-t border-gray-100 space-y-3">
          <a href="#" class="block text-secondary font-medium py-2">Masuk</a>
          <a href="#" class="block btn-gradient text-white px-5 py-2.5 rounded-full font-medium text-center">Daftar Gratis</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="relative min-h-screen flex items-center pt-24 lg:pt-32 pb-16 lg:pb-24 overflow-hidden bg-gradient-to-b from-gray-50 to-white">
    <!-- Animated Blobs -->
    <div class="hero-blob blob-1"></div>
    <div class="hero-blob blob-2"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10">
      <div class="grid lg:grid-cols-2 gap-12 items-center">
        <!-- Left Content -->
        <div class="flex flex-col justify-center animate-slide-in">
          <!-- Badge -->
          <div class="inline-flex items-center gap-3 bg-primary/10 w-fit px-4 py-2 rounded-full mb-8">
            <span class="w-2.5 h-2.5 bg-success rounded-full animate-pulse"></span>
            <span class="text-sm font-semibold text-primary">Kursus Baru: AI & Machine Learning 🚀</span>
          </div>

          <!-- Main Heading -->
          <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold leading-tight mb-6">
            Belajar
            <span class="text-gradient"> Lebih Cerdas,</span>
            <br />
            Raih Masa Depan
          </h1>

          <!-- Subheading -->
          <p class="text-lg sm:text-xl text-muted leading-relaxed mb-8 max-w-xl">
            Platform pembelajaran online dengan ribuan kursus berkualitas dari para ahli industri. Mulai transformasi digital Anda hari ini.
          </p>

          <!-- CTA Buttons -->
          <div class="flex flex-col sm:flex-row gap-4 mb-12">
            <a href="#" class="btn-gradient text-white px-8 py-4 rounded-full font-bold text-lg inline-flex items-center justify-center gap-2 group">
              <span>Mulai Belajar Gratis</span>
              <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
              </svg>
            </a>
            <a href="#" class="btn-outline border-2 border-primary text-primary px-8 py-4 rounded-full font-bold text-lg inline-flex items-center justify-center gap-2 hover:bg-primary/5 transition-all">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M8 5v14l11-7z"/>
              </svg>
              <span>Lihat Demo</span>
            </a>
          </div>

          <!-- Stats -->
          <div class="flex flex-wrap gap-8">
            <div>
              <p class="text-4xl font-bold text-gradient">50K+</p>
              <p class="text-muted font-medium">Siswa Aktif</p>
            </div>
            <div>
              <p class="text-4xl font-bold text-gradient">500+</p>
              <p class="text-muted font-medium">Kursus Premium</p>
            </div>
            <div>
              <p class="text-4xl font-bold text-gradient">4.9 ⭐</p>
              <p class="text-muted font-medium">Rating Sempurna</p>
            </div>
          </div>
        </div>

        <!-- Right - Illustration/Image -->
        <div class="hidden lg:flex justify-center animate-slide-in" style="animation-delay: 0.2s;">
          <div class="relative w-full max-w-md">
            <!-- Card with gradient border -->
            <div class="relative">
              <div class="absolute inset-0 bg-gradient-primary rounded-3xl opacity-20 blur-2xl"></div>
              <div class="relative bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100 p-6">
                <div class="space-y-4">
                  <div class="h-3 bg-primary/20 rounded-full w-3/4"></div>
                  <div class="space-y-3">
                    <div class="h-3 bg-primary/10 rounded-full"></div>
                    <div class="h-3 bg-primary/10 rounded-full w-5/6"></div>
                    <div class="h-3 bg-primary/10 rounded-full w-4/6"></div>
                  </div>
                </div>
                <img src="/placeholder.svg?height=400&width=400" alt="Learnify Dashboard" class="w-full mt-6 rounded-2xl">
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
            <div class="absolute -bottom-4 -left-4 bg-white rounded-2xl shadow-xl p-4 border border-gray-100 animate-float" style="animation-delay: 0.5s;">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-accent rounded-lg flex items-center justify-center text-white font-bold">✓</div>
                <div>
                  <p class="font-bold text-sm text-secondary">150+ Kursus</p>
                  <p class="text-xs text-muted">Telah Selesai</p>
                </div>
              </div>
            </div>

            <div class="absolute -top-4 -right-4 bg-white rounded-2xl shadow-xl p-4 border border-gray-100 animate-float" style="animation-delay: 1s;">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-primary rounded-lg flex items-center justify-center text-white font-bold">⚡</div>
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
        <span class="inline-block bg-primary/10 text-primary px-4 py-2 rounded-full text-sm font-bold mb-4">✨ FITUR UNGGULAN</span>
        <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight mb-6 text-secondary">
          Segalanya yang Anda Butuhkan untuk <span class="text-gradient">Sukses</span>
        </h2>
        <p class="text-lg text-muted leading-relaxed">
          Platform pembelajaran lengkap dengan teknologi terdepan untuk memaksimalkan pengalaman belajar Anda.
        </p>
      </div>

      <!-- Features Grid -->
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
        <!-- Feature Cards -->
        <div class="card-hover bg-white rounded-2xl p-8 border border-gray-100">
          <div class="feature-icon mb-6">
            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
            </svg>
          </div>
          <h3 class="text-xl font-bold text-secondary mb-3">Video HD 4K</h3>
          <p class="text-muted leading-relaxed">Konten video berkualitas tinggi dengan subtitle multi-bahasa dan transkripsi lengkap.</p>
        </div>

        <div class="card-hover bg-white rounded-2xl p-8 border border-gray-100">
          <div class="feature-icon mb-6">
            <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
            </svg>
          </div>
          <h3 class="text-xl font-bold text-secondary mb-3">Interaktif & Praktis</h3>
          <p class="text-muted leading-relaxed">Kuis real-time, proyek praktis, dan hands-on coding untuk pengalaman belajar maksimal.</p>
        </div>

        <div class="card-hover bg-white rounded-2xl p-8 border border-gray-100">
          <div class="feature-icon mb-6">
            <svg class="w-8 h-8 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
            </svg>
          </div>
          <h3 class="text-xl font-bold text-secondary mb-3">Sertifikat Terverifikasi</h3>
          <p class="text-muted leading-relaxed">Dapatkan sertifikat digital yang diakui industri untuk menambah kredibilitas profesional.</p>
        </div>

        <div class="card-hover bg-white rounded-2xl p-8 border border-gray-100">
          <div class="feature-icon mb-6">
            <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
            </svg>
          </div>
          <h3 class="text-xl font-bold text-secondary mb-3">Belajar Mobile</h3>
          <p class="text-muted leading-relaxed">Akses semua kursus dari smartphone Anda, belajar offline kapan saja, di mana saja.</p>
        </div>

        <div class="card-hover bg-white rounded-2xl p-8 border border-gray-100">
          <div class="feature-icon mb-6">
            <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
          </div>
          <h3 class="text-xl font-bold text-secondary mb-3">Komunitas Global</h3>
          <p class="text-muted leading-relaxed">Terhubung dengan jutaan learner, berbagi pengetahuan, dan jalin networking profesional.</p>
        </div>

        <div class="card-hover bg-white rounded-2xl p-8 border border-gray-100">
          <div class="feature-icon mb-6">
            <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
          </div>
          <h3 class="text-xl font-bold text-secondary mb-3">Akses Selamanya</h3>
          <p class="text-muted leading-relaxed">Investasi satu kali, akses selamanya dengan update konten dan materi terbaru gratis.</p>
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
          <span class="inline-block bg-accent/10 text-accent px-4 py-2 rounded-full text-sm font-bold mb-4">🎓 KURSUS POPULER</span>
          <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-secondary leading-tight">
            Kursus Pilihan <span class="text-gradient-cyan">Terbaik</span>
          </h2>
        </div>
        <a href="#" class="inline-flex items-center gap-2 text-primary font-bold text-lg hover:gap-4 transition-all group">
          Lihat Semua
          <svg class="w-6 h-6 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
          </svg>
        </a>
      </div>

      <!-- Courses Grid -->
      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
        <!-- Course 1 -->
        <div class="card-hover group rounded-2xl overflow-hidden border border-gray-100 bg-white">
          <div class="relative overflow-hidden h-48">
            <img src="/placeholder.svg?height=300&width=400" alt="Web Development" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
            <span class="absolute top-4 left-4 bg-gradient-primary text-white text-xs font-bold px-4 py-1.5 rounded-full">Bestseller</span>
            <span class="absolute bottom-4 right-4 bg-white/20 backdrop-blur text-white text-sm font-bold px-3 py-1 rounded-full">12 Jam</span>
          </div>
          <div class="p-6">
            <div class="flex gap-2 mb-3">
              <span class="inline-block bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full">Web Dev</span>
              <span class="inline-block bg-purple-100 text-purple-700 text-xs font-bold px-3 py-1 rounded-full">Pemula</span>
            </div>
            <h3 class="text-lg font-bold text-secondary mb-2 group-hover:text-primary transition-colors">Full Stack Web Development</h3>
            <p class="text-muted text-sm mb-4 leading-relaxed">Master HTML, CSS, JavaScript, React, Node.js dan build aplikasi web profesional.</p>

            <!-- Rating -->
            <div class="flex items-center gap-2 mb-4">
              <div class="flex items-center gap-0.5">
                <span class="text-yellow-400 text-sm">★★★★★</span>
              </div>
              <span class="text-muted text-sm">(2,847 ulasan)</span>
            </div>

            <!-- Instructor -->
            <div class="flex items-center gap-3 pb-4 border-b border-gray-100 mb-4">
              <div class="w-8 h-8 bg-gradient-primary rounded-full"></div>
              <div>
                <p class="text-sm font-semibold text-secondary">John Developer</p>
                <p class="text-xs text-muted">Senior Engineer</p>
              </div>
            </div>

            <!-- Price and CTA -->
            <div class="flex items-center justify-between">
              <div>
                <p class="text-2xl font-bold text-secondary">Rp 299K</p>
                <p class="text-xs text-muted line-through">Rp 999K</p>
              </div>
              <button class="btn-gradient text-white px-4 py-2.5 rounded-lg font-semibold text-sm">Daftar</button>
            </div>
          </div>
        </div>

        <!-- Course 2 -->
        <div class="card-hover group rounded-2xl overflow-hidden border border-gray-100 bg-white">
          <div class="relative overflow-hidden h-48">
            <img src="/placeholder.svg?height=300&width=400" alt="Data Science" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
            <span class="absolute top-4 left-4 bg-gradient-accent text-white text-xs font-bold px-4 py-1.5 rounded-full">Trending</span>
            <span class="absolute bottom-4 right-4 bg-white/20 backdrop-blur text-white text-sm font-bold px-3 py-1 rounded-full">20 Jam</span>
          </div>
          <div class="p-6">
            <div class="flex gap-2 mb-3">
              <span class="inline-block bg-cyan-100 text-cyan-700 text-xs font-bold px-3 py-1 rounded-full">Data Science</span>
              <span class="inline-block bg-orange-100 text-orange-700 text-xs font-bold px-3 py-1 rounded-full">Menengah</span>
            </div>
            <h3 class="text-lg font-bold text-secondary mb-2 group-hover:text-primary transition-colors">AI & Machine Learning Essentials</h3>
            <p class="text-muted text-sm mb-4 leading-relaxed">Pelajari konsep AI, machine learning, dan deep learning dengan Python dan TensorFlow.</p>

            <div class="flex items-center gap-2 mb-4">
              <div class="flex items-center gap-0.5">
                <span class="text-yellow-400 text-sm">★★★★★</span>
              </div>
              <span class="text-muted text-sm">(1,952 ulasan)</span>
            </div>

            <div class="flex items-center gap-3 pb-4 border-b border-gray-100 mb-4">
              <div class="w-8 h-8 bg-gradient-accent rounded-full"></div>
              <div>
                <p class="text-sm font-semibold text-secondary">Dr. AI Expert</p>
                <p class="text-xs text-muted">PhD in ML</p>
              </div>
            </div>

            <div class="flex items-center justify-between">
              <div>
                <p class="text-2xl font-bold text-secondary">Rp 399K</p>
                <p class="text-xs text-muted line-through">Rp 1.2M</p>
              </div>
              <button class="btn-gradient text-white px-4 py-2.5 rounded-lg font-semibold text-sm">Daftar</button>
            </div>
          </div>
        </div>

        <!-- Course 3 -->
        <div class="card-hover group rounded-2xl overflow-hidden border border-gray-100 bg-white">
          <div class="relative overflow-hidden h-48">
            <img src="/placeholder.svg?height=300&width=400" alt="Mobile Dev" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
            <span class="absolute top-4 left-4 bg-indigo-500 text-white text-xs font-bold px-4 py-1.5 rounded-full">Populer</span>
            <span class="absolute bottom-4 right-4 bg-white/20 backdrop-blur text-white text-sm font-bold px-3 py-1 rounded-full">16 Jam</span>
          </div>
          <div class="p-6">
            <div class="flex gap-2 mb-3">
              <span class="inline-block bg-pink-100 text-pink-700 text-xs font-bold px-3 py-1 rounded-full">Mobile Dev</span>
              <span class="inline-block bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">Pemula</span>
            </div>
            <h3 class="text-lg font-bold text-secondary mb-2 group-hover:text-primary transition-colors">Mobile App Development dengan Flutter</h3>
            <p class="text-muted text-sm mb-4 leading-relaxed">Buat aplikasi mobile untuk iOS dan Android dengan satu codebase menggunakan Flutter.</p>

            <div class="flex items-center gap-2 mb-4">
              <div class="flex items-center gap-0.5">
                <span class="text-yellow-400 text-sm">★★★★☆</span>
              </div>
              <span class="text-muted text-sm">(1,543 ulasan)</span>
            </div>

            <div class="flex items-center gap-3 pb-4 border-b border-gray-100 mb-4">
              <div class="w-8 h-8 bg-pink-500 rounded-full"></div>
              <div>
                <p class="text-sm font-semibold text-secondary">Mobile Pro</p>
                <p class="text-xs text-muted">Flutter Expert</p>
              </div>
            </div>

            <div class="flex items-center justify-between">
              <div>
                <p class="text-2xl font-bold text-secondary">Rp 349K</p>
                <p class="text-xs text-muted line-through">Rp 1.1M</p>
              </div>
              <button class="btn-gradient text-white px-4 py-2.5 rounded-lg font-semibold text-sm">Daftar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- How It Works -->
  <section class="py-20 lg:py-32 bg-gradient-dark">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center max-w-3xl mx-auto mb-20">
        <span class="inline-block bg-primary/20 text-accent px-4 py-2 rounded-full text-sm font-bold mb-4">🎯 CARA KERJA</span>
        <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
          Mulai Belajar Hanya dalam <span class="text-gradient-cyan">3 Langkah</span>
        </h2>
        <p class="text-lg text-gray-300 leading-relaxed">
          Proses yang simple dan cepat untuk memulai perjalanan pembelajaran Anda.
        </p>
      </div>

      <div class="grid md:grid-cols-3 gap-8">
        <!-- Step 1 -->
        <div class="relative">
          <div class="flex flex-col items-center text-center">
            <div class="w-20 h-20 rounded-2xl bg-gradient-primary flex items-center justify-center mb-8 text-white text-4xl font-bold">1</div>
            <h3 class="text-2xl font-bold text-white mb-3">Daftar Gratis</h3>
            <p class="text-gray-300 leading-relaxed">Buat akun Anda dalam hitungan detik dengan email atau media sosial Anda.</p>
          </div>
          <div class="hidden md:block absolute top-20 -right-4 w-8 h-1 bg-gradient-primary transform -translate-y-1/2"></div>
        </div>

        <!-- Step 2 -->
        <div class="relative">
          <div class="flex flex-col items-center text-center">
            <div class="w-20 h-20 rounded-2xl bg-gradient-accent flex items-center justify-center mb-8 text-white text-4xl font-bold">2</div>
            <h3 class="text-2xl font-bold text-white mb-3">Pilih Kursus</h3>
            <p class="text-gray-300 leading-relaxed">Jelajahi ribuan kursus dan pilih yang sesuai dengan tujuan pembelajaran Anda.</p>
          </div>
          <div class="hidden md:block absolute top-20 -right-4 w-8 h-1 bg-gradient-accent transform -translate-y-1/2"></div>
        </div>

        <!-- Step 3 -->
        <div class="relative">
          <div class="flex flex-col items-center text-center">
            <div class="w-20 h-20 rounded-2xl bg-gradient-primary flex items-center justify-center mb-8 text-white text-4xl font-bold">3</div>
            <h3 class="text-2xl font-bold text-white mb-3">Belajar & Sukses</h3>
            <p class="text-gray-300 leading-relaxed">Selesaikan kursus dan dapatkan sertifikat untuk meningkatkan karir Anda.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials -->
  <section id="testimonials" class="py-20 lg:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center max-w-3xl mx-auto mb-16">
        <span class="inline-block bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm font-bold mb-4">⭐ TESTIMONI</span>
        <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-secondary leading-tight mb-6">
          Ribuan Siswa <span class="text-gradient">Puas</span>
        </h2>
        <p class="text-lg text-muted leading-relaxed">Lihat kisah sukses dari siswa-siswa kami yang telah mencapai tujuan mereka.</p>
      </div>

      <div class="grid md:grid-cols-3 gap-8">
        <!-- Testimonial 1 -->
        <div class="card-hover bg-gradient-light rounded-2xl p-8 border border-gray-200">
          <div class="flex items-center gap-1 mb-4">
            <span class="text-2xl">★★★★★</span>
          </div>
          <p class="text-muted leading-relaxed mb-6 text-lg font-medium">"Learnify mengubah cara saya belajar. Kursusnya sangat terstruktur dan instrukturnya luar biasa responsif. Saya sudah dapat pekerjaan impian saya berkat sertifikat dari sini!"</p>
          <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-gradient-primary rounded-full flex items-center justify-center text-white font-bold text-lg">SA</div>
            <div>
              <p class="font-bold text-secondary">Siti Aminah</p>
              <p class="text-muted text-sm">Junior Developer</p>
            </div>
          </div>
        </div>

        <!-- Testimonial 2 -->
        <div class="card-hover bg-gradient-light rounded-2xl p-8 border border-gray-200">
          <div class="flex items-center gap-1 mb-4">
            <span class="text-2xl">★★★★★</span>
          </div>
          <p class="text-muted leading-relaxed mb-6 text-lg font-medium">"Platform ini benar-benar mengubah karir saya. Konten berkualitas tinggi dan mentor yang support membuat saya percaya diri menghadapi challenges di dunia kerja."</p>
          <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-gradient-accent rounded-full flex items-center justify-center text-white font-bold text-lg">RD</div>
            <div>
              <p class="font-bold text-secondary">Reza Dharma</p>
              <p class="text-muted text-sm">Product Manager</p>
            </div>
          </div>
        </div>

        <!-- Testimonial 3 -->
        <div class="card-hover bg-gradient-light rounded-2xl p-8 border border-gray-200">
          <div class="flex items-center gap-1 mb-4">
            <span class="text-2xl">★★★★★</span>
          </div>
          <p class="text-muted leading-relaxed mb-6 text-lg font-medium">"Saya sangat terkesan dengan kualitas konten dan pedagoginya. Tim Learnify benar-benar peduli dengan kesuksesan siswa mereka. Highly recommended!"</p>
          <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-pink-500 rounded-full flex items-center justify-center text-white font-bold text-lg">NA</div>
            <div>
              <p class="font-bold text-secondary">Nita Anggraeni</p>
              <p class="text-muted text-sm">UI/UX Designer</p>
            </div>
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
          Bergabunglah dengan lebih dari 50,000 siswa yang telah mencapai tujuan mereka melalui Learnify.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <a href="#" class="bg-white text-primary px-8 py-4 rounded-full font-bold text-lg hover:bg-blue-50 transition-all inline-flex items-center justify-center gap-2 group">
            <span>Daftar Sekarang</span>
            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
            </svg>
          </a>
          <a href="#" class="border-2 border-white text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white/10 transition-all">
            Tanya Sekarang
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
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
              </svg>
            </div>
            <span class="text-2xl font-bold">Learnify</span>
          </div>
          <p class="text-gray-400 text-sm leading-relaxed">Platform pembelajaran online terpercaya dengan ribuan kursus berkualitas tinggi.</p>
          <div class="flex items-center gap-3 mt-6">
            <a href="#" class="w-10 h-10 rounded-lg bg-gray-800 hover:bg-primary transition-colors flex items-center justify-center">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            </a>
            <a href="#" class="w-10 h-10 rounded-lg bg-gray-800 hover:bg-primary transition-colors flex items-center justify-center">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2s9 5 20 5a9.5 9.5 0 00-9-5.5c4.75-2.45 7-5 7-5s-1 3-5 4.2a5.5 5.5 0 015-9.7 4.48 4.48 0 00-1.53-3.14"/></svg>
            </a>
            <a href="#" class="w-10 h-10 rounded-lg bg-gray-800 hover:bg-primary transition-colors flex items-center justify-center">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
            </a>
          </div>
        </div>

        <!-- Product -->
        <div>
          <h4 class="font-bold mb-4">Produk</h4>
          <ul class="space-y-3">
            <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Kursus</a></li>
            <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Pricing</a></li>
            <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Fitur</a></li>
            <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Mobile App</a></li>
          </ul>
        </div>

        <!-- Company -->
        <div>
          <h4 class="font-bold mb-4">Perusahaan</h4>
          <ul class="space-y-3">
            <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Tentang</a></li>
            <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Blog</a></li>
            <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Karir</a></li>
            <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Kontak</a></li>
          </ul>
        </div>

        <!-- Resources -->
        <div>
          <h4 class="font-bold mb-4">Resources</h4>
          <ul class="space-y-3">
            <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Dokumentasi</a></li>
            <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Help Center</a></li>
            <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">API</a></li>
            <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Status</a></li>
          </ul>
        </div>

        <!-- Legal -->
        <div>
          <h4 class="font-bold mb-4">Legal</h4>
          <ul class="space-y-3">
            <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Privacy</a></li>
            <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Terms</a></li>
            <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">Cookies</a></li>
            <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">License</a></li>
          </ul>
        </div>
      </div>

      <!-- Footer Bottom -->
      <div class="border-t border-gray-800 pt-8">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
          <p class="text-gray-400 text-sm">© 2025 Learnify. All rights reserved.</p>
          <p class="text-gray-400 text-sm">Made with ❤️ for learners worldwide</p>
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
