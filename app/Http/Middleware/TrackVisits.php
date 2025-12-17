<?php

namespace App\Http\Middleware;

use Closure;
use Jenssegers\Agent\Agent;
use Torann\GeoIP\Facades\GeoIP;
use App\Models\Visit;
use App\Models\PushNotification;
use Stevebauman\Location\Facades\Location;


class TrackVisits
{
   public function handle($request, Closure $next)
{
    $path = $request->path();

    // Load skip list from config
    $skipList = config('visit.skip', []);

    // Skip logic
    foreach ($skipList as $rule) {

        // Wildcard match
        if (str_ends_with($rule, '/*')) {
            $prefix = rtrim($rule, '/*');
            if (str_starts_with($path, $prefix)) {
                return $next($request);
            }
        }

        // Exact match
        if ($path === $rule) {
            return $next($request);
        }
    }

    $agent = new Agent;
    $loc = $this->getUserLocation($request->ip());
    $endpoint = $request->cookie('push_subscriber');

    if ($endpoint) {
        $sub = PushNotification::where('endpoint', $endpoint)->first();
        if (!$sub) $endpoint = null;
    }

    Visit::create([
        'url'      => $path,
        'ip'       => $request->ip(),
        'country'  => $loc->regionName ?? null,
        'city'     => $loc->cityName ?? null,
        'long'     => $loc->longitude ?? null,
        'lat'      => $loc->latitude ?? null,        
        'device'   => $agent->device(),
        'browser'  => $agent->browser(),
        'endpoint' => $endpoint,
    ]);

    return $next($request);
}


public function getUserLocation($ipAddress)
        {
            $ipAddress = $ipAddress;

            if ($position = Location::get($ipAddress)) {              

                return $position;
            } else {
                // Handle cases where location data cannot be retrieved
                return null;
            }
        }

}
