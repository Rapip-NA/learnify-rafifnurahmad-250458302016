<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('competitions', function (Blueprint $table) {
            $table->boolean('speed_bonus_enabled')->default(true)->after('status');
            $table->decimal('speed_bonus_percentage', 5, 2)->default(20.00)->after('speed_bonus_enabled');
            $table->integer('speed_bonus_time_threshold')->default(30)->after('speed_bonus_percentage')->comment('in seconds');
            $table->boolean('penalty_enabled')->default(false)->after('speed_bonus_time_threshold');
            $table->decimal('penalty_percentage', 5, 2)->default(10.00)->after('penalty_enabled');
            $table->integer('duration_seconds')->default(300)->after('penalty_percentage')->comment('quiz duration in seconds');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('competitions', function (Blueprint $table) {
            $table->dropColumn([
                'speed_bonus_enabled',
                'speed_bonus_percentage',
                'speed_bonus_time_threshold',
                'penalty_enabled',
                'penalty_percentage',
                'duration_seconds'
            ]);
        });
    }
};
