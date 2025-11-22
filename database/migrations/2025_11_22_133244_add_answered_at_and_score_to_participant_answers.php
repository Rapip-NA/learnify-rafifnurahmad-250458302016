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
        Schema::table('participant_answers', function (Blueprint $table) {
            $table->timestamp('answered_at')->nullable()->after('time_spent');
            $table->decimal('score_earned', 8, 2)->default(0)->after('answered_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participant_answers', function (Blueprint $table) {
            $table->dropColumn(['answered_at', 'score_earned']);
        });
    }
};
