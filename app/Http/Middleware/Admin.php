<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('login')->with('warning', 'You have not permission for this page');
        }

        if (Auth::user()->hasRole('admin')) {
            return $next($request);
        }
        return redirect('home')->with('warning', 'You have not permission for this page');
    }
}
