<?php
// app/Http/Middleware/AuthorizeActionMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorizeActionMiddleware
{
    public function handle(Request $request, Closure $next, $action = null)
    {
        // Check user permission
        if (!Auth::check() || !Auth::user()->can($action)) {
            // Assuming a "can" method exists on the User model for permissions
            abort(403, "Unauthorized action.");
        }

        return $next($request);
    }
}

