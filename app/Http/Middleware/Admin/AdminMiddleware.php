<?php

namespace App\Http\Middleware\Admin;
use App\Enums\Auth\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === UserRole::Admin) {
            return $next($request);
        }

        return redirect()->route('admin.login')->with('error', 'You must be an admin to access this page.');
    }
}

##########Http->Middleware->Admin->AdminMiddleware.php###############
