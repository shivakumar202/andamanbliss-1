<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use App\Models\PushNotification;
use App\Models\PushNotificationMsgs;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Minishlink\WebPush\Subscription;
use Minishlink\WebPush\WebPush;
use Stevebauman\Location\Facades\Location;


class PushNotificationController extends Controller
{
    //
    public function sendNotification()
    {
        $auth = [
            'VAPID' => [
                'subject' => 'mailto:info@andamanbliss.com',
                'publicKey' => env('VAPID_PUBLIC_KEY'),
                'privateKey' => env('VAPID_PRIVATE_KEY'),
            ],
        ];

        $webPush = new WebPush($auth);

        $notificationsMsg = Notifications::with('drive')
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        $subscriptions = PushNotification::all();

        foreach ($notificationsMsg as $msg) {
            $payload = json_encode([
                'title' => $msg->title,
                'body'  => strip_tags($msg->message),
                // 'icon'  => 'https://andamanbliss.com/images/logo.png',
                'image' => $msg->drive ? asset('storage/notifications/' . $msg->drive->file_name) : null,
                'url'   => $msg->action_url,
                'actions' => [
                    ['action' => 'booknow', 'title' => 'Book Now'],
                ],
                'requireInteraction' => true, // stays visible until user closes
                'vibrate' => [200, 100, 200, 100, 200],
                'timestamp' => now()->timestamp,
                'tag' => 'notification-' . uniqid(), // unique ID every time
                'renotify' => false, // prevents overwriting
            ]);

            foreach ($subscriptions as $sub) {
                $webPush->queueNotification(
                    Subscription::create(json_decode($sub->subscriptions, true)),
                    $payload
                );
            }

            foreach ($webPush->flush() as $report) {
                $endpoint = $report->getRequest()->getUri()->__toString();
                if (!$report->isSuccess()) {
                    \Log::error("Push failed for {$endpoint}: " . $report->getReason());
                }
            }

            sleep(6); // wait before sending next notification
        }

        return response()->json(['message' => 'All notifications sent successfully and persist in center.']);
    }





    public function saveSubscription(Request $request)
    {
        $sub = $request->sub;
        $endpoint = $sub['endpoint'] ?? null;

        if (!$endpoint) {
            return response()->json(['message' => 'Invalid subscription'], 400);
        }

        $exists = PushNotification::whereRaw(
            "JSON_UNQUOTE(JSON_EXTRACT(subscriptions, '$.endpoint')) = ?",
            [$endpoint]
        )->exists();

        if (!$exists) {
            PushNotification::updateOrCreate(
                ['endpoint' => $endpoint],
                ['subscriptions' => json_encode($sub)]
            );
        }

        // Set cookie for middleware
        return response()
            ->json(['message' => 'Subscription saved'])
            ->cookie('push_subscriber', $endpoint, 525600);
    }



    public function TestNotification()
    {
        $visitors = PushNotification::select('endpoint')->get();

        $data = [];

        foreach ($visitors as $visitor) {
            $data[$visitor->endpoint] = Visit::where('endpoint', $visitor->endpoint)->get();
        }

        Log::info('Visitor Data: ', $data);
        return response()->json([
            'visitors' => $data
        ]);
    }



    public function duration(Request $request)
    {
        try {
            $data = $request->json()->all();

            $url = $data['url'] ?? null;
            $duration = isset($data['duration']) ? (int) $data['duration'] : 0;

            if (!$url || $duration <= 0) {
                return response()->json(['status' => 'ignored']);
            }

            $cleanUrl = ltrim($url, '/');

            $ip = $request->ip();

            if (!$ip) {
                Log::warning("Duration ignored: No IP detected", [
                    'url' => $cleanUrl
                ]);
                return response()->json(['status' => 'ignored-no-ip']);
            }

            $visit = Visit::where('url', $cleanUrl)
                ->where('ip', $ip)
                ->latest()
                ->first();

            if (!$visit) {
                Log::warning("Duration ignored: Visit not found", [
                    'url' => $cleanUrl,
                    'ip' => $ip
                ]);

                return response()->json(['status' => 'no-visit-found']);
            }

            $visit->duration = $duration;
            $visit->save();

         
            return response()->json(['status' => 'updated']);
        } catch (\Exception $e) {
            Log::error("Duration update failed", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong'
            ], 500);
        }
    }


     public function getUserLocation()
        {
            $ipAddress = '122.173.82.215';

            if ($position = Location::get($ipAddress)) {
                // Access location details:
                // $position->countryName, $position->city, $position->latitude, etc.
                return response()->json($position);
                return view('location_details', ['location' => $position]);
            } else {
                // Handle cases where location data cannot be retrieved
                return view('location_details', ['location' => null, 'error' => 'Location not found.']);
            }
        }








}
