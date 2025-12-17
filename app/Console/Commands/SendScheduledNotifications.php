<?php

namespace App\Console\Commands;

use App\Models\Notifications;
use Illuminate\Console\Command;
use App\Jobs\SendPushNotification; // ← Job

class SendScheduledNotifications extends Command
{
    protected $signature = 'notifications:send';
    protected $description = 'Send push notifications in 15-minute intervals';

    public function handle()
    {
        $notifications = Notifications::where('status', 1)->orderBy('created_at', 'asc')->get();

        $delayMinutes = 0;

        foreach ($notifications as $msg) {

            dispatch(new SendPushNotification([
                'notification_id' => $msg->id
            ]))->delay(now()->addMinutes($delayMinutes));

            $delayMinutes += 15;
        }

        $this->info('Scheduled notifications for next 1 hour.');
    }
}
