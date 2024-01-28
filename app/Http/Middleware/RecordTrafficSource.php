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
        $referer = $request->header('referer');

        TrafficSource::updateOrCreate(
            ['referer' => $referer],
            ['hits' => DB::raw('hits + 1')]
        );

        return $next($request);
    }
}
