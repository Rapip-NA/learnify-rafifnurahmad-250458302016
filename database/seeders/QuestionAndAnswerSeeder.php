<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Competition;
use App\Models\Category;

class QuestionAndAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $competitions = Competition::all();
        $categories = Category::all();

        if ($competitions->isEmpty()) {
            $this->command->error('No competitions found. Please run CompetitionSeeder first.');
            return;
        }

        if ($categories->isEmpty()) {
            $this->command->error('No categories found. Please run CategorySeeder first.');
            return;
        }

        $difficultyLevels = ['easy', 'medium', 'hard'];
        $questionTemplates = $this->getQuestionTemplates();

        $questionCount = 0;
        $answerCount = 0;

        // Total 100 soal, dibagi ke 15 kompetisi = ~6-7 soal per kompetisi
        $questionsPerCompetition = 7; // Will create 105 questions total
        
        foreach ($competitions as $competitionIndex => $competition) {
            // Untuk kompetisi terakhir, buat hanya 5 soal agar total = 100
            $numQuestions = ($competitionIndex == $competitions->count() - 1) ? 5 : $questionsPerCompetition;
            
            for ($i = 1; $i <= $numQuestions; $i++) {
                $category = $categories->random();
                $difficulty = $difficultyLevels[array_rand($difficultyLevels)];
                $pointWeight = match ($difficulty) {
                    'easy' => 10,
                    'medium' => 20,
                    'hard' => 30,
                };

                // Get a question template based on category
                $template = $this->getQuestionByCategory($category->name, $i);

                $question = Question::create([
                    'competition_id' => $competition->id,
                    'category_id' => $category->id,
                    'question_text' => $template['question'],
                    'difficulty_level' => $difficulty,
                    'point_weight' => $pointWeight,
                    'question_type' => $template['type'] ?? 'multiple_choice',
                    'verified_by' => null,
                    'validation_status' => 'approved',
                ]);

                $questionCount++;

                // Create answers for multiple choice questions
                if ($question->question_type === 'multiple_choice') {
                    foreach ($template['answers'] as $index => $answerText) {
                        Answer::create([
                            'question_id' => $question->id,
                            'answer_text' => $answerText,
                            'is_correct' => $index === 0, // First answer is correct
                        ]);
                        $answerCount++;
                    }
                }
            }
        }

        $this->command->info("✓ $questionCount questions created successfully");
        $this->command->info("✓ $answerCount answers created successfully");
    }

    /**
     * Get question templates
     */
    private function getQuestionTemplates(): array
    {
        return [
            'Matematika' => [
                ['question' => 'Berapa hasil dari 15 × 8?', 'answers' => ['120', '100', '130', '110']],
                ['question' => 'Dalam segitiga siku-siku, jika sisi a = 3 dan sisi b = 4, berapa sisi c (hipotenusa)?', 'answers' => ['5', '6', '7', '4']],
                ['question' => 'Berapa nilai x jika 2x + 5 = 15?', 'answers' => ['5', '10', '7', '3']],
                ['question' => 'Berapa luas lingkaran dengan jari-jari 7 cm? (π = 22/7)', 'answers' => ['154 cm²', '144 cm²', '164 cm²', '174 cm²']],
                ['question' => 'Jika f(x) = 2x + 3, berapa nilai f(5)?', 'answers' => ['13', '11', '15', '17']],
                ['question' => 'Berapa hasil dari √144?', 'answers' => ['12', '11', '13', '14']],
                ['question' => 'Berapa volume kubus dengan sisi 5 cm?', 'answers' => ['125 cm³', '100 cm³', '150 cm³', '75 cm³']],
            ],
            'Fisika' => [
                ['question' => 'Berapa percepatan gravitasi di permukaan bumi?', 'answers' => ['9.8 m/s²', '10 m/s²', '8.9 m/s²', '11 m/s²']],
                ['question' => 'Satuan energi dalam SI adalah?', 'answers' => ['Joule', 'Watt', 'Newton', 'Pascal']],
                ['question' => 'Hukum Newton pertama disebut juga hukum?', 'answers' => ['Inersia', 'Aksi-Reaksi', 'Gravitasi', 'Momentum']],
                ['question' => 'Kecepatan cahaya dalam vakum adalah?', 'answers' => ['3 × 10⁸ m/s', '2 × 10⁸ m/s', '4 × 10⁸ m/s', '5 × 10⁸ m/s']],
                ['question' => 'Satuan hambatan listrik adalah?', 'answers' => ['Ohm', 'Ampere', 'Volt', 'Coulomb']],
                ['question' => 'Hukum Archimedes berkaitan dengan?', 'answers' => ['Gaya apung', 'Gaya gesek', 'Gaya gravitasi', 'Gaya sentripetal']],
                ['question' => 'Satuan kuat arus listrik adalah?', 'answers' => ['Ampere', 'Volt', 'Ohm', 'Watt']],
            ],
            'Kimia' => [
                ['question' => 'Lambang kimia untuk emas adalah?', 'answers' => ['Au', 'Ag', 'Fe', 'Cu']],
                ['question' => 'Air memiliki rumus kimia?', 'answers' => ['H₂O', 'CO₂', 'O₂', 'H₂']],
                ['question' => 'pH air murni adalah?', 'answers' => ['7', '6', '8', '5']],
                ['question' => 'Proses perubahan wujud dari cair ke gas disebut?', 'answers' => ['Penguapan', 'Pencairan', 'Pembekuan', 'Sublimasi']],
                ['question' => 'Unsur yang paling banyak di atmosfer bumi adalah?', 'answers' => ['Nitrogen', 'Oksigen', 'Karbon Dioksida', 'Argon']],
                ['question' => 'Lambang kimia untuk perak adalah?', 'answers' => ['Ag', 'Au', 'Pt', 'Pb']],
                ['question' => 'Rumus kimia garam dapur adalah?', 'answers' => ['NaCl', 'KCl', 'CaCl₂', 'MgCl₂']],
            ],
            'Biologi' => [
                ['question' => 'Organel sel yang berfungsi sebagai penghasil energi adalah?', 'answers' => ['Mitokondria', 'Ribosom', 'Nukleus', 'Lisosom']],
                ['question' => 'Proses fotosintesis terjadi pada bagian?', 'answers' => ['Kloroplas', 'Mitokondria', 'Ribosom', 'Vakuola']],
                ['question' => 'DNA adalah singkatan dari?', 'answers' => ['Deoxyribonucleic Acid', 'Deoxyribose Acid', 'Deoxyribonuclear Acid', 'Deoxynucleic Acid']],
                ['question' => 'Berapa jumlah kromosom manusia normal?', 'answers' => ['46', '23', '48', '44']],
                ['question' => 'Organ terbesar pada tubuh manusia adalah?', 'answers' => ['Kulit', 'Hati', 'Jantung', 'Paru-paru']],
                ['question' => 'Proses pernafasan sel terjadi di?', 'answers' => ['Mitokondria', 'Kloroplas', 'Nukleus', 'Ribosom']],
                ['question' => 'Golongan darah universal donor adalah?', 'answers' => ['O', 'A', 'B', 'AB']],
            ],
            'Bahasa Indonesia' => [
                ['question' => 'Apa yang dimaksud dengan kata majemuk?', 'answers' => ['Gabungan dua kata atau lebih', 'Kata yang memiliki imbuhan', 'Kata dasar', 'Kata yang memiliki makna ganda']],
                ['question' => 'Kalimat yang mengandung subjek, predikat, objek, dan keterangan disebut?', 'answers' => ['Kalimat sempurna', 'Kalimat sederhana', 'Kalimat majemuk', 'Kalimat tunggal']],
                ['question' => 'Majas yang menggunakan perbandingan disebut?', 'answers' => ['Metafora', 'Personifikasi', 'Hiperbola', 'Ironi']],
                ['question' => 'Pantun terdiri dari berapa baris?', 'answers' => ['4 baris', '2 baris', '6 baris', '8 baris']],
                ['question' => 'Apa fungsi tanda koma (,) dalam kalimat?', 'answers' => ['Memisahkan unsur-unsur dalam kalimat', 'Mengakhiri kalimat', 'Menunjukkan perintah', 'Menunjukkan pertanyaan']],
                ['question' => 'Kata baku dari "apotek" adalah?', 'answers' => ['Apotek', 'Apotik', 'Apothek', 'Apotiq']],
                ['question' => 'Jelaskan perbedaan antara novel dan cerpen!', 'answers' => [], 'type' => 'essay'],
            ],
            'Bahasa Inggris' => [
                ['question' => 'What is the past tense of "go"?', 'answers' => ['Went', 'Gone', 'Going', 'Goes']],
                ['question' => 'Which one is a pronoun?', 'answers' => ['She', 'Beautiful', 'Run', 'Quickly']],
                ['question' => 'What does "library" mean?', 'answers' => ['Perpustakaan', 'Sekolah', 'Toko buku', 'Kantor']],
                ['question' => 'The opposite of "hot" is?', 'answers' => ['Cold', 'Warm', 'Cool', 'Mild']],
                ['question' => 'What is the plural form of "child"?', 'answers' => ['Children', 'Childs', 'Childes', 'Childern']],
                ['question' => 'Which article is correct: "... apple a day keeps the doctor away"?', 'answers' => ['An', 'A', 'The', 'No article']],
                ['question' => 'Describe your favorite hobby in English!', 'answers' => [], 'type' => 'essay'],
            ],
            'Sejarah' => [
                ['question' => 'Kapan Indonesia merdeka?', 'answers' => ['17 Agustus 1945', '1 Juni 1945', '20 Mei 1908', '28 Oktober 1928']],
                ['question' => 'Siapa proklamator kemerdekaan Indonesia?', 'answers' => ['Soekarno dan Mohammad Hatta', 'Soekarno dan Soeharto', 'Mohammad Hatta dan Sutan Sjahrir', 'Soekarno dan Ki Hajar Dewantara']],
                ['question' => 'Candi Borobudur dibangun pada masa kerajaan?', 'answers' => ['Syailendra', 'Majapahit', 'Sriwijaya', 'Mataram']],
                ['question' => 'Perang Diponegoro terjadi pada tahun?', 'answers' => ['1825-1830', '1800-1805', '1850-1855', '1875-1880']],
                ['question' => 'Organisasi Budi Utomo didirikan pada tanggal?', 'answers' => ['20 Mei 1908', '28 Oktober 1928', '17 Agustus 1945', '1 Juni 1945']],
                ['question' => 'Peristiwa Rengasdengklok terjadi pada tanggal?', 'answers' => ['16 Agustus 1945', '17 Agustus 1945', '15 Agustus 1945', '18 Agustus 1945']],
                ['question' => 'Siapa presiden pertama Indonesia?', 'answers' => ['Ir. Soekarno', 'Mohammad Hatta', 'Soeharto', 'B.J. Habibie']],
            ],
            'Geografi' => [
                ['question' => 'Gunung tertinggi di Indonesia adalah?', 'answers' => ['Puncak Jaya', 'Gunung Semeru', 'Gunung Rinjani', 'Gunung Kerinci']],
                ['question' => 'Ibukota provinsi Jawa Timur adalah?', 'answers' => ['Surabaya', 'Malang', 'Semarang', 'Bandung']],
                ['question' => 'Benua terbesar di dunia adalah?', 'answers' => ['Asia', 'Afrika', 'Amerika', 'Eropa']],
                ['question' => 'Sungai terpanjang di dunia adalah?', 'answers' => ['Sungai Nil', 'Sungai Amazon', 'Sungai Yangtze', 'Sungai Mississippi']],
                ['question' => 'Indonesia terletak di antara dua benua, yaitu?', 'answers' => ['Asia dan Australia', 'Asia dan Afrika', 'Asia dan Amerika', 'Australia dan Amerika']],
                ['question' => 'Laut terluas di Indonesia adalah?', 'answers' => ['Laut Banda', 'Laut Jawa', 'Laut Arafura', 'Laut Sulawesi']],
                ['question' => 'Provinsi terluas di Indonesia adalah?', 'answers' => ['Papua', 'Kalimantan Timur', 'Sumatra Utara', 'Sulawesi Selatan']],
            ],
            'Ekonomi' => [
                ['question' => 'Ilmu ekonomi mempelajari tentang?', 'answers' => ['Kelangkaan dan pilihan', 'Kekayaan negara', 'Perdagangan internasional', 'Sistem perbankan']],
                ['question' => 'Apa yang dimaksud dengan inflasi?', 'answers' => ['Kenaikan harga secara umum', 'Penurunan harga', 'Kenaikan nilai tukar', 'Penurunan produksi']],
                ['question' => 'Sistem ekonomi yang mengandalkan mekanisme pasar adalah?', 'answers' => ['Ekonomi liberal', 'Ekonomi komando', 'Ekonomi tradisional', 'Ekonomi campuran']],
                ['question' => 'Bank Indonesia berfungsi sebagai?', 'answers' => ['Bank sentral', 'Bank komersial', 'Bank pembangunan', 'Bank perkreditan']],
                ['question' => 'Mata uang Indonesia adalah?', 'answers' => ['Rupiah', 'Ringgit', 'Baht', 'Peso']],
                ['question' => 'APBN adalah singkatan dari?', 'answers' => ['Anggaran Pendapatan dan Belanja Negara', 'Asosiasi Pengusaha Bisnis Nasional', 'Anggaran Pembangunan Bidang Nusantara', 'Asosiasi Pedagang Bank Nasional']],
                ['question' => 'Pajak yang dikenakan atas penghasilan disebut?', 'answers' => ['PPh', 'PPN', 'PBB', 'BPHTB']],
            ],
            'Sosiologi' => [
                ['question' => 'Interaksi sosial adalah?', 'answers' => ['Hubungan timbal balik antar individu', 'Hubungan satu arah', 'Komunikasi verbal', 'Komunikasi non-verbal']],
                ['question' => 'Mobilitas sosial vertikal adalah?', 'answers' => ['Perpindahan status sosial naik atau turun', 'Perpindahan tempat tinggal', 'Perpindahan pekerjaan', 'Perpindahan agama']],
                ['question' => 'Konflik sosial dapat terjadi karena?', 'answers' => ['Perbedaan kepentingan', 'Kesamaan tujuan', 'Kerjasama', 'Solidaritas']],
                ['question' => 'Sosialisasi adalah proses?', 'answers' => ['Pembelajaran norma dan nilai sosial', 'Interaksi dengan alam', 'Komunikasi dengan teknologi', 'Belajar di sekolah']],
                ['question' => 'Stratifikasi sosial adalah?', 'answers' => ['Pembedaan masyarakat ke dalam kelas-kelas', 'Kesamaan derajat masyarakat', 'Mobilitas sosial', 'Perubahan sosial']],
                ['question' => 'Lembaga sosial primer adalah?', 'answers' => ['Keluarga', 'Sekolah', 'Perusahaan', 'Partai politik']],
                ['question' => 'Norma yang paling kuat sanksinya adalah?', 'answers' => ['Hukum', 'Kebiasaan', 'Tata cara', 'Mode']],
            ],
            'Teknologi Informasi' => [
                ['question' => 'CPU adalah singkatan dari?', 'answers' => ['Central Processing Unit', 'Computer Processing Unit', 'Central Program Unit', 'Computer Program Unit']],
                ['question' => 'HTML adalah bahasa untuk?', 'answers' => ['Membuat halaman web', 'Membuat program desktop', 'Mengelola database', 'Membuat aplikasi mobile']],
                ['question' => 'Satuan terkecil data dalam komputer adalah?', 'answers' => ['Bit', 'Byte', 'Kilobyte', 'Megabyte']],
                ['question' => 'IP Address digunakan untuk?', 'answers' => ['Identifikasi perangkat dalam jaringan', 'Username login', 'Password sistem', 'Nama domain']],
                ['question' => 'Protokol untuk transfer file adalah?', 'answers' => ['FTP', 'HTTP', 'SMTP', 'POP3']],
                ['question' => '1 Byte sama dengan berapa bit?', 'answers' => ['8 bit', '4 bit', '16 bit', '32 bit']],
                ['question' => 'Jelaskan perbedaan antara RAM dan ROM!', 'answers' => [], 'type' => 'essay'],
            ],
            'Seni Budaya' => [
                ['question' => 'Alat musik tradisional dari Jawa Barat adalah?', 'answers' => ['Angklung', 'Gamelan', 'Sasando', 'Kolintang']],
                ['question' => 'Tari Pendet berasal dari?', 'answers' => ['Bali', 'Jawa', 'Sumatra', 'Kalimantan']],
                ['question' => 'Lukisan terkenal "Mona Lisa" dilukis oleh?', 'answers' => ['Leonardo da Vinci', 'Pablo Picasso', 'Vincent van Gogh', 'Michelangelo']],
                ['question' => 'Wayang kulit adalah seni tradisional dari?', 'answers' => ['Jawa', 'Bali', 'Sumatra', 'Sulawesi']],
                ['question' => 'Batik adalah warisan budaya dari negara?', 'answers' => ['Indonesia', 'Malaysia', 'Thailand', 'Filipina']],
                ['question' => 'Tari Saman berasal dari provinsi?', 'answers' => ['Aceh', 'Sumatra Barat', 'Riau', 'Jambi']],
                ['question' => 'Siapa pelukis terkenal Indonesia yang melukis "Penangkapan Diponegoro"?', 'answers' => ['Raden Saleh', 'Affandi', 'Basuki Abdullah', 'S. Sudjojono']],
            ],
            'Pendidikan Agama' => [
                ['question' => 'Berapa jumlah surat dalam Al-Quran?', 'answers' => ['114', '113', '115', '112']],
                ['question' => 'Kitab suci umat Islam adalah?', 'answers' => ['Al-Quran', 'Injil', 'Taurat', 'Zabur']],
                ['question' => 'Rukun Islam ada berapa?', 'answers' => ['5', '4', '6', '7']],
                ['question' => 'Nabi terakhir yang diutus Allah adalah?', 'answers' => ['Muhammad SAW', 'Isa AS', 'Musa AS', 'Ibrahim AS']],
                ['question' => 'Shalat wajib sehari semalam ada berapa kali?', 'answers' => ['5 kali', '3 kali', '4 kali', '6 kali']],
                ['question' => 'Puasa di bulan Ramadhan adalah rukun Islam ke-?', 'answers' => ['4', '3', '5', '2']],
                ['question' => 'Jelaskan pengertian Ihsan dalam Islam!', 'answers' => [], 'type' => 'essay'],
            ],
            'Olahraga' => [
                ['question' => 'Olahraga bulutangkis berasal dari negara?', 'answers' => ['Inggris', 'Indonesia', 'China', 'Jepang']],
                ['question' => 'Berapa jumlah pemain dalam satu tim sepak bola?', 'answers' => ['11 pemain', '10 pemain', '12 pemain', '9 pemain']],
                ['question' => 'Induk organisasi sepak bola dunia adalah?', 'answers' => ['FIFA', 'UEFA', 'AFC', 'PSSI']],
                ['question' => 'Lama waktu pertandingan sepak bola normal adalah?', 'answers' => ['90 menit', '80 menit', '100 menit', '120 menit']],
                ['question' => 'Berapa tinggi net bola voli putra?', 'answers' => ['2.43 meter', '2.24 meter', '2.50 meter', '2.35 meter']],
                ['question' => 'Olahraga renang gaya bebas disebut juga?', 'answers' => ['Freestyle', 'Butterfly', 'Backstroke', 'Breaststroke']],
                ['question' => 'Atletik adalah induk dari semua cabang?', 'answers' => ['Olahraga', 'Renang', 'Bola', 'Senam']],
            ],
            'Pengetahuan Umum' => [
                ['question' => 'Negara dengan jumlah penduduk terbanyak di dunia adalah?', 'answers' => ['India', 'China', 'Amerika Serikat', 'Indonesia']],
                ['question' => 'Organisasi PBB didirikan pada tahun?', 'answers' => ['1945', '1950', '1940', '1955']],
                ['question' => 'Menara Eiffel berada di kota?', 'answers' => ['Paris', 'London', 'Berlin', 'Roma']],
                ['question' => 'Planet terbesar di tata surya adalah?', 'answers' => ['Jupiter', 'Saturnus', 'Uranus', 'Neptunus']],
                ['question' => 'Siapa penemu lampu pijar?', 'answers' => ['Thomas Alva Edison', 'Isaac Newton', 'Albert Einstein', 'Nikola Tesla']],
                ['question' => 'ASEAN didirikan pada tanggal?', 'answers' => ['8 Agustus 1967', '17 Agustus 1945', '20 Mei 1908', '28 Oktober 1928']],
                ['question' => 'Jelaskan dampak globalisasi terhadap budaya lokal!', 'answers' => [], 'type' => 'essay'],
            ],
        ];
    }

    /**
     * Get question by category
     */
    private function getQuestionByCategory(string $categoryName, int $index): array
    {
        $templates = $this->getQuestionTemplates();

        // If category exists in templates, use it; otherwise use random template
        if (isset($templates[$categoryName])) {
            $categoryQuestions = $templates[$categoryName];
            $questionIndex = ($index - 1) % count($categoryQuestions);
            return $categoryQuestions[$questionIndex];
        }

        // Fallback: use random category
        $randomCategory = array_rand($templates);
        $categoryQuestions = $templates[$randomCategory];
        $questionIndex = ($index - 1) % count($categoryQuestions);
        return $categoryQuestions[$questionIndex];
    }
}
