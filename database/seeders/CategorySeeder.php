<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Matematika',
                'description' => 'Soal-soal matematika meliputi aljabar, geometri, kalkulus, dan statistika'
            ],
            [
                'name' => 'Fisika',
                'description' => 'Soal-soal fisika meliputi mekanika, termodinamika, optik, dan listrik magnet'
            ],
            [
                'name' => 'Kimia',
                'description' => 'Soal-soal kimia meliputi kimia organik, anorganik, dan fisika kimia'
            ],
            [
                'name' => 'Biologi',
                'description' => 'Soal-soal biologi meliputi botani, zoologi, ekologi, dan genetika'
            ],
            [
                'name' => 'Bahasa Indonesia',
                'description' => 'Soal-soal bahasa Indonesia meliputi tata bahasa, sastra, dan pemahaman bacaan'
            ],
            [
                'name' => 'Bahasa Inggris',
                'description' => 'Soal-soal bahasa Inggris meliputi grammar, vocabulary, dan reading comprehension'
            ],
            [
                'name' => 'Sejarah',
                'description' => 'Soal-soal sejarah meliputi sejarah Indonesia dan sejarah dunia'
            ],
            [
                'name' => 'Geografi',
                'description' => 'Soal-soal geografi meliputi geografi fisik, geografi manusia, dan kartografi'
            ],
            [
                'name' => 'Ekonomi',
                'description' => 'Soal-soal ekonomi meliputi mikroekonomi, makroekonomi, dan ekonomi pembangunan'
            ],
            [
                'name' => 'Sosiologi',
                'description' => 'Soal-soal sosiologi meliputi teori sosial, struktur sosial, dan perubahan sosial'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        $this->command->info('10 categories created successfully');
    }
}
