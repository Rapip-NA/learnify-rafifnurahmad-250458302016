Learnify – Online Competition & Quiz Management Platform

Learnify adalah platform manajemen kompetisi dan ujian online (CBT) yang modern dan interaktif. Dibangun menggunakan Laravel 12, Livewire, Tailwind CSS, dan Vite, Learnify menyediakan sistem kompetisi, kuis real-time, leaderboard, serta dashboard admin & peserta yang mudah digunakan.

✨ Fitur Utama
1. Manajemen Kompetisi

Membuat kompetisi dengan tanggal mulai & selesai

Mengatur status kompetisi (active / inactive)

Upload soal, durasi, dan pengaturan tingkat kesulitan

2. Sistem Kuis Real-Time

Timer per kompetisi & per soal

Penilaian otomatis setelah peserta submit

Navigasi soal yang responsif dan simple

3. Leaderboard Otomatis

Urutan peserta berdasarkan skor & waktu submit

Update otomatis setelah kompetisi selesai

4. Dashboard Admin

Kelola peserta

Kelola kompetisi

Kelola soal

Pantau hasil & statistik

5. Dashboard Peserta

Melihat kompetisi yang tersedia

Mengikuti kuis

Melihat hasil kuis

Melihat peringkat

6. Authentication

Login & register

Role admin dan peserta

🛠️ Teknologi yang Digunakan

Laravel 12

Laravel Livewire

Tailwind CSS

Vite

SQLite/MySQL

PHP 8.2+

Node.js 18+

**Cara Instalasi**

Ikuti langkah berikut untuk menjalankan Learnify di komputer lokal:

1. Clone Repository
```
git clone https://github.com/Rapip-NA/learnify-rafifnurahmad-250458302016
cd learnify-rafifnurahmad-250458302016
```
2. Install Dependencies
Install PHP Dependencies
```
composer install
```

3. Buat File Environment
```
cp .env.example .env
```
Lalu edit file .env:

Untuk MySQL:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=learnify
DB_USERNAME=root
DB_PASSWORD=
```
4. Generate App Key
```
php artisan key:generate
```
5. Jalankan Migrasi & Seeder (Opsional)
```
php artisan migrate --seed
```

Jika ada role/pengguna default, seeder akan otomatis membuatnya.

6. Jalankan Server Backend
```
php artisan serve
```
7. Jalankan Server Frontend (Vite)
```
npm run dev
```
🎯 Akses Aplikasi

Setelah semua berjalan:

Backend:
http://localhost:8000

👥 Roles Default (Jika Disediakan oleh Seeder)
Role	Keterangan
Admin	Mengelola kompetisi, soal, peserta
Peserta	Mengikuti kuis & melihat leaderboard
Dashboard admin

Halaman kompetisi

Halaman pengerjaan kuis

Leaderboard
