<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $user = auth()->user();
            $emailParts = explode('@', $user->email);
            $domain = 'designer.org';

            if ($emailParts[1] === $domain) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized action.');
    }
}
