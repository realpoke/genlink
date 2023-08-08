<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Native\Laravel\Facades\MenuBar;
use Native\Laravel\Facades\Window;

class NativeAppServiceProvider
{
    public function boot(): void
    {
        Window::open()
            ->width(1400)
            ->height(900);

        MenuBar::create()
            ->showDockIcon();

        // TODO: Extract to action
        if (Cache::get('bearer_token', false)) {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.Cache::get('bearer_token'),
                'Accept' => 'application/json',
            ])->get(config('api.url').'/me');

            if (! $response->successful()) {
                MenuBar::label('Status: Online');
            }
        }
    }
}
