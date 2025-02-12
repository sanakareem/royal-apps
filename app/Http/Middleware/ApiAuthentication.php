<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthentication
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('api_token')) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}