# Artisan Migration Commands - Platform Kompetisi Quiz Online

## Perintah untuk Membuat Semua Migration

Berikut adalah perintah artisan yang digunakan untuk membuat semua migration di project ini:

---

## 1. Laravel Default Migrations

```bash
# Migrations ini sudah otomatis dibuat saat install Laravel
# Tidak perlu menjalankan perintah manual
```

---

## 2. Core Application Migrations (2025-11-17)

### Create Competitions Table
```bash
php artisan make:migration create_competitions_table
```

### Create Categories Table
```bash
php artisan make:migration create_categories_table
```

### Create Questions Table
```bash
php artisan make:migration create_questions_table
```

### Create Answers Table
```bash
php artisan make:migration create_answers_table
```

### Create Competition Participants Table
```bash
php artisan make:migration create_competition_participants_table
```

### Create Badges Table
```bash
php artisan make:migration create_badges_table
```

### Create Leaderboards Table
```bash
php artisan make:migration create_leaderboards_table
```

### Create Participant Answers Table
```bash
php artisan make:migration create_participant_answers_table
```

### Create User Badges Table
```bash
php artisan make:migration create_user_badges_table
```

---

## 3. Enhancement Migrations (2025-11-22 onwards)

### Add Scoring Fields to Competitions
```bash
php artisan make:migration add_scoring_fields_to_competitions --table=competitions
```

### Add Answered At and Score to Participant Answers
```bash
php artisan make:migration add_answered_at_and_score_to_participant_answers --table=participant_answers
```

### Add Slug to Competitions Table
```bash
php artisan make:migration add_slug_to_competitions_table --table=competitions
```

### Add Icon and Type to Badges Table
```bash
php artisan make:migration add_icon_and_type_to_badges_table --table=badges
```

---

## Complete Script - Membuat Semua Migration Sekaligus

Jika Anda ingin membuat ulang semua migration dari awal, gunakan script bash berikut:

### Untuk Linux/Mac:
```bash
#!/bin/bash

# Core Tables
php artisan make:migration create_competitions_table
php artisan make:migration create_categories_table
php artisan make:migration create_questions_table
php artisan make:migration create_answers_table
php artisan make:migration create_competition_participants_table
php artisan make:migration create_badges_table
php artisan make:migration create_leaderboards_table
php artisan make:migration create_participant_answers_table
php artisan make:migration create_user_badges_table

# Enhancement Migrations
php artisan make:migration add_scoring_fields_to_competitions --table=competitions
php artisan make:migration add_answered_at_and_score_to_participant_answers --table=participant_answers
php artisan make:migration add_slug_to_competitions_table --table=competitions
php artisan make:migration add_icon_and_type_to_badges_table --table=badges

echo "All migrations created successfully!"
```

### Untuk Windows (PowerShell):
```powershell
# Core Tables
php artisan make:migration create_competitions_table
php artisan make:migration create_categories_table
php artisan make:migration create_questions_table
php artisan make:migration create_answers_table
php artisan make:migration create_competition_participants_table
php artisan make:migration create_badges_table
php artisan make:migration create_leaderboards_table
php artisan make:migration create_participant_answers_table
php artisan make:migration create_user_badges_table

# Enhancement Migrations
php artisan make:migration add_scoring_fields_to_competitions --table=competitions
php artisan make:migration add_answered_at_and_score_to_participant_answers --table=participant_answers
php artisan make:migration add_slug_to_competitions_table --table=competitions
php artisan make:migration add_icon_and_type_to_badges_table --table=badges

Write-Host "All migrations created successfully!" -ForegroundColor Green
```

### Untuk Windows (CMD):
```cmd
@echo off

REM Core Tables
php artisan make:migration create_competitions_table
php artisan make:migration create_categories_table
php artisan make:migration create_questions_table
php artisan make:migration create_answers_table
php artisan make:migration create_competition_participants_table
php artisan make:migration create_badges_table
php artisan make:migration create_leaderboards_table
php artisan make:migration create_participant_answers_table
php artisan make:migration create_user_badges_table

REM Enhancement Migrations
php artisan make:migration add_scoring_fields_to_competitions --table=competitions
php artisan make:migration add_answered_at_and_score_to_participant_answers --table=participant_answers
php artisan make:migration add_slug_to_competitions_table --table=competitions
php artisan make:migration add_icon_and_type_to_badges_table --table=badges

echo All migrations created successfully!
```

---

## Migration Execution Commands

### Menjalankan Migration

```bash
# Run semua pending migrations
php artisan migrate

# Run migrations dengan verbose output
php artisan migrate --verbose

# Run migrations di environment tertentu
php artisan migrate --env=production

# Run migrations dengan force (tanpa konfirmasi di production)
php artisan migrate --force

# Run migrations step by step
php artisan migrate --step

# Pretend mode (lihat SQL tanpa execute)
php artisan migrate --pretend
```

### Rollback Migration

```bash
# Rollback batch terakhir
php artisan migrate:rollback

# Rollback dengan step tertentu
php artisan migrate:rollback --step=5

# Rollback semua migrations
php artisan migrate:reset

# Rollback dan re-run batch terakhir
php artisan migrate:refresh

# Rollback dan re-run dengan seeding
php artisan migrate:refresh --seed

# Rollback step tertentu
php artisan migrate:rollback --step=3
```

### Fresh Migration

```bash
# Drop semua tables dan re-migrate
php artisan migrate:fresh

# Fresh migration dengan seeding
php artisan migrate:fresh --seed

# Fresh migration untuk database tertentu
php artisan migrate:fresh --database=mysql
```

### Migration Status

```bash
# Lihat status semua migrations
php artisan migrate:status

# Lihat migrations yang belum dijalankan
php artisan migrate:status | grep "Pending"
```

---

## Advanced Migration Commands

### Membuat Migration dengan Opsi

```bash
# Membuat migration untuk create table
php artisan make:migration create_table_name

# Membuat migration untuk alter table
php artisan make:migration add_column_to_table_name --table=table_name

# Membuat migration dengan path custom
php artisan make:migration create_custom_table --path=database/migrations/custom

# Membuat migration dengan realpath
php artisan make:migration create_table --realpath

# Membuat migration dengan fullpath
php artisan make:migration create_table --fullpath
```

### Migration dengan Model

```bash
# Membuat model sekaligus migration
php artisan make:model Competition -m

# Membuat model dengan migration, factory, seeder, controller
php artisan make:model Competition -mfsc

# Membuat model dengan semua resources
php artisan make:model Competition --all
```

---

## Database Commands Terkait

### Schema Commands

```bash
# Dump database schema
php artisan schema:dump

# Dump schema dan prune old migrations
php artisan schema:dump --prune

# Dump schema untuk database tertentu
php artisan schema:dump --database=mysql
```

### Database Commands

```bash
# Lihat daftar database connections
php artisan db:show

# Lihat detail table tertentu
php artisan db:table users

# Monitor database queries
php artisan db:monitor

# Seed database
php artisan db:seed

# Seed class tertentu
php artisan db:seed --class=UserSeeder

# Wipe database (drop all tables)
php artisan db:wipe
```

---

## Troubleshooting Commands

### Jika Migration Error

```bash
# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize
php artisan optimize:clear

# Dump autoload
composer dump-autoload

# Coba migrate lagi
php artisan migrate
```

### Jika Migration Stuck

```bash
# Rollback paksa
php artisan migrate:rollback --force

# Reset paksa
php artisan migrate:reset --force

# Fresh paksa
php artisan migrate:fresh --force
```

### Jika Ada Conflict

```bash
# Lihat status
php artisan migrate:status

# Rollback step by step
php artisan migrate:rollback --step=1

# Fix manual di database, lalu:
php artisan migrate
```

---

## Best Practices

### 1. Sebelum Migrate di Production

```bash
# Backup database dulu!
# mysqldump -u user -p database_name > backup.sql

# Test di local/staging dulu
php artisan migrate --pretend

# Baru jalankan
php artisan migrate --force
```

### 2. Development Workflow

```bash
# Saat develop fitur baru
php artisan make:migration create_new_feature_table

# Edit migration file
# ...

# Test migration
php artisan migrate

# Jika ada error, rollback
php artisan migrate:rollback

# Fix migration file
# ...

# Migrate lagi
php artisan migrate
```

### 3. Team Collaboration

```bash
# Pull dari git
git pull origin main

# Check migration status
php artisan migrate:status

# Run pending migrations
php artisan migrate

# Jika conflict, koordinasi dengan team
```

---

## Quick Reference Table

| Command | Deskripsi | Use Case |
|---------|-----------|----------|
| `make:migration` | Buat file migration baru | Development |
| `migrate` | Jalankan pending migrations | Development/Production |
| `migrate:rollback` | Rollback batch terakhir | Fix error |
| `migrate:reset` | Rollback semua migrations | Reset database |
| `migrate:refresh` | Reset + re-migrate | Development |
| `migrate:fresh` | Drop all + migrate | Development |
| `migrate:status` | Lihat status migrations | Monitoring |
| `migrate --pretend` | Preview SQL tanpa execute | Testing |
| `migrate --step` | Migrate satu per satu | Debugging |
| `migrate --force` | Migrate tanpa konfirmasi | Production |

---

## Migration Naming Conventions

### Create Table
```bash
php artisan make:migration create_users_table
php artisan make:migration create_posts_table
```

### Add Column
```bash
php artisan make:migration add_status_to_users_table --table=users
php artisan make:migration add_published_at_to_posts_table --table=posts
```

### Remove Column
```bash
php artisan make:migration remove_status_from_users_table --table=users
php artisan make:migration drop_published_at_from_posts_table --table=posts
```

### Modify Column
```bash
php artisan make:migration modify_status_in_users_table --table=users
php artisan make:migration change_title_type_in_posts_table --table=posts
```

### Add Index
```bash
php artisan make:migration add_index_to_users_email --table=users
php artisan make:migration add_unique_index_to_posts_slug --table=posts
```

### Add Foreign Key
```bash
php artisan make:migration add_user_id_foreign_to_posts_table --table=posts
php artisan make:migration add_category_id_foreign_to_products_table --table=products
```

---

## Contoh Workflow Lengkap

```bash
# 1. Setup project baru
composer create-project laravel/laravel quiz-platform
cd quiz-platform

# 2. Setup database di .env
# DB_CONNECTION=mysql
# DB_DATABASE=quiz_platform
# ...

# 3. Buat semua migrations
php artisan make:migration create_competitions_table
php artisan make:migration create_categories_table
# ... (semua migration lainnya)

# 4. Edit migration files
# Tambahkan schema di masing-masing file

# 5. Run migrations
php artisan migrate

# 6. Jika ada error, rollback dan fix
php artisan migrate:rollback
# Fix error...
php artisan migrate

# 7. Buat seeders
php artisan make:seeder UserSeeder
php artisan make:seeder CompetitionSeeder
# ...

# 8. Run seeders
php artisan db:seed

# 9. Verify
php artisan migrate:status
php artisan db:show
php artisan db:table users

# 10. Development continues...
```

---

## Notes

⚠️ **PENTING:**
- Selalu backup database sebelum migrate di production
- Test migration di local/staging dulu
- Gunakan `--pretend` untuk preview SQL
- Jangan edit migration yang sudah di-commit dan di-run di production
- Buat migration baru untuk perubahan schema

✅ **TIPS:**
- Gunakan naming convention yang jelas
- Tambahkan comment di migration untuk dokumentasi
- Gunakan `--table` flag untuk alter table migrations
- Gunakan `--step` untuk rollback bertahap
- Commit migration files ke git

