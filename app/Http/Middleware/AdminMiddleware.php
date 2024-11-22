<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
;
        if (!Auth::check() || Auth::user()->role !== 1) { // Assuming role 1 is for admin
            return redirect()->route('login')->with('error', 'You do not have admin access.');
        }

        return $next($request);
    }
}
