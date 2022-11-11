<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserStatusMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_active == false) {
            Auth::logout();
            return redirect()->route('login.form')
                ->withErrors('You are BANNED ,to get unban call with admins');
        }
        return $next($request);


    }
}
