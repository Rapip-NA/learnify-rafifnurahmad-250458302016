<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $badges = [
            [
                'name' => 'First Step',
                'description' => 'Selesaikan kompetisi pertama Anda',
                'icon' => 'bi bi-flag-fill',
                'image_url' => null,
                'badge_type' => 'milestone',
                'condition' => json_encode([
                    'type' => 'completion_count',
                    'required_count' => 1,
                ]),
            ],
            [
                'name' => 'Perfect Score',
                'description' => 'Raih skor sempurna 100 poin dalam satu kompetisi',
                'icon' => 'bi bi-star-fill',
                'image_url' => null,
                'badge_type' => 'achievement',
                'condition' => json_encode([
                    'type' => 'perfect_score',
                    'required_score' => 100,
                ]),
            ],
            [
                'name' => 'Quiz Master',
                'description' => 'Selesaikan 10 kompetisi',
                'icon' => 'bi bi-book-fill',
                'image_url' => null,
                'badge_type' => 'milestone',
                'condition' => json_encode([
                    'type' => 'completion_count',
                    'required_count' => 10,
                ]),
            ],
            [
                'name' => 'Speed Demon',
                'description' => 'Selesaikan kompetisi dalam waktu kurang dari 5 menit',
                'icon' => 'bi bi-lightning-fill',
                'image_url' => null,
                'badge_type' => 'achievement',
                'condition' => json_encode([
                    'type' => 'speed_completion',
                    'max_duration_minutes' => 5,
                ]),
            ],
            [
                'name' => 'Champion',
                'description' => 'Raih posisi #1 dalam kompetisi apapun',
                'icon' => 'bi bi-crown-fill',
                'image_url' => null,
                'badge_type' => 'achievement',
                'condition' => json_encode([
                    'type' => 'first_place',
                ]),
            ],
        ];

        foreach ($badges as $badge) {
            \App\Models\Badge::updateOrCreate(
                ['name' => $badge['name']],
                $badge
            );
        }

        $this->command->info('✓ 5 badges created successfully');
    }
}
