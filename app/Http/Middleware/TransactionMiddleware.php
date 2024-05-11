<?php
// app/Http/Middleware/TransactionMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class TransactionMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Start transaction
        DB::beginTransaction();

        try {
            $response = $next($request);

            // Commit the transaction
            DB::commit();

            return $response;
        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();

            // Rethrow the exception
            throw $e;
        }
    }
}

