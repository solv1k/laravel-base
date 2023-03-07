<?php

namespace Curia\Auth\UI\Api\V1\Middleware;

use Closure;
use Curia\Auth\Exceptions\AuthException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
    
        if ($user && !$user->isAdmin()) {
            auth()->logout();
            throw new AuthException;
        }

        return $next($request);
    }
}
