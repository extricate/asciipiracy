<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class HasActiveShip
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
        // Check if the user has an active ship
        $user = Auth::user();
        if ($user->activeShip() == null) {
            return redirect(route('home'))->with('message', 'Perhaps get on a ship first, captain?');
        } else {
            return $next($request);
        }
    }
}
