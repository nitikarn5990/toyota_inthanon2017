<?php

namespace App\Http\Middleware;

use App\switch_enabled;
use Closure;
use Illuminate\Support\Facades\Auth;

class WebMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $query = new switch_enabled();
        $check = $query->first();

        $currAction = $request->route()->getAction();

        if ($check->enabled) {

            return $next($request);

        } else if ($currAction['prefix'] === '/mock') {
			
            if (Auth::guard($guard)->guest()) {
                if ($request->ajax() || $request->wantsJson()) {
                    return response('Unauthorized.', 401);
                } else {
                    return redirect()->guest('mock\login');
                }
            }

            return $next($request);
        } else if ($currAction['prefix'] === '/backend') {
            return $next($request);
        } else {
            return redirect('/soon');
        }
    }
}
