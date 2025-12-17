<?php

namespace App\Jobs;

use App\Models\Notifications;
use App\Models\PushNotification;
use Minishlink\WebPush\Subscription;
use Minishlink\WebPush\WebPush;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendPushNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        $msg = Notifications::find($this->data['notification_id']);
        if (!$msg) return;

        $auth = [
            'VAPID' => [
                'subject' => 'mailto:info@andamanbliss.com',
                'publicKey' => env('VAPID_PUBLIC_KEY'),
                'privateKey' => env('VAPID_PRIVATE_KEY'),
            ],
        ];

        $webPush = new WebPush($auth);

        $payload = json_encode([
            'title' => $msg->title,
            'body'  => strip_tags($msg->message),
            'icon'  => 'https://andamanbliss.com/images/logo.png',
            'image' => $msg->drive ? asset('storage/notifications/' . $msg->drive->file_name) : null,
            'url'   => $msg->action_url,
            'actions' => [
                ['action' => 'booknow', 'title' => 'Book Now'],
            ],
            'requireInteraction' => true, // stays visible until user closes
            'vibrate' => [200, 100, 200, 100, 200],
            'timestamp' => now()->timestamp,
            'tag' => 'notification-' . uniqid(), // unique ID every time
            'renotify' => true, // prevents overwriting
        ]);

        $subscriptions = PushNotification::all();

        foreach ($subscriptions as $sub) {
            $webPush->queueNotification(
                Subscription::create(json_decode($sub->subscriptions, true)),
                $payload
            );
        }

        foreach ($webPush->flush() as $report) {
            // You can log failures here
            Log::info('Push Notification Report: ', ['report' => $report]);
        }
    }
}
