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
            // Achievement Badges
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
                'name' => 'Early Bird',
                'description' => 'Ikuti kompetisi di jam 5 pagi - 8 pagi',
                'icon' => 'bi bi-sunrise-fill',
                'image_url' => null,
                'badge_type' => 'special',
                'condition' => json_encode([
                    'type' => 'time_based',
                    'start_hour' => 5,
                    'end_hour' => 8,
                ]),
            ],
            [
                'name' => 'Night Owl',
                'description' => 'Ikuti kompetisi di jam 10 malam - 2 pagi',
                'icon' => 'bi bi-moon-stars-fill',
                'image_url' => null,
                'badge_type' => 'special',
                'condition' => json_encode([
                    'type' => 'time_based',
                    'start_hour' => 22,
                    'end_hour' => 2,
                ]),
            ],
            [
                'name' => 'Rookie Champion',
                'description' => 'Selesaikan 5 kompetisi',
                'icon' => 'bi bi-trophy-fill',
                'image_url' => null,
                'badge_type' => 'milestone',
                'condition' => json_encode([
                    'type' => 'completion_count',
                    'required_count' => 5,
                ]),
            ],
            [
                'name' => 'Veteran',
                'description' => 'Selesaikan 25 kompetisi',
                'icon' => 'bi bi-award-fill',
                'image_url' => null,
                'badge_type' => 'milestone',
                'condition' => json_encode([
                    'type' => 'completion_count',
                    'required_count' => 25,
                ]),
            ],
            [
                'name' => 'Legend',
                'description' => 'Selesaikan 50 kompetisi',
                'icon' => 'bi bi-gem',
                'image_url' => null,
                'badge_type' => 'milestone',
                'condition' => json_encode([
                    'type' => 'completion_count',
                    'required_count' => 50,
                ]),
            ],
            [
                'name' => 'High Scorer',
                'description' => 'Raih skor di atas 80 poin',
                'icon' => 'bi bi-graph-up-arrow',
                'image_url' => null,
                'badge_type' => 'achievement',
                'condition' => json_encode([
                    'type' => 'score_threshold',
                    'required_score' => 80,
                ]),
            ],
            [
                'name' => 'Perfectionist',
                'description' => 'Raih skor sempurna 100 poin dalam 5 kompetisi',
                'icon' => 'bi bi-stars',
                'image_url' => null,
                'badge_type' => 'achievement',
                'condition' => json_encode([
                    'type' => 'perfect_score_multiple',
                    'required_count' => 5,
                ]),
            ],
            [
                'name' => 'Consistent',
                'description' => 'Selesaikan kompetisi 7 hari berturut-turut',
                'icon' => 'bi bi-calendar-check-fill',
                'image_url' => null,
                'badge_type' => 'achievement',
                'condition' => json_encode([
                    'type' => 'streak',
                    'required_days' => 7,
                ]),
            ],
            [
                'name' => 'Top Scorer',
                'description' => 'Raih posisi top 3 dalam kompetisi apapun',
                'icon' => 'bi bi-medal-fill',
                'image_url' => null,
                'badge_type' => 'achievement',
                'condition' => json_encode([
                    'type' => 'top_position',
                    'max_position' => 3,
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
            [
                'name' => 'Challenger',
                'description' => 'Ikuti kompetisi tingkat hard',
                'icon' => 'bi bi-fire',
                'image_url' => null,
                'badge_type' => 'special',
                'condition' => json_encode([
                    'type' => 'difficulty',
                    'required_difficulty' => 'hard',
                ]),
            ],
            [
                'name' => 'Weekend Warrior',
                'description' => 'Selesaikan 10 kompetisi di akhir pekan',
                'icon' => 'bi bi-calendar2-week-fill',
                'image_url' => null,
                'badge_type' => 'special',
                'condition' => json_encode([
                    'type' => 'weekend_completion',
                    'required_count' => 10,
                ]),
            ],
            [
                'name' => 'Fast Learner',
                'description' => 'Tingkatkan skor 20 poin dalam 2 kompetisi berturut-turut',
                'icon' => 'bi bi-rocket-takeoff-fill',
                'image_url' => null,
                'badge_type' => 'achievement',
                'condition' => json_encode([
                    'type' => 'score_improvement',
                    'required_improvement' => 20,
                ]),
            ],
            [
                'name' => 'Knowledge Seeker',
                'description' => 'Selesaikan kompetisi dari 5 kategori berbeda',
                'icon' => 'bi bi-mortarboard-fill',
                'image_url' => null,
                'badge_type' => 'achievement',
                'condition' => json_encode([
                    'type' => 'category_diversity',
                    'required_categories' => 5,
                ]),
            ],
            [
                'name' => 'Marathon Runner',
                'description' => 'Selesaikan kompetisi dengan durasi lebih dari 30 menit',
                'icon' => 'bi bi-hourglass-split',
                'image_url' => null,
                'badge_type' => 'special',
                'condition' => json_encode([
                    'type' => 'long_duration',
                    'min_duration_minutes' => 30,
                ]),
            ],
            [
                'name' => 'Team Player',
                'description' => 'Ikuti 5 kompetisi dengan peserta lain',
                'icon' => 'bi bi-people-fill',
                'image_url' => null,
                'badge_type' => 'social',
                'condition' => json_encode([
                    'type' => 'group_participation',
                    'required_count' => 5,
                ]),
            ],
        ];

        foreach ($badges as $badge) {
            \App\Models\Badge::updateOrCreate(
                ['name' => $badge['name']],
                $badge
            );
        }

        $this->command->info('✓ ' . count($badges) . ' badges created successfully');
    }
}
