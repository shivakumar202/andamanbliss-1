<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Visit;
use Carbon\Carbon;

class CleanOldVisits extends Command
{
    protected $signature = 'visits:clean';
    protected $description = 'Delete visits older than 30 days';

    public function handle()
    {
        $date = Carbon::now()->subDays(30);

        $deleted = Visit::where('created_at', '<', $date)->delete();

        $this->info("Deleted $deleted old visit records older than 30 days.");
    }
}
