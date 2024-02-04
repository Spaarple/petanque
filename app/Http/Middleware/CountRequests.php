<?php

// app/Http/Middleware/CountRequests.php

namespace App\Http\Middleware;

use Closure;
use App\Models\PageView;
use App\Models\IpView;

class CountRequests
{
    public function handle($request, Closure $next)
    {
        $page = $request->path();

        $pageView = PageView::firstOrCreate(['page' => $page]);
        $pageView->increment('views');

        $ip = $request->ip();

        $ipView = IpView::firstOrCreate(['ip' => $ip]);
        $ipView->increment('views');

        return $next($request);
    }
}

