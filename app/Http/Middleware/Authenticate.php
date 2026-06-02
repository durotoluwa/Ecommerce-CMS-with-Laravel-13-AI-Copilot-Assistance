<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request): ?string
{
    if (! $request->expectsJson()) {

        /*
        |------------------------------------------------------------------
        | ADMIN ROUTES
        |------------------------------------------------------------------
        */

        if ($request->is('admin') || $request->is('admin/*')) {

            return route('login');
        }

        /*
        |------------------------------------------------------------------
        | CUSTOMER / FRONTEND
        |------------------------------------------------------------------
        */

        return route('welcome');
    }

    return null;
}
}
