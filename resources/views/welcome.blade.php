<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnify - Platform Pembelajaran Online Modern</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Sora:wght@400;500;600;700&display=swap');

        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --accent: #a78bfa;
            --accent-light: #ede9fe;
            --neutral-50: #f9fafb;
            --neutral-100: #f3f4f6;
            --neutral-900: #111827;
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Sora', sans-serif;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
            padding: 12px 28px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.2);
        }

        .btn-secondary {
            background-color: white;
            color: var(--primary);
            padding: 12px 28px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
            text-decoration: none;
            border: 2px solid var(--primary);
            cursor: pointer;
        }

        .btn-secondary:hover {
            background-color: var(--accent-light);
            transform: translateY(-2px);
        }

        .gradient-text {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .feature-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            transition: all 0.3s ease;
            border: 1px solid rgba(99, 102, 241, 0.1);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(99, 102, 241, 0.15);
            border-color: var(--primary);
        }

        .course-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid rgba(99, 102, 241, 0.05);
        }

        .course-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(99, 102, 241, 0.2);
        }

        .course-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: white;
        }

        .stat-box {
            text-align: center;
            padding: 20px;
        }

        .stat-number {
            font-size: 32px;
            font-weight: 800;
            color: var(--primary);
            font-family: 'Sora', sans-serif;
        }

        .stat-text {
            color: #6b7280;
            font-size: 14px;
            margin-top: 8px;
        }

        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .hero-section {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.05), rgba(167, 139, 250, 0.05));
        }

        @media (max-width: 768px) {
            .stat-number {
                font-size: 24px;
            }
        }
    </style>
</head>

<body class="bg-neutral-50">
    <!-- Navbar -->
    <nav class="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center gap-2">
                    <div
                        class="w-8 h-8 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-lg">L</span>
                    </div>
                    <span class="font-bold text-xl text-neutral-900">Learnify</span>
                </div>

                <!-- Menu Desktop -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="#" class="text-neutral-600 hover:text-neutral-900 transition">Platform</a>
                    <a href="#" class="text-neutral-600 hover:text-neutral-900 transition">Kursus</a>
                    <a href="#" class="text-neutral-600 hover:text-neutral-900 transition">Harga</a>
                    <a href="#" class="text-neutral-600 hover:text-neutral-900 transition">Tentang</a>
                </div>

                <!-- Buttons -->
                <div class="flex items-center gap-4">
                        <a href="{{ route('login') }}" class="btn-secondary hidden sm:block">Masuk</a>
                        <a href="{{ route('register') }}" class="btn-primary">Daftar Gratis</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section py-12 md:py-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 items-center">
                <!-- Left Content -->
                <div>
                    <div class="inline-block bg-accent-light px-4 py-2 rounded-full mb-4">
                        <span class="text-sm font-semibold text-indigo-600">✨ Pembelajaran Tanpa Batas</span>
                    </div>

                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-neutral-900 mb-6 leading-tight">
                        Tingkatkan Skill Anda dengan <span class="gradient-text">Learnify</span>
                    </h1>

                    <p class="text-lg text-neutral-600 mb-8 leading-relaxed">
                        Platform pembelajaran online terpadu yang membantu Anda menguasai skill baru. Dari pemula hingga
                        expert, kami punya kursusnya.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <button class="btn-primary">Mulai Belajar Gratis</button>
                        <button class="btn-secondary">Lihat Demo</button>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-4 mt-12">
                        <div class="stat-box">
                            <div class="stat-number">10K+</div>
                            <div class="stat-text">Siswa Aktif</div>
                        </div>
                        <div class="stat-box">
                            <div class="stat-number">500+</div>
                            <div class="stat-text">Kursus</div>
                        </div>
                        <div class="stat-box">
                            <div class="stat-number">4.9★</div>
                            <div class="stat-text">Rating</div>
                        </div>
                    </div>
                </div>

                <!-- Right Visual -->
                <div class="hidden md:block">
                    <div class="bg-gradient-to-br from-indigo-600 to-purple-600 rounded-2xl p-12 text-center">
                        <div class="inline-block bg-white bg-opacity-20 text-white rounded-2xl p-8 backdrop-blur-sm">
                            <div class="text-6xl mb-4">📚</div>
                            <h3 class="text-2xl font-bold mb-2">Belajar Apapun</h3>
                            <p class="text-sm opacity-90">Dari programming hingga design, bisnis hingga personal
                                development.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 md:py-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12 md:mb-16">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-neutral-900 mb-4">
                    Mengapa Memilih Learnify?
                </h2>
                <p class="text-lg text-neutral-600 max-w-2xl mx-auto">
                    Kami menyediakan semua yang Anda butuhkan untuk sukses dalam perjalanan pembelajaran digital Anda.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Feature 1 -->
                <div class="feature-card">
                    <div class="text-3xl mb-4">🎯</div>
                    <h3 class="text-xl font-bold text-neutral-900 mb-2">Pembelajaran Terstruktur</h3>
                    <p class="text-neutral-600">Kursus dirancang oleh expert dengan struktur yang jelas dan progresif
                        dari dasar hingga mahir.</p>
                </div>

                <!-- Feature 2 -->
                <div class="feature-card">
                    <div class="text-3xl mb-4">👨‍🏫</div>
                    <h3 class="text-xl font-bold text-neutral-900 mb-2">Mentor Berpengalaman</h3>
                    <p class="text-neutral-600">Belajar langsung dari praktisi profesional yang memiliki pengalaman
                        industri bertahun-tahun.</p>
                </div>

                <!-- Feature 3 -->
                <div class="feature-card">
                    <div class="text-3xl mb-4">💬</div>
                    <h3 class="text-xl font-bold text-neutral-900 mb-2">Komunitas Aktif</h3>
                    <p class="text-neutral-600">Bergabung dengan ribuan pelajar lain, berbagi pengalaman, dan tumbuh
                        bersama komunitas.</p>
                </div>

                <!-- Feature 4 -->
                <div class="feature-card">
                    <div class="text-3xl mb-4">🏆</div>
                    <h3 class="text-xl font-bold text-neutral-900 mb-2">Sertifikat Resmi</h3>
                    <p class="text-neutral-600">Dapatkan sertifikat yang diakui industri setelah menyelesaikan setiap
                        kursus dengan sukses.</p>
                </div>

                <!-- Feature 5 -->
                <div class="feature-card">
                    <div class="text-3xl mb-4">⏰</div>
                    <h3 class="text-xl font-bold text-neutral-900 mb-2">Belajar Kapan Saja</h3>
                    <p class="text-neutral-600">Akses materi kapan pun Anda mau, di perangkat apapun. Pembelajaran
                        dengan kecepatan Anda sendiri.</p>
                </div>

                <!-- Feature 6 -->
                <div class="feature-card">
                    <div class="text-3xl mb-4">💰</div>
                    <h3 class="text-xl font-bold text-neutral-900 mb-2">Harga Terjangkau</h3>
                    <p class="text-neutral-600">Paket berlangganan fleksibel dengan harga yang kompetitif untuk semua
                        kalangan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Courses Section -->
    <section class="bg-white py-16 md:py-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12 md:mb-16">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-neutral-900 mb-4">
                    Kursus Populer
                </h2>
                <p class="text-lg text-neutral-600 max-w-2xl mx-auto">
                    Pilihan kursus terbaik yang sedang diikuti ribuan pelajar di seluruh dunia.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Course 1 -->
                <div class="course-card">
                    <div class="course-image">💻</div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-neutral-900 mb-2">Web Development Modern</h3>
                        <p class="text-neutral-600 text-sm mb-4">Kuasai HTML, CSS, JavaScript, dan React untuk membuat
                            website profesional.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-indigo-600 font-bold">Rp 299k</span>
                            <span class="text-sm text-neutral-500">👨‍🏫 12 jam</span>
                        </div>
                    </div>
                </div>

                <!-- Course 2 -->
                <div class="course-card">
                    <div class="course-image">🎨</div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-neutral-900 mb-2">UI/UX Design Fundamentals</h3>
                        <p class="text-neutral-600 text-sm mb-4">Pelajari prinsip design, Figma, dan buat portfolio
                            design yang memukau.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-indigo-600 font-bold">Rp 249k</span>
                            <span class="text-sm text-neutral-500">👨‍🏫 10 jam</span>
                        </div>
                    </div>
                </div>

                <!-- Course 3 -->
                <div class="course-card">
                    <div class="course-image">📊</div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-neutral-900 mb-2">Data Analytics & SQL</h3>
                        <p class="text-neutral-600 text-sm mb-4">Analisis data seperti seorang profesional dengan SQL
                            dan data visualization.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-indigo-600 font-bold">Rp 299k</span>
                            <span class="text-sm text-neutral-500">👨‍🏫 14 jam</span>
                        </div>
                    </div>
                </div>

                <!-- Course 4 -->
                <div class="course-card">
                    <div class="course-image">🎬</div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-neutral-900 mb-2">Video Editing Professional</h3>
                        <p class="text-neutral-600 text-sm mb-4">Buat video berkualitas tinggi dengan Adobe Premiere Pro
                            dan efek profesional.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-indigo-600 font-bold">Rp 199k</span>
                            <span class="text-sm text-neutral-500">👨‍🏫 8 jam</span>
                        </div>
                    </div>
                </div>

                <!-- Course 5 -->
                <div class="course-card">
                    <div class="course-image">📱</div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-neutral-900 mb-2">Mobile App Development</h3>
                        <p class="text-neutral-600 text-sm mb-4">Bangun aplikasi mobile dengan Flutter dan Dart untuk
                            iOS & Android.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-indigo-600 font-bold">Rp 349k</span>
                            <span class="text-sm text-neutral-500">👨‍🏫 16 jam</span>
                        </div>
                    </div>
                </div>

                <!-- Course 6 -->
                <div class="course-card">
                    <div class="course-image">🤖</div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-neutral-900 mb-2">AI & Machine Learning</h3>
                        <p class="text-neutral-600 text-sm mb-4">Explore AI dan machine learning dengan Python dan
                            TensorFlow.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-indigo-600 font-bold">Rp 399k</span>
                            <span class="text-sm text-neutral-500">👨‍🏫 18 jam</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <button class="btn-primary">Lihat Semua Kursus</button>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="py-16 md:py-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12 md:mb-16">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-neutral-900 mb-4">
                    Apa Kata Siswa Kami?
                </h2>
                <p class="text-lg text-neutral-600 max-w-2xl mx-auto">
                    Ribuan siswa telah meningkatkan skill mereka dengan Learnify.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Testimonial 1 -->
                <div class="feature-card">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-full"></div>
                        <div>
                            <h4 class="font-bold text-neutral-900">Budi Santoso</h4>
                            <p class="text-sm text-neutral-600">Web Developer</p>
                        </div>
                    </div>
                    <p class="text-neutral-600 mb-4">"Kursus di Learnify sangat membantu saya menguasai React.
                        Mentor-mentornya sangat responsif!"</p>
                    <div class="text-yellow-400">⭐⭐⭐⭐⭐</div>
                </div>

                <!-- Testimonial 2 -->
                <div class="feature-card">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-600 to-pink-600 rounded-full"></div>
                        <div>
                            <h4 class="font-bold text-neutral-900">Siti Nurhaliza</h4>
                            <p class="text-sm text-neutral-600">UI/UX Designer</p>
                        </div>
                    </div>
                    <p class="text-neutral-600 mb-4">"Platform ini memberikan struktur pembelajaran yang sempurna untuk
                        portofolio saya."</p>
                    <div class="text-yellow-400">⭐⭐⭐⭐⭐</div>
                </div>

                <!-- Testimonial 3 -->
                <div class="feature-card">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-pink-600 to-red-600 rounded-full"></div>
                        <div>
                            <h4 class="font-bold text-neutral-900">Ahmad Rizki</h4>
                            <p class="text-sm text-neutral-600">Data Analyst</p>
                        </div>
                    </div>
                    <p class="text-neutral-600 mb-4">"Dengan sertifikat Learnify, saya berhasil mendapatkan pekerjaan
                        sebagai Data Analyst."</p>
                    <div class="text-yellow-400">⭐⭐⭐⭐⭐</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="bg-white py-16 md:py-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12 md:mb-16">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-neutral-900 mb-4">
                    Pilih Plan Anda
                </h2>
                <p class="text-lg text-neutral-600 max-w-2xl mx-auto">
                    Mulai gratis atau upgrade ke plan premium untuk akses penuh.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Free Plan -->
                <div class="feature-card">
                    <h3 class="text-2xl font-bold text-neutral-900 mb-2">Gratis</h3>
                    <p class="text-neutral-600 mb-6">Sempurna untuk memulai</p>
                    <div class="text-3xl font-bold text-neutral-900 mb-6">Rp 0<span class="text-lg">/bulan</span></div>
                    <button class="btn-secondary w-full mb-6">Mulai Sekarang</button>
                    <ul class="space-y-3 text-neutral-600">
                        <li>✓ 5 kursus gratis</li>
                        <li>✓ Akses komunitas</li>
                        <li>✓ Chat support</li>
                        <li>✗ Sertifikat resmi</li>
                        <li>✗ Mentor personal</li>
                    </ul>
                </div>

                <!-- Pro Plan -->
                <div class="feature-card border-2 border-indigo-600">
                    <div
                        class="inline-block bg-indigo-600 text-white px-3 py-1 rounded-full text-sm font-semibold mb-4">
                        Paling Populer</div>
                    <h3 class="text-2xl font-bold text-neutral-900 mb-2">Pro</h3>
                    <p class="text-neutral-600 mb-6">Untuk profesional serius</p>
                    <div class="text-3xl font-bold text-neutral-900 mb-6">Rp 199k<span class="text-lg">/bulan</span>
                    </div>
                    <button class="btn-primary w-full mb-6">Mulai Trial</button>
                    <ul class="space-y-3 text-neutral-600">
                        <li>✓ Semua kursus</li>
                        <li>✓ Sertifikat resmi</li>
                        <li>✓ Download materi</li>
                        <li>✓ Priority support</li>
                        <li>✗ Mentor personal</li>
                    </ul>
                </div>

                <!-- Enterprise Plan -->
                <div class="feature-card">
                    <h3 class="text-2xl font-bold text-neutral-900 mb-2">Enterprise</h3>
                    <p class="text-neutral-600 mb-6">Untuk tim dan organisasi</p>
                    <div class="text-3xl font-bold text-neutral-900 mb-6">Custom<span class="text-lg">/bulan</span>
                    </div>
                    <button class="btn-secondary w-full mb-6">Hubungi Kami</button>
                    <ul class="space-y-3 text-neutral-600">
                        <li>✓ Semua fitur Pro</li>
                        <li>✓ Mentor personal</li>
                        <li>✓ Kurasi custom</li>
                        <li>✓ Analytics detail</li>
                        <li>✓ Dedicated support</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-gradient-to-r from-indigo-600 to-purple-600 py-16 md:py-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4">
                Siap untuk Mengubah Karir Anda?
            </h2>
            <p class="text-xl text-purple-100 mb-8">
                Bergabunglah dengan ribuan siswa yang telah sukses meningkatkan skill mereka bersama Learnify.
            </p>
            <button
                class="bg-white text-indigo-600 px-8 py-4 rounded-full font-bold text-lg hover:bg-purple-100 transition transform hover:scale-105">
                Mulai Pembelajaran Anda Hari Ini
            </button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-neutral-900 text-neutral-400 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 mb-8">
                <!-- About -->
                <div>
                    <h4 class="text-white font-bold mb-4">Tentang Learnify</h4>
                    <p class="text-sm">Platform pembelajaran online terpercaya untuk mengembangkan skill Anda.</p>
                </div>

                <!-- Product -->
                <div>
                    <h4 class="text-white font-bold mb-4">Produk</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">Kursus</a></li>
                        <li><a href="#" class="hover:text-white transition">Path Pembelajaran</a></li>
                        <li><a href="#" class="hover:text-white transition">Sertifikat</a></li>
                        <li><a href="#" class="hover:text-white transition">Harga</a></li>
                    </ul>
                </div>

                <!-- Company -->
                <div>
                    <h4 class="text-white font-bold mb-4">Perusahaan</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-white transition">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition">Karir</a></li>
                        <li><a href="#" class="hover:text-white transition">Kontak</a></li>
                    </ul>
                </div>

                <!-- Legal -->
                <div>
                    <h4 class="text-white font-bold mb-4">Legal</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-white transition">Cookie Policy</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-neutral-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm mb-4 md:mb-0">&copy; 2025 Learnify. Semua hak dilindungi.</p>
                <div class="flex gap-6">
                    <a href="#" class="hover:text-white transition">Twitter</a>
                    <a href="#" class="hover:text-white transition">Facebook</a>
                    <a href="#" class="hover:text-white transition">Instagram</a>
                    <a href="#" class="hover:text-white transition">LinkedIn</a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
