<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ShipHasBonusPoints
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        $ship = $user->activeShip();
        if ($ship->upgrade_points > 0) {
            return $next($request);
        } else {
            return back()->with('error', 'You do not have upgrade points.');
        }
    }
}
