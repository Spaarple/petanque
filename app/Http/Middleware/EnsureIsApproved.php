<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
// log
use Illuminate\Support\Facades\Log;

class EnsureIsApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() or Auth::user()->is_approved == 0) {
            // Si l'utilisateur est connecté mais pas vérifié, rediriger vers la page d'accueil

            return redirect('/');
        }

        return $next($request);
    }
}
