<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

// Middleware to restrict access to administrator users only
class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Allow only login users whose role is admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        abort(403, 'Unauthorized access.');
    }
}