<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\Auth\UserRole;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->role->value === $role) {
            return $next($request);
        }

        return redirect()->route('login')->with('error', 'You do not have access to this page.');
    }
}
##########Http->Middleware->Role->RoleMiddleware.php###############
