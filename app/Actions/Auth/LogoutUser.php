<?php

namespace App\Actions\Auth;

use App\Contracts\Auth\LogoutUserContract;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class LogoutUser implements LogoutUserContract
{
    public function logout()
    {
        $bearerToken = Cache::get('bearer_token');

        if ($bearerToken) {
            Http::withHeaders([
                'Authorization' => 'Bearer '.$bearerToken,
                'Accept' => 'application/json',
            ])->post(config('api.url').'/logout');
        }

        if (request()->hasSession()) {
            request()->session()->invalidate();
            request()->session()->regenerateToken();
        }

        Session::forget('user');
        Cache::forget('bearer_token');
    }
}
