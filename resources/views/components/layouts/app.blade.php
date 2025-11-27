<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnify Dashboard</title>

    <!-- 1. Fonts (Sesuai Landing Page) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Sora:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('mazer/assets/compiled/svg/favicon.svg') }}" type="image/x-icon">
    
    <!-- 2. Mazer compiled CSS (Bootstrap Base) -->
    <link rel="stylesheet" href="{{ asset('mazer/assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/assets/compiled/css/iconly.css') }}">

    <!-- 3. Bootstrap Icons (Diperlukan untuk Sidebar) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- 4. Tailwind CSS (Diperlukan untuk Sidebar Style Landing Page) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            // Penting: prefix ini mencegah konflik class Tailwind dengan Bootstrap Mazer
            // Namun, karena sidebar dibuat tanpa prefix, kita biarkan default dulu.
            // Jika layout dashboard berantakan, pertimbangkan menggunakan prefix atau scoped css.
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
                    }
                }
            }
        }
    </script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom CSS Fixes -->
    <style>
        /* Memastikan Sidebar Tailwind berada di atas elemen Mazer */
        #sidebar {
            z-index: 9999;
        }
        
        /* Penyesuaian Layout Mazer agar tidak tertutup sidebar Tailwind yang fixed */
        @media (min-width: 1024px) {
            #main {
                margin-left: 256px; /* 16rem (w-64) sesuai lebar sidebar */
                padding: 0;
            }
            footer {
                padding-left: 2rem;
                padding-right: 2rem;
            }
        }

        /* Fix font family override dari Bootstrap Mazer */
        body {
            font-family: 'Sora', 'Inter', sans-serif !important;
        }
    </style>
</head>

<body>
    <script src="{{ asset('mazer/assets/static/js/initTheme.js') }}"></script>
    
    <div id="app">
        
        <!-- Sidebar Include -->
        <!-- Pastikan path ini sesuai dengan lokasi file sidebar Anda -->
        @include('components.layouts.partials.sidebar') 

        <div id="main" class='layout-navbar navbar-fixed min-h-screen flex flex-col'>
            
            <!-- Navbar Header -->
            <header class="mb-3">
                @include('components.layouts.partials.navbar')
            </header>

            <!-- Main Content -->
            <div id="main-content" class="flex-1 px-6 pt-4">
                {{ $slot }}
            </div>

            <!-- Footer -->
            @include('components.layouts.partials.footer')
            
        </div>
    </div>

    <!-- Mazer JS -->
    <script src="{{ asset('mazer/assets/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('mazer/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('mazer/assets/compiled/js/app.js') }}"></script>

    <!-- Script Custom untuk Toggle Sidebar Mobile -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            // Toggle class translate
            if (sidebar.classList.contains('-translate-x-full')) {
                // Buka sidebar
                sidebar.classList.remove('-translate-x-full');
            } else {
                // Tutup sidebar
                sidebar.classList.add('-translate-x-full');
            }
        }
    </script>
</body>

</html>