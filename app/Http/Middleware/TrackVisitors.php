<?php

namespace App\Http\Middleware;

use App\Models\Visitors;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->is('admin/*') && !$request->is('api/*')) {
            $ip = $request->ip();
            $userAgent = substr($request->userAgent() ?? 'unknown', 0, 255);

            $exists = Visitors::where('ip_address', $ip)
                ->whereDate('visited_at', Carbon::today())
                ->exists();

            if (!$exists) {
                Visitors::create([
                    'ip_address' => $ip,
                    'user_agent' => $userAgent,
                    'path' => url()->current(),
                    'visited_at' => Carbon::now(),
                ]);
            }
        }

        return $next($request);
    }
}
