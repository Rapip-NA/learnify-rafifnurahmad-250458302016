<?php

namespace App\Console\Commands;

use App\Models\Competition;
use Illuminate\Console\Command;

class UpdateExpiredCompetitions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:expired-competitions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status kompetisi yang sudah expired menjadi inactive';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mengecek kompetisi yang sudah expired...');

        // Cari semua kompetisi yang end_date sudah lewat tapi statusnya masih active atau draft
        $expiredCompetitions = Competition::whereIn('status', ['active', 'draft'])
            ->where('end_date', '<', now())
            ->get();

        $count = $expiredCompetitions->count();

        if ($count === 0) {
            $this->info('Tidak ada kompetisi yang perlu diupdate.');
            return 0;
        }

        // Update status menjadi inactive
        foreach ($expiredCompetitions as $competition) {
            $competition->update(['status' => 'inactive']);
            $this->line("- {$competition->title} (ID: {$competition->id}) status diubah menjadi inactive");
        }

        $this->info("✓ Total {$count} kompetisi berhasil diupdate menjadi inactive.");

        return 0;
    }
}
