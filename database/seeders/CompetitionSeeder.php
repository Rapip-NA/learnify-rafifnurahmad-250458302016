<?php

namespace Database\Seeders;

use App\Models\Competition;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get a user to be the creator
        $creator = User::where('role', 'admin')->first();

        if (!$creator) {
            $this->command->error('No admin user found. Please run DatabaseSeeder first.');
            return;
        }

        // Create 5 draft competitions
        for ($i = 1; $i <= 5; $i++) {
            Competition::create([
                'title' => "Draft Competition $i",
                'description' => "This is draft competition number $i. It is still in draft status and not yet published.",
                'start_date' => now()->addDays(10 + $i),
                'end_date' => now()->addDays(15 + $i),
                'status' => 'draft',
                'created_by' => $creator->id,
                'speed_bonus_enabled' => true,
                'speed_bonus_percentage' => 10,
                'speed_bonus_time_threshold' => 300,
                'penalty_enabled' => true,
                'penalty_percentage' => 5,
                'duration_seconds' => 3600,
            ]);
        }

        // Create 5 active competitions
        for ($i = 1; $i <= 5; $i++) {
            Competition::create([
                'title' => "Active Competition $i",
                'description' => "This is active competition number $i. It is currently active and participants can join.",
                'start_date' => now()->subDays($i),
                'end_date' => now()->addDays(5 + $i),
                'status' => 'active',
                'created_by' => $creator->id,
                'speed_bonus_enabled' => $i % 2 == 0,
                'speed_bonus_percentage' => 15,
                'speed_bonus_time_threshold' => 600,
                'penalty_enabled' => $i % 2 == 1,
                'penalty_percentage' => 10,
                'duration_seconds' => 1800 + ($i * 600),
            ]);
        }

        // Create 5 inactive competitions
        for ($i = 1; $i <= 5; $i++) {
            Competition::create([
                'title' => "Inactive Competition $i",
                'description' => "This is inactive competition number $i. It has been closed and is no longer accepting participants.",
                'start_date' => now()->subDays(20 + $i),
                'end_date' => now()->subDays(10 + $i),
                'status' => 'inactive',
                'created_by' => $creator->id,
                'speed_bonus_enabled' => false,
                'speed_bonus_percentage' => 0,
                'speed_bonus_time_threshold' => 0,
                'penalty_enabled' => false,
                'penalty_percentage' => 0,
                'duration_seconds' => 3600,
            ]);
        }

        $this->command->info('✓ 15 competitions created successfully (5 draft, 5 active, 5 inactive)');
    }
}
