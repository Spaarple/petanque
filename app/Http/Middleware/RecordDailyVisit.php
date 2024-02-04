<?php

// app/Http/Middleware/RecordDailyVisit.php

// app/Http/Middleware/RecordDailyVisit.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\DailyVisit;
use App\Models\IpVisit;
use Carbon\Carbon;

class RecordDailyVisit
{
    public function handle(Request $request, Closure $next)
    {
        $today = Carbon::today();
        $ip = $request->ip();
        $dailyVisit = DailyVisit::firstOrCreate(['date' => $today], ['visits' => 0, 'unique_visitors' => 0]);

        // Enregistre une visite
        $dailyVisit->increment('visits');

        // Vérifie et enregistre un visiteur unique
        if (!$this->hasVisitedToday($ip, $today)) {
            $dailyVisit->increment('unique_visitors');
            IpVisit::create(['ip' => $ip, 'date' => $today]);
        }

        return $next($request);
    }

    private function hasVisitedToday($ip, $date)
    {
        return IpVisit::where('ip', $ip)->where('date', $date)->exists();
    }
}
