# Design Document

## Overview

Dokumentasi ini dirancang untuk memberikan pemahaman menyeluruh tentang arsitektur dan modul-modul dalam sistem manajemen kompetisi/quiz berbasis Laravel 12 dan Livewire 3. Sistem ini mengimplementasikan platform kompetisi online dengan fitur gamifikasi, sistem scoring dinamis, dan role-based access control untuk tiga jenis pengguna: Admin, Peserta, dan Qualifier.

Dokumentasi akan mencakup:
- Penjelasan lengkap setiap modul (Models, Livewire Components, Services, Middleware, Commands)
- Panduan praktis menggunakan Artisan commands untuk membuat komponen baru
- Contoh kode dan best practices
- Diagram arsitektur dan database schema
- Troubleshooting tips

## Architecture

### System Architecture

Sistem menggunakan arsitektur MVC (Model-View-Controller) yang diperluas dengan Livewire untuk reactive components:

```
┌─────────────────────────────────────────────────────────────┐
│                        Presentation Layer                    │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐      │
│  │   Blade      │  │   Livewire   │  │   Alpine.js  │      │
│  │   Views      │  │  Components  │  │              │      │
│  └──────────────┘  └──────────────┘  └──────────────┘      │
└─────────────────────────────────────────────────────────────┘
                            ↕
┌─────────────────────────────────────────────────────────────┐
│                      Application Layer                       │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐      │
│  │  Middleware  │  │   Services   │  │   Commands   │      │
│  │  (CheckRole) │  │   (Badge,    │  │   (Artisan)  │      │
│  │              │  │   Scoring)   │  │              │      │
│  └──────────────┘  └──────────────┘  └──────────────┘      │
└─────────────────────────────────────────────────────────────┘
                            ↕
┌─────────────────────────────────────────────────────────────┐
│                         Domain Layer                         │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐      │
│  │   Eloquent   │  │  Eloquent    │  │  Business    │      │
│  │   Models     │  │  Relations   │  │  Logic       │      │
│  └──────────────┘  └──────────────┘  └──────────────┘      │
└─────────────────────────────────────────────────────────────┘
                            ↕
┌─────────────────────────────────────────────────────────────┐
│                      Infrastructure Layer                    │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐      │
│  │   Database   │  │    Cache     │  │   Storage    │      │
│  │   (SQLite)   │  │              │  │              │      │
│  └──────────────┘  └──────────────┘  └──────────────┘      │
└─────────────────────────────────────────────────────────────┘
```

### Technology Stack

- **Framework**: Laravel 12
- **Frontend**: Livewire 3, Alpine.js, Tailwind CSS (Mazer Template)
- **Database**: SQLite (development), MySQL/PostgreSQL (production ready)
- **Testing**: Pest PHP
- **Authentication**: Laravel Breeze (customized)

### Module Organization

```
app/
├── Console/Commands/          # Artisan commands
├── Http/
│   ├── Controllers/          # Traditional controllers (minimal)
│   └── Middleware/           # Request filters (CheckRole)
├── Livewire/
│   ├── Auth/                 # Authentication components
│   └── Features/
│       ├── Admin/            # Admin-specific features
│       ├── Peserta/          # Participant features
│       └── Qualifier/        # Qualifier features
├── Models/                   # Eloquent models
├── Services/                 # Business logic services
└── Providers/                # Service providers
```

## Components and Interfaces

### 1. Models (Eloquent ORM)

#### User Model
**Purpose**: Mengelola data pengguna dengan tiga role berbeda

**Relationships**:
- `hasMany` Competition (as creator)
- `hasMany` CompetitionParticipant
- `hasMany` Question (as verifier)
- `hasMany` Leaderboard
- `belongsToMany` Badge (through UserBadge)

**Key Methods**:
- `createdCompetitions()`: Kompetisi yang dibuat user
- `competitionParticipants()`: Partisipasi user dalam kompetisi
- `badges()`: Badge yang dimiliki user

#### Competition Model
**Purpose**: Mengelola data kompetisi/quiz

**Relationships**:
- `belongsTo` User (creator)
- `hasMany` Question
- `hasMany` CompetitionParticipant
- `hasMany` Leaderboard

**Key Methods**:
- `isExpired()`: Cek apakah kompetisi sudah expired
- `scopeExpired()`: Query scope untuk kompetisi expired
- `scopeActiveAndNotExpired()`: Query scope untuk kompetisi aktif

**Attributes**:
- `speed_bonus_enabled`: Boolean untuk fitur bonus kecepatan
- `penalty_enabled`: Boolean untuk fitur penalti jawaban salah
- `duration_seconds`: Durasi kompetisi dalam detik

#### Question Model
**Purpose**: Mengelola soal-soal kompetisi

**Relationships**:
- `belongsTo` Competition
- `belongsTo` Category
- `belongsTo` User (verifier)
- `hasMany` Answer
- `hasMany` ParticipantAnswer

**Attributes**:
- `difficulty_level`: Tingkat kesulitan (easy, medium, hard)
- `point_weight`: Bobot poin soal
- `validation_status`: Status validasi (pending, approved, rejected)

#### Badge Model
**Purpose**: Mengelola badge/achievement system

**Relationships**:
- `belongsToMany` User (through UserBadge)

**Attributes**:
- `condition`: JSON field berisi kondisi untuk mendapatkan badge
- `badge_type`: Tipe badge (achievement, milestone, special)
- `icon`: Icon badge

**Condition Types**:
```json
{
  "type": "first_completion",
  "required_count": 1
}

{
  "type": "perfect_score",
  "required_count": 3
}

{
  "type": "completion_count",
  "required_count": 10
}

{
  "type": "speed_completion",
  "time_percentage": 50
}

{
  "type": "top_scorer",
  "top_position": 3
}
```

#### Leaderboard Model
**Purpose**: Mengelola ranking peserta per kompetisi

**Relationships**:
- `belongsTo` Competition
- `belongsTo` User

**Key Methods**:
- `getPositionBadgeAttribute()`: Accessor untuk emoji/icon posisi (🥇🥈🥉)

### 2. Livewire Components

#### Admin Components

**Dashboard.php**
- **Purpose**: Menampilkan statistik sistem dan analytics
- **Key Methods**:
  - `getDashboardData()`: Mengambil semua data statistik
- **Data Provided**:
  - Total users, competitions, questions, participations
  - Competition breakdown by status
  - Top 5 competitions by participation
  - User breakdown by role
  - Performance metrics (avg score, completion rate)

**Competition CRUD Components**
- `CompetitionIndex.php`: List semua kompetisi
- `CompetitionCreate.php`: Form create kompetisi baru
- `CompetitionEdit.php`: Form edit kompetisi
- `CompetitionView.php`: Detail kompetisi

**Question CRUD Components**
- `QuestionIndex.php`: List soal per kompetisi
- `QuestionCreate.php`: Form create soal
- `QuestionEdit.php`: Form edit soal
- `QuestionView.php`: Detail soal dengan jawaban

**Badge CRUD Components**
- `BadgeIndex.php`: List semua badge
- `BadgeCreate.php`: Form create badge
- `BadgeEdit.php`: Form edit badge
- `BadgeView.php`: Detail badge dan penerima

#### Peserta Components

**CompetitionList.php**
- **Purpose**: Menampilkan daftar kompetisi yang tersedia
- **Features**:
  - Filter kompetisi aktif
  - Tampilkan status partisipasi user
  - Enrollment ke kompetisi

**CompetitionQuiz.php**
- **Purpose**: Interface mengerjakan quiz
- **Key Properties**:
  - `$currentQuestionIndex`: Index soal saat ini
  - `$selectedAnswer`: Jawaban yang dipilih
  - `$remainingSeconds`: Sisa waktu
  - `$questionStartedAt`: Waktu mulai soal (untuk speed bonus)

- **Key Methods**:
  - `selectAnswer($answerId)`: Pilih jawaban
  - `submitAnswer()`: Submit jawaban dengan scoring
  - `nextQuestion()`: Navigasi ke soal berikutnya
  - `previousQuestion()`: Navigasi ke soal sebelumnya
  - `finishCompetition()`: Selesaikan kompetisi
  - `autoFinishCompetition()`: Auto-finish saat waktu habis
  - `calculateRemainingTime()`: Hitung sisa waktu
  - `updateProgress()`: Update progress percentage

- **Integration**:
  - Menggunakan `ScoringService` untuk kalkulasi skor
  - Menggunakan `BadgeService` untuk award badge otomatis
  - Real-time timer dengan wire:poll

**CompetitionResult.php**
- **Purpose**: Menampilkan hasil quiz
- **Features**:
  - Total score dan ranking
  - Review jawaban (benar/salah)
  - Badge yang didapat
  - Leaderboard kompetisi

**MyBadges.php**
- **Purpose**: Menampilkan badge collection user
- **Features**:
  - List badge yang sudah didapat
  - Progress badge yang belum didapat
  - Badge statistics

#### Qualifier Components

**AnswerValidation.php**
- **Purpose**: Validasi jawaban peserta (untuk soal essay/subjektif)
- **Features**:
  - Review jawaban peserta
  - Approve/reject jawaban
  - Berikan feedback

### 3. Services

#### ScoringService

**Purpose**: Mengelola kalkulasi skor dengan berbagai faktor

**Key Methods**:

```php
calculateAnswerScore(
    Answer $answer,
    Question $question,
    Competition $competition,
    int $timeSpent
): float
```
- Kalkulasi skor untuk satu jawaban
- Pertimbangkan: benar/salah, speed bonus, penalty
- Return: skor yang didapat (bisa negatif jika ada penalty)

```php
calculateSpeedBonus(
    int $timeSpent,
    int $threshold,
    float $baseScore,
    float $bonusPercentage
): float
```
- Kalkulasi bonus kecepatan (linear decrease)
- Formula: `bonus = baseScore * (bonusPercentage / 100) * (1 - timeSpent / threshold)`
- Return: bonus points (0 jika melebihi threshold)

```php
calculateTotalScore(CompetitionParticipant $participant): float
```
- Kalkulasi total skor peserta
- Sum semua score_earned dari ParticipantAnswer
- Return: total skor (minimum 0)

```php
recalculateParticipantScores(CompetitionParticipant $participant): void
```
- Re-kalkulasi semua skor peserta
- Berguna saat setting kompetisi berubah
- Update database dengan skor baru

**Scoring Logic**:
1. **Jawaban Benar**:
   - Base score = `question.point_weight`
   - Speed bonus (jika enabled) = `baseScore * (bonusPercentage / 100) * speedRatio`
   - Total = base + speed bonus

2. **Jawaban Salah**:
   - Jika penalty enabled: `-baseScore * (penaltyPercentage / 100)`
   - Jika penalty disabled: `0`

3. **Total Score**:
   - Sum semua score_earned
   - Minimum 0 (tidak boleh negatif)

#### BadgeService

**Purpose**: Mengelola sistem badge/achievement otomatis

**Key Methods**:

```php
checkAndAwardBadges(User $user): array
```
- Cek semua kondisi badge untuk user
- Award badge yang memenuhi syarat
- Return: array badge yang baru didapat

```php
awardBadge(User $user, Badge $badge): UserBadge
```
- Award badge ke user
- Catat waktu awarded_at
- Return: UserBadge instance

```php
getBadgeProgress(User $user, Badge $badge): array
```
- Hitung progress user untuk badge tertentu
- Return: `['current' => int, 'required' => int, 'percentage' => float]`

**Badge Condition Checkers**:
- `checkFirstCompletion()`: Cek apakah user sudah menyelesaikan 1 kompetisi
- `checkPerfectScore()`: Cek apakah user punya N kompetisi dengan skor sempurna
- `checkCompletionCount()`: Cek apakah user sudah menyelesaikan N kompetisi
- `checkSpeedCompletion()`: Cek apakah user pernah selesai dalam X% waktu
- `checkTopScorer()`: Cek apakah user pernah masuk top N di kompetisi

### 4. Middleware

#### CheckRole

**Purpose**: Middleware untuk role-based access control

**Usage**:
```php
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin routes
});

Route::middleware(['auth', 'role:peserta'])->group(function () {
    // Peserta routes
});

Route::middleware(['auth', 'role:qualifier'])->group(function () {
    // Qualifier routes
});
```

**Logic**:
1. Cek apakah user authenticated
2. Cek apakah role user ada dalam allowed roles
3. Jika tidak, redirect ke dashboard sesuai role user
4. Jika ya, lanjutkan request

**Redirect Map**:
- `admin` → `/admin/dashboard`
- `peserta` → `/peserta/dashboard`
- `qualifier` → `/qualifier/dashboard`

### 5. Console Commands

#### UpdateExpiredCompetitions

**Purpose**: Update status kompetisi yang sudah expired

**Command**: `php artisan update:expired-competitions`

**Logic**:
1. Cari kompetisi dengan status 'active' atau 'draft'
2. Filter yang end_date < now()
3. Update status menjadi 'inactive'
4. Log jumlah kompetisi yang diupdate

**Scheduling**: Bisa dijadwalkan di `app/Console/Kernel.php`:
```php
$schedule->command('update:expired-competitions')->hourly();
```

## Data Models

### Entity Relationship Diagram

```
┌─────────────┐         ┌──────────────────┐         ┌─────────────┐
│    User     │────────>│   Competition    │────────>│  Question   │
│             │ creates │                  │ has     │             │
│ - id        │         │ - id             │         │ - id        │
│ - name      │         │ - title          │         │ - question  │
│ - email     │         │ - description    │         │ - difficulty│
│ - role      │         │ - start_date     │         │ - points    │
└─────────────┘         │ - end_date       │         └─────────────┘
      │                 │ - status         │               │
      │                 │ - created_by     │               │
      │                 └──────────────────┘               │
      │                         │                          │
      │                         │                          │
      │                         v                          v
      │                 ┌──────────────────┐         ┌─────────────┐
      │                 │ Competition      │         │   Answer    │
      │                 │ Participant      │         │             │
      │                 │                  │         │ - id        │
      │                 │ - user_id        │         │ - question  │
      │                 │ - competition_id │         │ - text      │
      │                 │ - started_at     │         │ - is_correct│
      │                 │ - finished_at    │         └─────────────┘
      │                 │ - total_score    │               │
      │                 │ - progress_%     │               │
      │                 └──────────────────┘               │
      │                         │                          │
      │                         v                          │
      │                 ┌──────────────────┐               │
      │                 │ Participant      │<──────────────┘
      │                 │ Answer           │
      │                 │                  │
      │                 │ - participant_id │
      │                 │ - question_id    │
      │                 │ - answer_id      │
      │                 │ - is_correct     │
      │                 │ - time_spent     │
      │                 │ - score_earned   │
      │                 └──────────────────┘
      │
      │                 ┌──────────────────┐
      └────────────────>│  Leaderboard     │
      │                 │                  │
      │                 │ - user_id        │
      │                 │ - competition_id │
      │                 │ - score          │
      │                 │ - rank           │
      │                 └──────────────────┘
      │
      │                 ┌──────────────────┐         ┌─────────────┐
      └────────────────>│   UserBadge      │────────>│   Badge     │
                        │                  │         │             │
                        │ - user_id        │         │ - id        │
                        │ - badge_id       │         │ - name      │
                        │ - awarded_at     │         │ - condition │
                        └──────────────────┘         │ - icon      │
                                                     └─────────────┘
```

### Database Tables

#### users
```sql
- id: bigint (PK)
- name: string
- email: string (unique)
- password: string (hashed)
- role: enum('admin', 'peserta', 'qualifier')
- created_at: timestamp
- updated_at: timestamp
```

#### competitions
```sql
- id: bigint (PK)
- title: string
- description: text
- slug: string (unique)
- start_date: datetime
- end_date: datetime
- duration_seconds: integer
- status: enum('draft', 'active', 'inactive')
- speed_bonus_enabled: boolean
- speed_bonus_percentage: decimal(5,2)
- speed_bonus_time_threshold: integer
- penalty_enabled: boolean
- penalty_percentage: decimal(5,2)
- created_by: bigint (FK -> users.id)
- created_at: timestamp
- updated_at: timestamp
```

#### questions
```sql
- id: bigint (PK)
- competition_id: bigint (FK -> competitions.id)
- category_id: bigint (FK -> categories.id)
- question_text: text
- difficulty_level: enum('easy', 'medium', 'hard')
- point_weight: integer
- verified_by: bigint (FK -> users.id, nullable)
- validation_status: enum('pending', 'approved', 'rejected')
- created_at: timestamp
- updated_at: timestamp
```

#### answers
```sql
- id: bigint (PK)
- question_id: bigint (FK -> questions.id)
- answer_text: text
- is_correct: boolean
- created_at: timestamp
- updated_at: timestamp
```

#### competition_participants
```sql
- id: bigint (PK)
- user_id: bigint (FK -> users.id)
- competition_id: bigint (FK -> competitions.id)
- started_at: datetime
- finished_at: datetime (nullable)
- total_score: decimal(8,2)
- progress_percentage: decimal(5,2)
- created_at: timestamp
- updated_at: timestamp
- UNIQUE(user_id, competition_id)
```

#### participant_answers
```sql
- id: bigint (PK)
- competition_participant_id: bigint (FK -> competition_participants.id)
- question_id: bigint (FK -> questions.id)
- answer_id: bigint (FK -> answers.id)
- is_correct: boolean
- time_spent: integer (seconds)
- answered_at: datetime
- score_earned: decimal(8,2)
- validation_status: enum('pending', 'approved', 'rejected')
- verified_by: bigint (FK -> users.id, nullable)
- created_at: timestamp
- updated_at: timestamp
```

#### badges
```sql
- id: bigint (PK)
- name: string
- description: text
- condition: json
- icon: string
- image_url: string (nullable)
- badge_type: enum('achievement', 'milestone', 'special')
- created_at: timestamp
- updated_at: timestamp
```

#### user_badges
```sql
- id: bigint (PK)
- user_id: bigint (FK -> users.id)
- badge_id: bigint (FK -> badges.id)
- awarded_at: datetime
- UNIQUE(user_id, badge_id)
```

#### leaderboards
```sql
- id: bigint (PK)
- competition_id: bigint (FK -> competitions.id)
- user_id: bigint (FK -> users.id)
- score: decimal(8,2)
- rank: integer
- updated_at: timestamp
- UNIQUE(competition_id, user_id)
```

#### categories
```sql
- id: bigint (PK)
- name: string
- description: text (nullable)
- created_at: timestamp
- updated_at: timestamp
```

## Correctness Properties

*A property is a characteristic or behavior that should hold true across all valid executions of a system-essentially, a formal statement about what the system should do. Properties serve as the bridge between human-readable specifications and machine-verifiable correctness guarantees.*

### Property Reflection

Setelah menganalisis semua acceptance criteria, sebagian besar requirements adalah tentang konten dokumentasi yang harus ada (examples), bukan properties yang berlaku untuk semua input. Dokumentasi adalah artifact statis, bukan sistem yang memproses input dinamis. Oleh karena itu, sebagian besar testable criteria adalah examples yang memverifikasi keberadaan konten tertentu.

Properties yang tersisa adalah yang berlaku untuk semua module/component types:
- Property tentang struktur dokumentasi untuk semua module types
- Property tentang konsistensi bahasa dan terminology
- Property tentang kelengkapan dokumentasi untuk setiap tipe komponen

Beberapa properties yang awalnya teridentifikasi sebenarnya adalah examples karena mereka mengecek konten spesifik, bukan aturan umum.

### Correctness Properties

Property 1: Module documentation completeness
*For any* module type (Model, Livewire Component, Service, Middleware, Command), the documentation should include: purpose description, file structure, relationships/dependencies, and code examples
**Validates: Requirements 1.2, 1.3, 1.5**

Property 2: Artisan command documentation completeness
*For any* Laravel component type that can be generated via Artisan, the documentation should include the command syntax, common flags/options, and usage examples
**Validates: Requirements 2.5, 2.6**

Property 3: Database relationship documentation
*For any* Eloquent model documented, all relationships (hasMany, belongsTo, belongsToMany, etc.) should be explicitly documented with their target models
**Validates: Requirements 1.4, 8.2**

Property 4: Cross-reference consistency
*For any* module that references another module, a corresponding cross-reference should exist in the referenced module's documentation
**Validates: Requirements 6.4**

Property 5: Indonesian language consistency
*For any* explanatory text in the documentation (excluding code examples and command syntax), the text should be in Indonesian language
**Validates: Requirements 9.1, 9.3**

Property 6: Terminology consistency
*For any* technical term used in the documentation, the same Indonesian translation should be used consistently throughout all sections
**Validates: Requirements 9.5**

Property 7: Database table documentation completeness
*For any* database table mentioned in the system, the documentation should include all columns with their data types and constraints
**Validates: Requirements 8.1**

Property 8: Best practices inclusion
*For any* module type documented, the documentation should include a best practices section with at least one recommendation
**Validates: Requirements 10.5**

Property 9: Real project examples
*For any* code example in the documentation, the example should reference actual components from the project (not generic placeholders)
**Validates: Requirements 7.1**

## Error Handling

### Documentation Generation Errors

**Missing Source Files**:
- **Error**: File atau module yang direferensikan tidak ditemukan
- **Handling**: Log warning, skip module, lanjutkan dengan module lain
- **Prevention**: Validate file existence sebelum generate dokumentasi

**Invalid Code Syntax**:
- **Error**: Code example mengandung syntax error
- **Handling**: Validate syntax sebelum include dalam dokumentasi
- **Prevention**: Test semua code examples

**Broken Cross-References**:
- **Error**: Link ke section atau module yang tidak ada
- **Handling**: Validate semua internal links
- **Prevention**: Generate table of contents otomatis

### Artisan Command Errors

**Command Not Found**:
- **Error**: `Command "make:xyz" is not defined`
- **Solution**: Pastikan menggunakan Laravel version yang tepat
- **Documentation**: List command availability per Laravel version

**Permission Denied**:
- **Error**: Cannot create file/directory
- **Solution**: Check file permissions, run with appropriate user
- **Documentation**: Include permission requirements

**Class Already Exists**:
- **Error**: Class already exists
- **Solution**: Use `--force` flag atau rename class
- **Documentation**: Explain force flag usage

### Database Migration Errors

**Migration Already Ran**:
- **Error**: Migration already executed
- **Solution**: Use `migrate:rollback` atau `migrate:fresh`
- **Documentation**: Explain migration states

**Foreign Key Constraint**:
- **Error**: Cannot add foreign key constraint
- **Solution**: Ensure referenced table exists first
- **Documentation**: Explain migration order importance

## Testing Strategy

### Documentation Testing Approach

Karena ini adalah dokumentasi (bukan kode yang dieksekusi), testing akan fokus pada:

1. **Content Validation Tests**:
   - Verify semua required sections ada
   - Verify code examples valid syntax
   - Verify cross-references tidak broken

2. **Property-Based Tests**:
   - Test properties yang didefinisikan di atas
   - Generate random module types dan verify completeness
   - Test terminology consistency across sections

3. **Manual Review**:
   - Review readability dan clarity
   - Verify Indonesian language quality
   - Check technical accuracy

### Property-Based Testing

**Library**: Tidak applicable untuk dokumentasi statis. Properties akan diverifikasi melalui automated content checks.

**Validation Approach**:
- Parse markdown documentation
- Extract sections dan content
- Verify properties menggunakan assertions
- Generate report of missing/incomplete sections

### Content Validation Tests

**Test Categories**:

1. **Structure Tests**:
   - Verify table of contents exists
   - Verify all major sections present
   - Verify consistent heading hierarchy

2. **Completeness Tests**:
   - For each module type, verify all required subsections
   - For each Artisan command, verify syntax and examples
   - For each model, verify relationships documented

3. **Code Example Tests**:
   - Extract all code blocks
   - Validate PHP syntax
   - Verify examples reference real project files

4. **Language Tests**:
   - Verify Indonesian text in explanations
   - Verify English in code examples
   - Check terminology consistency

5. **Link Tests**:
   - Verify all internal links valid
   - Verify all cross-references exist
   - Check for broken references

### Testing Tools

- **Markdown Parser**: Parse dan analyze struktur dokumentasi
- **PHP Syntax Validator**: Validate code examples
- **Link Checker**: Verify internal links
- **Language Detector**: Verify Indonesian/English usage
- **Custom Validators**: Check properties dan completeness

## Implementation Guide

### Panduan Lengkap Artisan Commands

#### 1. Membuat Model

**Command Dasar**:
```bash
php artisan make:model NamaModel
```

**Dengan Migration**:
```bash
php artisan make:model NamaModel -m
```

**Dengan Factory dan Seeder**:
```bash
php artisan make:model NamaModel -mfs
```

**Dengan Semua Resource**:
```bash
php artisan make:model NamaModel --all
```

**Flags yang Tersedia**:
- `-m, --migration`: Buat migration file
- `-f, --factory`: Buat factory file
- `-s, --seeder`: Buat seeder file
- `-c, --controller`: Buat controller
- `-r, --resource`: Buat resource controller
- `--api`: Buat API controller
- `--all`: Buat semua (migration, factory, seeder, controller)
- `--force`: Overwrite jika file sudah ada

**Contoh dari Project**:
```bash
# Membuat model Competition dengan migration
php artisan make:model Competition -m

# Membuat model User dengan semua resource
php artisan make:model User --all

# Membuat model Badge dengan factory dan seeder
php artisan make:model Badge -mfs
```

**Best Practices**:
- Gunakan singular noun untuk nama model (User, bukan Users)
- Gunakan PascalCase (Competition, bukan competition)
- Buat migration bersamaan dengan model (`-m` flag)
- Definisikan relationships di model setelah dibuat

#### 2. Membuat Migration

**Command Dasar**:
```bash
php artisan make:migration create_nama_table
```

**Untuk Modify Table**:
```bash
php artisan make:migration add_column_to_table_name
```

**Contoh dari Project**:
```bash
# Membuat table competitions
php artisan make:migration create_competitions_table

# Menambah kolom scoring ke competitions
php artisan make:migration add_scoring_fields_to_competitions

# Menambah slug ke competitions
php artisan make:migration add_slug_to_competitions_table
```

**Migration Patterns**:

**Create Table**:
```php
Schema::create('competitions', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->text('description');
    $table->dateTime('start_date');
    $table->dateTime('end_date');
    $table->enum('status', ['draft', 'active', 'inactive']);
    $table->foreignId('created_by')->constrained('users');
    $table->timestamps();
});
```

**Add Columns**:
```php
Schema::table('competitions', function (Blueprint $table) {
    $table->boolean('speed_bonus_enabled')->default(false);
    $table->decimal('speed_bonus_percentage', 5, 2)->nullable();
});
```

**Add Foreign Key**:
```php
$table->foreignId('user_id')->constrained()->onDelete('cascade');
// atau
$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
```

**Running Migrations**:
```bash
# Run semua pending migrations
php artisan migrate

# Rollback last batch
php artisan migrate:rollback

# Rollback semua dan re-run
php artisan migrate:fresh

# Rollback semua, re-run, dan seed
php artisan migrate:fresh --seed

# Check migration status
php artisan migrate:status
```

#### 3. Membuat Livewire Component

**Command Dasar**:
```bash
php artisan make:livewire NamaComponent
```

**Inline Component** (single file):
```bash
php artisan make:livewire NamaComponent --inline
```

**Dengan Nested Directory**:
```bash
php artisan make:livewire Features/Admin/Dashboard
```

**Contoh dari Project**:
```bash
# Admin Dashboard
php artisan make:livewire Features/Admin/Dashboard

# Competition CRUD
php artisan make:livewire Features/Admin/Competitions/CompetitionIndex
php artisan make:livewire Features/Admin/Competitions/CompetitionCreate
php artisan make:livewire Features/Admin/Competitions/CompetitionEdit
php artisan make:livewire Features/Admin/Competitions/CompetitionView

# Peserta Features
php artisan make:livewire Features/Peserta/Competitions/CompetitionList
php artisan make:livewire Features/Peserta/Competitions/CompetitionQuiz
php artisan make:livewire Features/Peserta/Competitions/CompetitionResult

# Auth Components
php artisan make:livewire Auth/Login
php artisan make:livewire Auth/Register
```

**Struktur Livewire Component**:

**Class File** (`app/Livewire/Features/Admin/Dashboard.php`):
```php
<?php

namespace App\Livewire\Features\Admin;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class Dashboard extends Component
{
    #[Layout('components.layouts.app')]
    #[Title('Admin Dashboard')]
    
    public $propertyName;
    
    public function mount()
    {
        // Initialize component
    }
    
    public function methodName()
    {
        // Handle actions
    }
    
    public function render()
    {
        return view('livewire.features.admin.dashboard');
    }
}
```

**View File** (`resources/views/livewire/features/admin/dashboard.blade.php`):
```blade
<div>
    <h1>Dashboard</h1>
    
    <button wire:click="methodName">Click Me</button>
    
    <input type="text" wire:model="propertyName">
</div>
```

**Livewire Directives**:
- `wire:model`: Two-way data binding
- `wire:click`: Handle click events
- `wire:submit`: Handle form submission
- `wire:loading`: Show loading state
- `wire:poll`: Auto-refresh component
- `wire:key`: Unique key untuk list items

#### 4. Membuat Controller

**Command Dasar**:
```bash
php artisan make:controller NamaController
```

**Resource Controller**:
```bash
php artisan make:controller NamaController --resource
```

**API Controller**:
```bash
php artisan make:controller NamaController --api
```

**Dengan Model**:
```bash
php artisan make:controller NamaController --model=NamaModel
```

**Contoh**:
```bash
php artisan make:controller CompetitionController --resource
php artisan make:controller Api/CompetitionController --api
```

**Note**: Project ini menggunakan Livewire, jadi traditional controllers minimal digunakan.

#### 5. Membuat Middleware

**Command**:
```bash
php artisan make:middleware NamaMiddleware
```

**Contoh dari Project**:
```bash
php artisan make:middleware CheckRole
```

**Implementasi CheckRole**:
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        if (!in_array(auth()->user()->role, $roles)) {
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
```

**Register Middleware** (`bootstrap/app.php`):
```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'role' => \App\Http\Middleware\CheckRole::class,
    ]);
})
```

**Usage di Routes**:
```php
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', Dashboard::class);
});
```

#### 6. Membuat Service Class

**Command** (tidak ada command khusus, buat manual):
```bash
# Buat file di app/Services/
```

**Contoh dari Project**:

**ScoringService.php**:
```php
<?php

namespace App\Services;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Competition;

class ScoringService
{
    public function calculateAnswerScore(
        Answer $answer,
        Question $question,
        Competition $competition,
        int $timeSpent
    ): float {
        // Scoring logic
    }
    
    public function calculateSpeedBonus(
        int $timeSpent,
        int $threshold,
        float $baseScore,
        float $bonusPercentage
    ): float {
        // Speed bonus calculation
    }
}
```

**Usage**:
```php
$scoringService = new ScoringService();
$score = $scoringService->calculateAnswerScore($answer, $question, $competition, $timeSpent);
```

**Best Practices**:
- Satu service untuk satu domain logic
- Inject dependencies via constructor
- Return types yang jelas
- Dokumentasi method dengan PHPDoc

#### 7. Membuat Seeder

**Command**:
```bash
php artisan make:seeder NamaSeeder
```

**Contoh dari Project**:
```bash
php artisan make:seeder CompetitionSeeder
php artisan make:seeder BadgeSeeder
php artisan make:seeder QuestionAndAnswerSeeder
```

**Implementasi Seeder**:
```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Competition;

class CompetitionSeeder extends Seeder
{
    public function run(): void
    {
        Competition::create([
            'title' => 'Laravel Quiz',
            'description' => 'Test your Laravel knowledge',
            'start_date' => now(),
            'end_date' => now()->addDays(7),
            'status' => 'active',
            'created_by' => 1,
        ]);
    }
}
```

**Register di DatabaseSeeder**:
```php
public function run(): void
{
    $this->call([
        CompetitionSeeder::class,
        BadgeSeeder::class,
        QuestionAndAnswerSeeder::class,
    ]);
}
```

**Running Seeders**:
```bash
# Run all seeders
php artisan db:seed

# Run specific seeder
php artisan db:seed --class=CompetitionSeeder

# Fresh migration dengan seed
php artisan migrate:fresh --seed
```

#### 8. Membuat Factory

**Command**:
```bash
php artisan make:factory NamaFactory
```

**Dengan Model**:
```bash
php artisan make:factory NamaFactory --model=NamaModel
```

**Contoh**:
```bash
php artisan make:factory CompetitionFactory --model=Competition
```

**Implementasi Factory**:
```php
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class CompetitionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'start_date' => now(),
            'end_date' => now()->addDays(7),
            'status' => 'active',
            'created_by' => User::factory(),
        ];
    }
}
```

**Usage**:
```php
// Create single
$competition = Competition::factory()->create();

// Create multiple
$competitions = Competition::factory()->count(10)->create();

// With specific attributes
$competition = Competition::factory()->create([
    'status' => 'draft',
]);
```

#### 9. Membuat Command

**Command**:
```bash
php artisan make:command NamaCommand
```

**Contoh dari Project**:
```bash
php artisan make:command UpdateExpiredCompetitions
```

**Implementasi**:
```php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Competition;

class UpdateExpiredCompetitions extends Command
{
    protected $signature = 'update:expired-competitions';
    protected $description = 'Update status kompetisi yang sudah expired';

    public function handle()
    {
        $this->info('Mengecek kompetisi yang sudah expired...');
        
        $expiredCompetitions = Competition::whereIn('status', ['active', 'draft'])
            ->where('end_date', '<', now())
            ->get();

        foreach ($expiredCompetitions as $competition) {
            $competition->update(['status' => 'inactive']);
            $this->line("- {$competition->title} updated");
        }

        $this->info("✓ Total {$expiredCompetitions->count()} kompetisi diupdate.");
        
        return 0;
    }
}
```

**Running Command**:
```bash
php artisan update:expired-competitions
```

**Schedule Command** (`app/Console/Kernel.php` - Laravel 10 atau `routes/console.php` - Laravel 11+):
```php
$schedule->command('update:expired-competitions')->hourly();
```

#### 10. Membuat Request (Form Validation)

**Command**:
```bash
php artisan make:request NamaRequest
```

**Contoh**:
```bash
php artisan make:request StoreCompetitionRequest
```

**Implementasi**:
```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompetitionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:draft,active,inactive',
        ];
    }
    
    public function messages(): array
    {
        return [
            'title.required' => 'Judul kompetisi wajib diisi',
            'end_date.after' => 'Tanggal selesai harus setelah tanggal mulai',
        ];
    }
}
```

**Usage di Controller**:
```php
public function store(StoreCompetitionRequest $request)
{
    $validated = $request->validated();
    Competition::create($validated);
}
```

#### 11. Membuat Policy

**Command**:
```bash
php artisan make:policy NamaPolicy
```

**Dengan Model**:
```bash
php artisan make:policy CompetitionPolicy --model=Competition
```

**Implementasi**:
```php
<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Competition;

class CompetitionPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Competition $competition): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function update(User $user, Competition $competition): bool
    {
        return $user->role === 'admin' && $user->id === $competition->created_by;
    }

    public function delete(User $user, Competition $competition): bool
    {
        return $user->role === 'admin' && $user->id === $competition->created_by;
    }
}
```

**Usage**:
```php
// Di controller atau Livewire
$this->authorize('update', $competition);

// Di Blade
@can('update', $competition)
    <button>Edit</button>
@endcan
```

### Troubleshooting Common Issues

#### 1. Class Not Found

**Error**:
```
Class 'App\Livewire\Features\Admin\Dashboard' not found
```

**Solutions**:
- Run `composer dump-autoload`
- Check namespace di file class
- Check file location sesuai namespace
- Clear cache: `php artisan clear-compiled`

#### 2. Migration Issues

**Error**: "SQLSTATE[HY000]: General error: 1 no such table"

**Solutions**:
- Run migrations: `php artisan migrate`
- Check migration order (foreign keys)
- Use `migrate:fresh` untuk reset database

**Error**: "Migration already ran"

**Solutions**:
- Use `migrate:rollback` untuk undo
- Use `migrate:fresh` untuk reset semua
- Check `migrations` table di database

#### 3. Livewire Issues

**Error**: "Component not found"

**Solutions**:
- Check component name di view: `<livewire:features.admin.dashboard />`
- Run `php artisan livewire:discover`
- Clear view cache: `php artisan view:clear`

**Error**: "Property not found"

**Solutions**:
- Declare property sebagai public
- Check typo di wire:model
- Use `$this->propertyName` di method

#### 4. Route Issues

**Error**: "Route not defined"

**Solutions**:
- Check route name di `routes/web.php`
- Run `php artisan route:list` untuk list semua routes
- Clear route cache: `php artisan route:clear`

#### 5. Permission Issues

**Error**: "Permission denied"

**Solutions**:
- Check file permissions: `chmod -R 775 storage bootstrap/cache`
- Check ownership: `chown -R www-data:www-data storage bootstrap/cache`
- Run as appropriate user

#### 6. Livewire Wire:Poll Issues

**Error**: Component tidak auto-refresh

**Solutions**:
- Check syntax: `wire:poll.5s="methodName"`
- Verify method exists dan public
- Check browser console untuk errors
- Ensure Livewire scripts loaded

### Best Practices Summary

#### Models
- Singular noun, PascalCase
- Define relationships
- Use casts untuk type conversion
- Add accessors/mutators untuk computed properties
- Use scopes untuk reusable queries

#### Migrations
- Descriptive names
- One purpose per migration
- Use foreign keys dengan onDelete
- Add indexes untuk performance
- Rollback-able (reversible)

#### Livewire Components
- Single responsibility
- Use attributes (#[Title], #[Layout])
- Validate input
- Use wire:loading untuk UX
- Optimize dengan lazy loading

#### Services
- Single domain logic
- Dependency injection
- Clear return types
- Testable methods
- PHPDoc documentation

#### Middleware
- Single responsibility
- Return appropriate responses
- Register di bootstrap/app.php
- Use in route groups

#### Commands
- Clear signature
- Descriptive description
- Progress feedback (info, line, error)
- Return exit codes (0 = success)
- Schedule if needed

## Diagram Alur Sistem

### Authentication Flow

```
┌─────────────┐
│   Browser   │
└──────┬──────┘
       │
       │ 1. Access /login
       ▼
┌─────────────────┐
│  Login.php      │
│  (Livewire)     │
└──────┬──────────┘
       │
       │ 2. Submit credentials
       ▼
┌─────────────────┐
│  Auth::attempt  │
└──────┬──────────┘
       │
       │ 3. Check credentials
       ▼
┌─────────────────┐
│  User Model     │
└──────┬──────────┘
       │
       │ 4. Authenticated
       ▼
┌─────────────────┐
│  CheckRole      │
│  Middleware     │
└──────┬──────────┘
       │
       │ 5. Check role
       ├─────────────┬─────────────┬─────────────┐
       │             │             │             │
       ▼             ▼             ▼             ▼
  /admin/      /peserta/     /qualifier/    Redirect
  dashboard     dashboard     dashboard      to role
```

### Quiz Taking Flow

```
┌─────────────┐
│   Peserta   │
└──────┬──────┘
       │
       │ 1. Browse competitions
       ▼
┌──────────────────┐
│ CompetitionList  │
└──────┬───────────┘
       │
       │ 2. Enroll
       ▼
┌──────────────────────┐
│ CompetitionParticipant│
│ (created/retrieved)   │
└──────┬───────────────┘
       │
       │ 3. Start quiz
       ▼
┌──────────────────┐
│ CompetitionQuiz  │
│ (Livewire)       │
└──────┬───────────┘
       │
       │ 4. Answer questions
       │    (loop)
       ▼
┌──────────────────┐
│ selectAnswer()   │
│ submitAnswer()   │
└──────┬───────────┘
       │
       │ 5. Calculate score
       ▼
┌──────────────────┐
│ ScoringService   │
│ - Base score     │
│ - Speed bonus    │
│ - Penalty        │
└──────┬───────────┘
       │
       │ 6. Save answer
       ▼
┌──────────────────┐
│ ParticipantAnswer│
│ (with score)     │
└──────┬───────────┘
       │
       │ 7. Finish quiz
       ▼
┌──────────────────┐
│ finishCompetition│
└──────┬───────────┘
       │
       │ 8. Update leaderboard
       ▼
┌──────────────────┐
│ Leaderboard      │
│ (rank calculated)│
└──────┬───────────┘
       │
       │ 9. Check badges
       ▼
┌──────────────────┐
│ BadgeService     │
│ - Check conditions│
│ - Award badges   │
└──────┬───────────┘
       │
       │ 10. Show results
       ▼
┌──────────────────┐
│ CompetitionResult│
└──────────────────┘
```

### Badge Award Flow

```
┌──────────────────┐
│ User completes   │
│ competition      │
└──────┬───────────┘
       │
       │ 1. Trigger badge check
       ▼
┌──────────────────────┐
│ BadgeService         │
│ checkAndAwardBadges()│
└──────┬───────────────┘
       │
       │ 2. Get all badges
       ▼
┌──────────────────┐
│ Badge::all()     │
└──────┬───────────┘
       │
       │ 3. Loop each badge
       │
       ├─────────────────────────────────┐
       │                                 │
       ▼                                 ▼
┌──────────────────┐          ┌──────────────────┐
│ Check condition  │          │ Already has      │
│ type             │          │ badge? Skip      │
└──────┬───────────┘          └──────────────────┘
       │
       │ 4. Evaluate condition
       │
       ├──────┬──────┬──────┬──────┬──────┐
       │      │      │      │      │      │
       ▼      ▼      ▼      ▼      ▼      ▼
  first  perfect speed  top   completion
  comp   score   comp   scorer  count
       │      │      │      │      │
       └──────┴──────┴──────┴──────┘
              │
              │ 5. Condition met?
              ▼
       ┌──────────────┐
       │ awardBadge() │
       └──────┬───────┘
              │
              │ 6. Create UserBadge
              ▼
       ┌──────────────┐
       │ UserBadge    │
       │ (awarded_at) │
       └──────────────┘
```

## Kesimpulan Design

Dokumentasi ini dirancang untuk menjadi referensi lengkap bagi developer yang bekerja dengan sistem kompetisi/quiz berbasis Laravel dan Livewire. Dengan mengikuti struktur dan panduan yang dijelaskan, developer dapat:

1. Memahami arsitektur sistem secara menyeluruh
2. Membuat komponen baru menggunakan Artisan commands
3. Mengimplementasikan fitur dengan mengikuti best practices
4. Troubleshoot masalah umum dengan cepat
5. Memperluas sistem dengan fitur baru

Dokumentasi akan diimplementasikan dalam format Markdown dengan struktur yang jelas, contoh kode yang lengkap, dan penjelasan dalam Bahasa Indonesia untuk memudahkan pemahaman tim development.
