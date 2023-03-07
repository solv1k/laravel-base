<?php

namespace Curia\Auth\UI\Web\Middleware;

use Closure;
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
            return redirect(route('nova.login'));
        }

        return $next($request);
    }
}
