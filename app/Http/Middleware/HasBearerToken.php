<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class HasBearerToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $bearerToken = Cache::get('bearer_token');

        if (! $bearerToken) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
