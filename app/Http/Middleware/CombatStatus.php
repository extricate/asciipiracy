<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CombatStatus
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
        // Check if the user is in combat, if so redirect to the combat page
        $user_is_in_combat = Auth::user()->user_is_in_combat;
        if ($user_is_in_combat == true) {
            return redirect(route('view_combat'))->with('message', 'Perhaps you should finish the fight first, captain?');
        } else {
            return $next($request);
        }
    }
}
