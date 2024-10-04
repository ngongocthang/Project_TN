<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->route()) {
            return redirect()->route('dashboard.error');
        }

        return $next($request);
    }
}
