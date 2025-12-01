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
            // Make answer_id nullable for essay questions
            $table->foreignId('answer_id')->nullable()->change();
            
            // Add essay answer text field
            $table->text('essay_answer_text')->nullable()->after('answer_id');
            
            // Add grading status for essay questions
            $table->enum('grading_status', ['pending', 'graded', 'not_applicable'])
                  ->default('not_applicable')
                  ->after('validation_status');
            
            // Add graded timestamp
            $table->timestamp('graded_at')->nullable()->after('grading_status');
            
            // Add grading notes/feedback from admin
            $table->text('grading_notes')->nullable()->after('graded_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participant_answers', function (Blueprint $table) {
            $table->dropColumn(['essay_answer_text', 'grading_status', 'graded_at', 'grading_notes']);
            
            // Restore answer_id to not nullable (if needed, but this may fail if there are essay answers)
            // $table->foreignId('answer_id')->nullable(false)->change();
        });
    }
};
