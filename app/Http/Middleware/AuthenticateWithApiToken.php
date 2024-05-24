<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class AuthenticateWithApiToken
{
    public function handle($request, Closure $next)
    {
        if (!Session::has('token_key')) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}

