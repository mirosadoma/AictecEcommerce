<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MaintenanceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(app_settings() && app_settings()->close == 1){
            return redirect()->route('maintenance');
        }
        return $next($request);
    }
}
