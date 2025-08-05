<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $permission): Response
    {
       
        if (auth()->check() && auth()->user()->hasPermission($permission)) {
            return $next($request);
        }

           return response()->json(['message' => 'Permission denied'], 403);
    }
}
