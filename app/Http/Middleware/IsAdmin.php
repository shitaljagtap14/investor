<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /* if (Auth::check()) {
             $user = Auth::user();
             if ($user->is_admin) {
                 return $next($request);
             } else {
                 if (!$user->is_verified) {
                     Flash::warning('Please verify your email and try again!');
                     Auth::logout();
                     return redirect('login');
                 }
             }
         }
         return $next($request);
     }*/

        if (Auth::check()) {
            $user = Auth::user();
            if ($user->is_admin) {
                return $next($request);
            }
        }
        return $next($request);
    }
}