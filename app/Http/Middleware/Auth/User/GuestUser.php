<?php

namespace App\Http\Middleware\Auth\User;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class GuestUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!(auth()->user())) {
            return $next($request);
        } elseif (auth()->user()->role == 'admin') {
            Auth::logout();
            return $next($request);
        } else {
            return redirect()->route('user.dashboard.index');
        }
    }
}
