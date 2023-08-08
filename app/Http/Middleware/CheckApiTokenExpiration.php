<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckApiTokenExpiration
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! Cache::get('bearer_token', false)) {
            return $next($request);
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.Cache::get('bearer_token'),
            'Accept' => 'application/json',
        ])->get(config('api.url').'/me');

        if (! $response->successful()) {
            Cache::delete('bearer_token');

            return redirect()->route('login');
        }

        Session::put('user', $response->json('data.me'));

        return $next($request);
    }
}
