<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */

    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('booking:cancel-remainder')->everyFiveMinutes();
        // $schedule->command('google:fetch-reviews')->cron('0 0 */15 * *');
        $schedule->command('notifications:send')->hourly();
        $schedule->command('visits:clean')->dailyAt('02:00');
        $schedule->command('google:fetch-review-photos')->weekly();
    }

    protected $commands = [
        \App\Console\Commands\MigrateActivities::class,
    ];


    /**
     * Register the commands for the application.
     */

    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
