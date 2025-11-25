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
        // $badges = [
        //     [
        //         'name' => 'First Step',
        //         'description' => 'Selesaikan kompetisi pertama Anda',
        //         'icon' => '🎯',
        //         'badge_type' => 'milestone',
        //         'condition' => json_encode([
        //             'type' => 'first_completion',
        //         ]),
        //     ],
        //     [
        //         'name' => 'Perfect Score',
        //         'description' => 'Raih skor sempurna 100% dalam satu kompetisi',
        //         'icon' => '⭐',
        //         'badge_type' => 'achievement',
        //         'condition' => json_encode([
        //             'type' => 'perfect_score',
        //             'required_count' => 1,
        //         ]),
        //     ],
        //     [
        //         'name' => 'Perfectionist',
        //         'description' => 'Raih skor sempurna 100% dalam 5 kompetisi',
        //         'icon' => '🏆',
        //         'badge_type' => 'achievement',
        //         'condition' => json_encode([
        //             'type' => 'perfect_score',
        //             'required_count' => 5,
        //         ]),
        //     ],
        //     [
        //         'name' => 'Quiz Master',
        //         'description' => 'Selesaikan 10 kompetisi',
        //         'icon' => '📚',
        //         'badge_type' => 'milestone',
        //         'condition' => json_encode([
        //             'type' => 'completion_count',
        //             'required_count' => 10,
        //         ]),
        //     ],
        //     [
        //         'name' => 'Speed Demon',
        //         'description' => 'Selesaikan kompetisi dalam waktu kurang dari setengah batas waktu',
        //         'icon' => '⚡',
        //         'badge_type' => 'achievement',
        //         'condition' => json_encode([
        //             'type' => 'speed_completion',
        //             'time_percentage' => 50,
        //         ]),
        //     ],
        //     [
        //         'name' => 'Top Scorer',
        //         'description' => 'Raih posisi top 3 dalam kompetisi apapun',
        //         'icon' => '🥇',
        //         'badge_type' => 'achievement',
        //         'condition' => json_encode([
        //             'type' => 'top_scorer',
        //             'top_position' => 3,
        //         ]),
        //     ],
        // ];

        // foreach ($badges as $badge) {
        //     \App\Models\Badge::updateOrCreate(
        //         ['name' => $badge['name']],
        //         $badge
        //     );
        // }
    }
}
