<?php

// app/Http/Middleware/RecordTrafficSource.php

namespace App\Http\Middleware;

use Closure;
use App\Models\TrafficSource;
use Illuminate\Support\Facades\DB;

class RecordTrafficSource
{
    public function handle($request, Closure $next)
    {
        // if referer come from the same site, we don't record it
        $referer = $request->header('referer');
        // domain name to not record if contains :
        // - localhost
        // - 127.0.0.1
        // - your domain name
        
        $domain = $_SERVER['HTTP_HOST'];
        if (strpos($referer, $domain) !== false) {
            return $next($request);
        }

        TrafficSource::updateOrCreate(
            ['referer' => $referer],
            ['hits' => DB::raw('hits + 1')]
        );

        return $next($request);
    }
}
