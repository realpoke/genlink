<?php

namespace App\Actions\Auth;

use App\Contracts\Auth\AuthenticatesUserContract;
use App\Livewire\Forms\Auth\LoginForm;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Native\Laravel\Facades\MenuBar;
use Native\Laravel\Facades\Notification;

class AuthenticateUser implements AuthenticatesUserContract
{
    public function __invoke(LoginForm $form): bool|Redirector
    {
        $form->validate();
        try {
            $response = Http::post(config('api.url').'/api/login', [
                'email' => $form->email,
                'password' => $form->password,
                'token' => 'computer_name',
            ]);
        } catch (\Throwable $th) {
            return false;
        }

        if (! $response->successful()) {
            $form->password = '';

            return false;
        }

        Cache::forever('bearer_token', $response->json('data.token'));

        Notification::title('Login')
            ->message('Welcome back '.$response->json('data.me.name').'!')
            ->show();

        MenuBar::label('Status: Online');

        return true;
    }
}
