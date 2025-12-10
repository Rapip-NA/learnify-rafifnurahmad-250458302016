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
        // Check if table has existing records
        $hasRecords = DB::table('competitions')->exists();

        if ($hasRecords) {
            // For existing databases with data
            Schema::table('competitions', function (Blueprint $table) {
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
                $table->string('uid', 36)->unique()->change();
            });
        } else {
            // For fresh migrations (no existing data)
            // Create as nullable first to let model boot method handle UID generation
            Schema::table('competitions', function (Blueprint $table) {
                $table->string('uid', 36)->nullable()->unique()->after('id');
            });
        }
    }

    public function down(): void
    {
        Schema::table('competitions', function (Blueprint $table) {
            $table->dropColumn('uid');
        });
    }
};
