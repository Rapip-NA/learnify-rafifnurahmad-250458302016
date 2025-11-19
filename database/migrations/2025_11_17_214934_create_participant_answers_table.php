<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('participant_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('competition_participant_id')->constrained()->onDelete('cascade');
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->foreignId('answer_id')->constrained()->onDelete('cascade');
            $table->boolean('is_correct')->default(false);
            $table->integer('time_spent')->default(0); // in seconds
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('validation_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamp('created_at')->nullable();

            $table->unique(['competition_participant_id', 'question_id'], 'unique_participant_question');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participant_answers');
    }
};
