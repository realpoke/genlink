<?php

namespace App\Actions\Auth;

use App\Contracts\Auth\LogoutUserContract;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Native\Laravel\Facades\MenuBar;

class LogoutUser implements LogoutUserContract
{
    public function __invoke()
    {
        $bearerToken = Cache::get('bearer_token');

        if ($bearerToken) {
            try {
                Http::withHeaders([
                    'Authorization' => 'Bearer '.$bearerToken,
                    'Accept' => 'application/json',
                ])->post(config('api.url').'/api/logout');
            } catch (\Throwable $th) {
            }
        }

        if (request()->hasSession()) {
            request()->session()->invalidate();
            request()->session()->regenerateToken();
        }

        Session::forget('user');
        Cache::forget('bearer_token');

        MenuBar::label('');
    }
}
