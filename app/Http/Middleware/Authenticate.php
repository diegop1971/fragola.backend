<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    /*
    lo reemplace porque el front es un SPA con lo cual no quiero que redirija a ningún lado
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }   */

    protected function redirectTo(Request $request): ?string
    {
        return null;
    }
}