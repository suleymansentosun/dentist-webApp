<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App;

class IsAdminOrEmployee
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
        if (Auth::check() && $request->user()->hasAnyRole(['Admin', 'Employee'])) {
            return $next($request);
        } else {
            return redirect('/' . App::getLocale() . '/home');
        }
    }
}
