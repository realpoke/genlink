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

class CheckApiTokenExpiration
{
    public function handle(Request $request, Closure $next): Response
    {
        dump('Checking API');
        if (! Cache::get('bearer_token', false)) {
            dump('No token');
            try {
                $response = Http::withHeaders([
                    'Accept' => 'application/json',
                ])->get(config('api.url').'/ping');
            } catch (\Throwable $th) {
                dump('Failed loading api, going to loading');

                MenuBar::label('Status: Loading');

                return redirect()->route('loading');
            }

            if (! $response->successful()) {
                dump('Response failed, going to loading');

                MenuBar::label('Status: Loading');

                return redirect()->route('loading');
            }

            if (Route::currentRouteName() === 'login') {
                dump('On login page already');

                MenuBar::label('Status: Offline');

                return $next($request);
            }

            dump('Going to login');

            return redirect()->route('login');
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.Cache::get('bearer_token'),
                'Accept' => 'application/json',
            ])->timeout(3)->get(config('api.url').'/me');
        } catch (\Throwable $th) {
            Cache::delete('bearer_token');

            dump('Failed to check /me, deleting token and refresh');

            return redirect()->refresh();
        }

        if (! $response->successful()) {
            Cache::delete('bearer_token');

            dump('No access, delete token and refresh');

            return redirect()->refresh();
        }

        dump('All good putting user data into session');

        Session::put('user', $response->json('data.me'));
        MenuBar::label('Status: Online');

        return $next($request);
    }
}
