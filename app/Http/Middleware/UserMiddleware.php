<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 2) { // Assuming role 2 is for regular users
            return redirect()->route('admin-login')->with('error', 'You do not have user access.');
        }

        return $next($request);
    }
}
