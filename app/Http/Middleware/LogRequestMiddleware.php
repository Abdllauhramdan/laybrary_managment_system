<?php
// app/Http/Middleware/LogRequestMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogRequestMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Log the request details
        Log::info('Request Logged', [
            'url' => $request->url(),
            'method' => $request->method(),
            'ip' => $request->ip(),
            'user_id' => $request->user() ? $request->user()->id : 'Guest'
        ]);

        return $next($request);
    }
}


