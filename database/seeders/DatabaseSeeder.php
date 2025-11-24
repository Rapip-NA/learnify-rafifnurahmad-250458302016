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
        User::factory(10)->create([
            'role' => 'admin'
        ]);

        User::factory(10)->create([
            'role' => 'qualifier'
        ]);

        User::factory(50)->create([
            'role' => 'peserta'
        ]);
    }
}
