<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnify - Masuk / Daftar</title>
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
            z-index: 0;
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

        .btn-gradient {
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            transition: all 0.3s ease;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.3);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
    </style>
</head>

<body class="font-sans text-foreground bg-background">

    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 bg-white/80 backdrop-blur-xl z-50 border-b border-gray-100/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-20">
                <!-- Logo -->
                <a href="/" class="flex items-center gap-3 group">
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

                <!-- Back to Home -->
                <a href="/"
                    class="text-muted hover:text-primary transition-colors font-medium text-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </nav>

    <section
        class="relative min-h-screen flex items-center pt-24 pb-16 overflow-hidden bg-gradient-to-b from-gray-50 to-white">
        <!-- Animated Blobs -->
        <div class="hero-blob blob-1"></div>
        <div class="hero-blob blob-2"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10">
            {{ $slot }}
        </div>
    </section>

</body>

</html>
