<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('competitions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('status', ['draft', 'active', 'inactive'])->default('draft');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            $table->integer('duration_minutes')->default(60)->after('status'); // durasi dalam menit
        });
    }



    public function down(): void
    {
        Schema::dropIfExists('competitions');

        Schema::table('competitions', function (Blueprint $table) {
            $table->dropColumn('duration_minutes');
        });
    }
};
