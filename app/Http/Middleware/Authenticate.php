<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // If the request expects JSON, return null to prevent redirection
        if ($request->expectsJson()) {
            return null;
        }

        // For non-API requests, you can define a fallback route (optional)
        return route('login'); // Only if you have a web-based login route
    }

    protected function unauthenticated($request, array $guards)
    {
        return response()->json(['error' => 'Unauthenticated.'], 401);
    }
}
