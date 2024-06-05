<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Native\Laravel\Facades\MenuBar;
use Symfony\Component\HttpFoundation\Response;

class CheckConnection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Cache::get('bearer_token', false)) {
            try {
                $response = Http::withHeaders([
                    'Accept' => 'application/json',
                ])->get(config('api.url').'/api/ping');
            } catch (\Throwable $th) {
                MenuBar::label('Status: Loading');

                return redirect()->route('loading');
            }

            if (! $response->successful()) {
                MenuBar::label('Status: Loading');

                return redirect()->route('loading');
            }

            if (Route::currentRouteName() === 'login' || Route::currentRouteName() === 'home') {
                MenuBar::label('Status: Offline');

                return $next($request);
            }

            return redirect()->route('login');
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.Cache::get('bearer_token'),
                'Accept' => 'application/json',
            ])->timeout(3)->get(config('api.url').'/api/me');
        } catch (\Throwable $th) {
            Cache::delete('bearer_token');

            return redirect()->refresh();
        }

        if (! $response->successful()) {
            Cache::delete('bearer_token');

            return redirect()->refresh();
        }
        Session::put('user', $response->json('data.me'));
        MenuBar::label('Status: Online');

        if (Route::currentRouteName() === 'login') {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
