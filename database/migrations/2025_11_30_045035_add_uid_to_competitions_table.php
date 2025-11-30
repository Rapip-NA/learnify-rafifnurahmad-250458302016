<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('competitions', function (Blueprint $table) {
            // Add uid column after id
            $table->string('uid', 36)->nullable()->after('id');
        });

        // Generate UID for existing competitions
        $competitions = DB::table('competitions')->get();
        foreach ($competitions as $competition) {
            DB::table('competitions')
                ->where('id', $competition->id)
                ->update(['uid' => (string) Str::uuid()]);
        }

        // Make uid unique and not nullable
        Schema::table('competitions', function (Blueprint $table) {
            $table->string('uid', 36)->nullable(false)->unique()->change();
            $table->index('uid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('competitions', function (Blueprint $table) {
            $table->dropIndex(['uid']);
            $table->dropColumn('uid');
        });
    }
};
