<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create users first
        User::factory(5)->create([
            'role' => 'admin'
        ]);

        User::factory(5)->create([
            'role' => 'qualifier'
        ]);

        User::factory(10)->create([
            'role' => 'peserta'
        ]);

        // Create categories
        $this->call(CategorySeeder::class);

        // Create competitions (requires admin users)
        $this->call(CompetitionSeeder::class);

        // Create questions and answers (requires competitions and categories)
        $this->call(QuestionAndAnswerSeeder::class);
    }
}
