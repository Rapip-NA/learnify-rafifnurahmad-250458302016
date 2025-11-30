# Use Case Diagram - Platform Kompetisi Quiz Online

## Diagram Use Case Utama

```mermaid
graph TB
    subgraph "Platform Kompetisi Quiz Online"
        %% Admin Use Cases
        UC1[Kelola Kompetisi]
        UC2[Kelola Soal]
        UC3[Kelola Kategori]
        UC4[Kelola Badge]
        UC5[Kelola Pengguna]
        UC6[Lihat Analytics]
        UC7[Kelola Pengaturan Scoring]
        
        %% Peserta Use Cases
        UC8[Registrasi/Login]
        UC9[Lihat Daftar Kompetisi]
        UC10[Ikut Kompetisi]
        UC11[Jawab Soal Quiz]
        UC12[Lihat Hasil & Skor]
        UC13[Lihat Leaderboard]
        UC14[Lihat Badge Saya]
        UC15[Lihat Profil]
        
        %% Qualifier Use Cases
        UC16[Validasi Soal]
        UC17[Validasi Jawaban Peserta]
        UC18[Lihat Soal Pending]
        
        %% Sistem Use Cases
        UC19[Hitung Skor Otomatis]
        UC20[Update Leaderboard]
        UC21[Berikan Badge]
        UC22[Update Status Kompetisi]
    end
    
    %% Actors
    Admin((Admin))
    Peserta((Peserta))
    Qualifier((Qualifier))
    Sistem((Sistem))
    
    %% Admin Relations
    Admin --> UC1
    Admin --> UC2
    Admin --> UC3
    Admin --> UC4
    Admin --> UC5
    Admin --> UC6
    Admin --> UC7
    
    %% Peserta Relations
    Peserta --> UC8
    Peserta --> UC9
    Peserta --> UC10
    Peserta --> UC11
    Peserta --> UC12
    Peserta --> UC13
    Peserta --> UC14
    Peserta --> UC15
    
    %% Qualifier Relations
    Qualifier --> UC16
    Qualifier --> UC17
    Qualifier --> UC18
    
    %% Sistem Relations
    Sistem --> UC19
    Sistem --> UC20
    Sistem --> UC21
    Sistem --> UC22
    
    %% Include/Extend Relations
    UC10 -.->|include| UC8
    UC11 -.->|include| UC10
    UC19 -.->|triggered by| UC11
    UC20 -.->|triggered by| UC19
    UC21 -.->|triggered by| UC19
    UC22 -.->|scheduled| Sistem
```

## Detail Use Case per Aktor

### 1. Admin

```mermaid
graph LR
    Admin((Admin))
    
    subgraph "Manajemen Kompetisi"
        UC1_1[Buat Kompetisi Baru]
        UC1_2[Edit Kompetisi]
        UC1_3[Hapus Kompetisi]
        UC1_4[Ubah Status Kompetisi]
        UC1_5[Atur Durasi & Waktu]
    end
    
    subgraph "Manajemen Soal"
        UC2_1[Tambah Soal]
        UC2_2[Edit Soal]
        UC2_3[Hapus Soal]
        UC2_4[Atur Bobot Poin]
        UC2_5[Assign ke Kompetisi]
    end
    
    subgraph "Manajemen Badge"
        UC4_1[Buat Badge Baru]
        UC4_2[Edit Badge]
        UC4_3[Hapus Badge]
        UC4_4[Atur Kondisi Badge]
    end
    
    subgraph "Analytics"
        UC6_1[Lihat Statistik Kompetisi]
        UC6_2[Lihat Partisipasi]
        UC6_3[Export Laporan]
    end
    
    Admin --> UC1_1
    Admin --> UC1_2
    Admin --> UC1_3
    Admin --> UC1_4
    Admin --> UC1_5
    Admin --> UC2_1
    Admin --> UC2_2
    Admin --> UC2_3
    Admin --> UC2_4
    Admin --> UC2_5
    Admin --> UC4_1
    Admin --> UC4_2
    Admin --> UC4_3
    Admin --> UC4_4
    Admin --> UC6_1
    Admin --> UC6_2
    Admin --> UC6_3
```

### 2. Peserta

```mermaid
graph LR
    Peserta((Peserta))
    
    subgraph "Kompetisi"
        UC9[Browse Kompetisi]
        UC10[Daftar Kompetisi]
        UC11_1[Mulai Quiz]
        UC11_2[Jawab Soal]
        UC11_3[Submit Jawaban]
        UC11_4[Lihat Timer]
    end
    
    subgraph "Hasil & Progress"
        UC12_1[Lihat Skor Detail]
        UC12_2[Lihat Jawaban Benar/Salah]
        UC12_3[Lihat Speed Bonus]
        UC13_1[Lihat Ranking]
        UC13_2[Lihat Top Performers]
    end
    
    subgraph "Profil & Badge"
        UC14_1[Lihat Badge Terkumpul]
        UC14_2[Lihat Progress Badge]
        UC15_1[Edit Profil]
        UC15_2[Lihat Riwayat Kompetisi]
    end
    
    Peserta --> UC9
    Peserta --> UC10
    Peserta --> UC11_1
    Peserta --> UC11_2
    Peserta --> UC11_3
    Peserta --> UC11_4
    Peserta --> UC12_1
    Peserta --> UC12_2
    Peserta --> UC12_3
    Peserta --> UC13_1
    Peserta --> UC13_2
    Peserta --> UC14_1
    Peserta --> UC14_2
    Peserta --> UC15_1
    Peserta --> UC15_2
```

### 3. Qualifier

```mermaid
graph LR
    Qualifier((Qualifier))
    
    subgraph "Validasi Soal"
        UC16_1[Lihat Soal Pending]
        UC16_2[Review Soal]
        UC16_3[Approve Soal]
        UC16_4[Reject Soal]
        UC16_5[Beri Komentar]
    end
    
    subgraph "Validasi Jawaban"
        UC17_1[Lihat Jawaban Peserta]
        UC17_2[Verifikasi Jawaban Manual]
        UC17_3[Approve/Reject Jawaban]
    end
    
    Qualifier --> UC16_1
    Qualifier --> UC16_2
    Qualifier --> UC16_3
    Qualifier --> UC16_4
    Qualifier --> UC16_5
    Qualifier --> UC17_1
    Qualifier --> UC17_2
    Qualifier --> UC17_3
```

### 4. Sistem (Automated)

```mermaid
graph LR
    Sistem((Sistem))
    
    subgraph "Scoring Otomatis"
        UC19_1[Hitung Skor Dasar]
        UC19_2[Hitung Speed Bonus]
        UC19_3[Hitung Penalty]
        UC19_4[Update Total Skor]
    end
    
    subgraph "Leaderboard"
        UC20_1[Update Ranking]
        UC20_2[Sort by Score]
        UC20_3[Assign Rank]
    end
    
    subgraph "Badge System"
        UC21_1[Cek Kondisi Badge]
        UC21_2[Award Badge]
        UC21_3[Notifikasi Badge]
    end
    
    subgraph "Status Management"
        UC22_1[Cek Expired Competition]
        UC22_2[Auto Update Status]
        UC22_3[Archive Competition]
    end
    
    Sistem --> UC19_1
    Sistem --> UC19_2
    Sistem --> UC19_3
    Sistem --> UC19_4
    Sistem --> UC20_1
    Sistem --> UC20_2
    Sistem --> UC20_3
    Sistem --> UC21_1
    Sistem --> UC21_2
    Sistem --> UC21_3
    Sistem --> UC22_1
    Sistem --> UC22_2
    Sistem --> UC22_3
```

## Flow Diagram: Peserta Mengikuti Kompetisi

```mermaid
sequenceDiagram
    actor Peserta
    participant Sistem
    participant ScoringService
    participant Leaderboard
    participant BadgeSystem
    
    Peserta->>Sistem: Login
    Peserta->>Sistem: Lihat Daftar Kompetisi
    Sistem-->>Peserta: Tampilkan Kompetisi Aktif
    
    Peserta->>Sistem: Daftar Kompetisi
    Sistem-->>Peserta: Konfirmasi Pendaftaran
    
    Peserta->>Sistem: Mulai Quiz
    Sistem-->>Peserta: Tampilkan Soal & Start Timer
    
    loop Untuk Setiap Soal
        Peserta->>Sistem: Submit Jawaban
        Sistem->>ScoringService: Hitung Skor
        ScoringService->>ScoringService: Cek Jawaban Benar/Salah
        ScoringService->>ScoringService: Hitung Speed Bonus
        ScoringService->>ScoringService: Hitung Penalty (jika ada)
        ScoringService-->>Sistem: Return Skor
        Sistem-->>Peserta: Tampilkan Soal Berikutnya
    end
    
    Peserta->>Sistem: Selesai Quiz
    Sistem->>ScoringService: Hitung Total Skor
    ScoringService-->>Sistem: Total Skor
    
    Sistem->>Leaderboard: Update Ranking
    Leaderboard-->>Sistem: Ranking Updated
    
    Sistem->>BadgeSystem: Cek Kondisi Badge
    BadgeSystem-->>Sistem: Badge Awarded (jika memenuhi)
    
    Sistem-->>Peserta: Tampilkan Hasil & Ranking
```

## Prioritas Use Case

### High Priority (MVP)
1. ✅ UC1: Kelola Kompetisi
2. ✅ UC2: Kelola Soal
3. ✅ UC8: Registrasi/Login
4. ✅ UC10: Ikut Kompetisi
5. ✅ UC11: Jawab Soal Quiz
6. ✅ UC19: Hitung Skor Otomatis
7. ✅ UC13: Lihat Leaderboard

### Medium Priority
1. UC16: Validasi Soal
2. UC14: Lihat Badge Saya
3. UC21: Berikan Badge
4. UC6: Lihat Analytics
5. UC22: Update Status Kompetisi

### Low Priority
1. UC17: Validasi Jawaban Peserta (Manual)
2. UC7: Kelola Pengaturan Scoring Advanced
3. Export/Import Features

