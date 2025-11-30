<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Category;
use App\Models\Competition;
use App\Models\Question;
use Illuminate\Database\Seeder;

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

        // Create 10 questions per competition
        foreach ($competitions as $competitionIndex => $competition) {
            for ($i = 1; $i <= 10; $i++) {
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
                    'verified_by' => null,
                    'validation_status' => 'approved',
                ]);

                $questionCount++;

                // Create 4 answers for each question (first answer is correct)
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

        $this->command->info("$questionCount questions created successfully");
        $this->command->info("$answerCount answers created successfully");
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
            ],
            'Fisika' => [
                ['question' => 'Berapa percepatan gravitasi di permukaan bumi?', 'answers' => ['9.8 m/s²', '10 m/s²', '8.9 m/s²', '11 m/s²']],
                ['question' => 'Satuan energi dalam SI adalah?', 'answers' => ['Joule', 'Watt', 'Newton', 'Pascal']],
                ['question' => 'Hukum Newton pertama disebut juga hukum?', 'answers' => ['Inersia', 'Aksi-Reaksi', 'Gravitasi', 'Momentum']],
                ['question' => 'Kecepatan cahaya dalam vakum adalah?', 'answers' => ['3 × 10⁸ m/s', '2 × 10⁸ m/s', '4 × 10⁸ m/s', '5 × 10⁸ m/s']],
                ['question' => 'Satuan hambatan listrik adalah?', 'answers' => ['Ohm', 'Ampere', 'Volt', 'Coulomb']],
            ],
            'Kimia' => [
                ['question' => 'Lambang kimia untuk emas adalah?', 'answers' => ['Au', 'Ag', 'Fe', 'Cu']],
                ['question' => 'Air memiliki rumus kimia?', 'answers' => ['H₂O', 'CO₂', 'O₂', 'H₂']],
                ['question' => 'pH air murni adalah?', 'answers' => ['7', '6', '8', '5']],
                ['question' => 'Proses perubahan wujud dari cair ke gas disebut?', 'answers' => ['Penguapan', 'Pencairan', 'Pembekuan', 'Sublimasi']],
                ['question' => 'Unsur yang paling banyak di atmosfer bumi adalah?', 'answers' => ['Nitrogen', 'Oksigen', 'Karbon Dioksida', 'Argon']],
            ],
            'Biologi' => [
                ['question' => 'Organel sel yang berfungsi sebagai penghasil energi adalah?', 'answers' => ['Mitokondria', 'Ribosom', 'Nukleus', 'Lisosom']],
                ['question' => 'Proses fotosintesis terjadi pada bagian?', 'answers' => ['Kloroplas', 'Mitokondria', 'Ribosom', 'Vakuola']],
                ['question' => 'DNA adalah singkatan dari?', 'answers' => ['Deoxyribonucleic Acid', 'Deoxyribose Acid', 'Deoxyribonuclear Acid', 'Deoxynucleic Acid']],
                ['question' => 'Berapa jumlah kromosom manusia normal?', 'answers' => ['46', '23', '48', '44']],
                ['question' => 'Organ terbesar pada tubuh manusia adalah?', 'answers' => ['Kulit', 'Hati', 'Jantung', 'Paru-paru']],
            ],
            'Bahasa Indonesia' => [
                ['question' => 'Apa yang dimaksud dengan kata majemuk?', 'answers' => ['Gabungan dua kata atau lebih', 'Kata yang memiliki imbuhan', 'Kata dasar', 'Kata yang memiliki makna ganda']],
                ['question' => 'Kalimat yang mengandung subjek, predikat, objek, dan keterangan disebut?', 'answers' => ['Kalimat sempurna', 'Kalimat sederhana', 'Kalimat majemuk', 'Kalimat tunggal']],
                ['question' => 'Majas yang menggunakan perbandingan disebut?', 'answers' => ['Metafora', 'Personifikasi', 'Hiperbola', 'Ironi']],
                ['question' => 'Pantun terdiri dari berapa baris?', 'answers' => ['4 baris', '2 baris', '6 baris', '8 baris']],
                ['question' => 'Apa fungsi tanda koma (,) dalam kalimat?', 'answers' => ['Memisahkan unsur-unsur dalam kalimat', 'Mengakhiri kalimat', 'Menunjukkan perintah', 'Menunjukkan pertanyaan']],
            ],
            'Bahasa Inggris' => [
                ['question' => 'What is the past tense of "go"?', 'answers' => ['Went', 'Gone', 'Going', 'Goes']],
                ['question' => 'Which one is a pronoun?', 'answers' => ['She', 'Beautiful', 'Run', 'Quickly']],
                ['question' => 'What does "library" mean?', 'answers' => ['Perpustakaan', 'Sekolah', 'Toko buku', 'Kantor']],
                ['question' => 'The opposite of "hot" is?', 'answers' => ['Cold', 'Warm', 'Cool', 'Mild']],
                ['question' => 'What is the plural form of "child"?', 'answers' => ['Children', 'Childs', 'Childes', 'Childern']],
            ],
            'Sejarah' => [
                ['question' => 'Kapan Indonesia merdeka?', 'answers' => ['17 Agustus 1945', '1 Juni 1945', '20 Mei 1908', '28 Oktober 1928']],
                ['question' => 'Siapa proklamator kemerdekaan Indonesia?', 'answers' => ['Soekarno dan Mohammad Hatta', 'Soekarno dan Soeharto', 'Mohammad Hatta dan Sutan Sjahrir', 'Soekarno dan Ki Hajar Dewantara']],
                ['question' => 'Candi Borobudur dibangun pada masa kerajaan?', 'answers' => ['Syailendra', 'Majapahit', 'Sriwijaya', 'Mataram']],
                ['question' => 'Perang Diponegoro terjadi pada tahun?', 'answers' => ['1825-1830', '1800-1805', '1850-1855', '1875-1880']],
                ['question' => 'Organisasi Budi Utomo didirikan pada tanggal?', 'answers' => ['20 Mei 1908', '28 Oktober 1928', '17 Agustus 1945', '1 Juni 1945']],
            ],
            'Geografi' => [
                ['question' => 'Gunung tertinggi di Indonesia adalah?', 'answers' => ['Puncak Jaya', 'Gunung Semeru', 'Gunung Rinjani', 'Gunung Kerinci']],
                ['question' => 'Ibukota provinsi Jawa Timur adalah?', 'answers' => ['Surabaya', 'Malang', 'Semarang', 'Bandung']],
                ['question' => 'Benua terbesar di dunia adalah?', 'answers' => ['Asia', 'Afrika', 'Amerika', 'Eropa']],
                ['question' => 'Sungai terpanjang di dunia adalah?', 'answers' => ['Sungai Nil', 'Sungai Amazon', 'Sungai Yangtze', 'Sungai Mississippi']],
                ['question' => 'Indonesia terletak di antara dua benua, yaitu?', 'answers' => ['Asia dan Australia', 'Asia dan Afrika', 'Asia dan Amerika', 'Australia dan Amerika']],
            ],
            'Ekonomi' => [
                ['question' => 'Ilmu ekonomi mempelajari tentang?', 'answers' => ['Kelangkaan dan pilihan', 'Kekayaan negara', 'Perdagangan internasional', 'Sistem perbankan']],
                ['question' => 'Apa yang dimaksud dengan inflasi?', 'answers' => ['Kenaikan harga secara umum', 'Penurunan harga', 'Kenaikan nilai tukar', 'Penurunan produksi']],
                ['question' => 'Sistem ekonomi yang mengandalkan mekanisme pasar adalah?', 'answers' => ['Ekonomi liberal', 'Ekonomi komando', 'Ekonomi tradisional', 'Ekonomi campuran']],
                ['question' => 'Bank Indonesia berfungsi sebagai?', 'answers' => ['Bank sentral', 'Bank komersial', 'Bank pembangunan', 'Bank perkreditan']],
                ['question' => 'Mata uang Indonesia adalah?', 'answers' => ['Rupiah', 'Ringgit', 'Baht', 'Peso']],
            ],
            'Sosiologi' => [
                ['question' => 'Interaksi sosial adalah?', 'answers' => ['Hubungan timbal balik antar individu', 'Hubungan satu arah', 'Komunikasi verbal', 'Komunikasi non-verbal']],
                ['question' => 'Mobilitas sosial vertikal adalah?', 'answers' => ['Perpindahan status sosial naik atau turun', 'Perpindahan tempat tinggal', 'Perpindahan pekerjaan', 'Perpindahan agama']],
                ['question' => 'Konflik sosial dapat terjadi karena?', 'answers' => ['Perbedaan kepentingan', 'Kesamaan tujuan', 'Kerjasama', 'Solidaritas']],
                ['question' => 'Sosialisasi adalah proses?', 'answers' => ['Pembelajaran norma dan nilai sosial', 'Interaksi dengan alam', 'Komunikasi dengan teknologi', 'Belajar di sekolah']],
                ['question' => 'Stratifikasi sosial adalah?', 'answers' => ['Pembedaan masyarakat ke dalam kelas-kelas', 'Kesamaan derajat masyarakat', 'Mobilitas sosial', 'Perubahan sosial']],
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
