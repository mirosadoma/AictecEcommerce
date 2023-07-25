<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use Auth;

class ActiveMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('site.login');
        }
        if (Auth::user()->active == 0) {
            return redirect()->route('site.pages.profile.active')->with(['error', 'يجب تفعيل الحساب أولا']);
        }
        return $next($request);
    }

}
