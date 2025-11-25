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
        Schema::table('badges', function (Blueprint $table) {
            $table->string('icon')->nullable()->after('name'); // Bootstrap icon class or emoji
            $table->string('image_url')->nullable()->after('icon'); // Optional custom image
            $table->enum('badge_type', ['achievement', 'streak', 'milestone', 'special'])->default('achievement')->after('image_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('badges', function (Blueprint $table) {
            $table->dropColumn(['icon', 'image_url', 'badge_type']);
        });
    }
};
