<?php

namespace App\Actions\Auth;

use App\Contracts\Auth\AuthenticatesUserContract;
use App\Livewire\Forms\Auth\LoginForm;
use App\Traits\withLimits;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Native\Laravel\Facades\MenuBar;
use Native\Laravel\Facades\Notification;

class AuthenticateUser implements AuthenticatesUserContract
{
    use withLimits;

    public function authenticate(LoginForm $form): bool|Redirector
    {
        $this->limitTo(5, 'form.email', 'authenticate', 60);

        $form->validate();
        try {
            $response = Http::post(config('api.url').'/login', [
                'email' => $form->email,
                'password' => $form->password,
                'token' => 'computer_name',
            ]);
        } catch (\Throwable $th) {
            return Redirect()->route('loading');
        }
        if (! $response->successful()) {
            $form->password = '';

            return false;
        }
        $this->clearRateLimiter();

        Cache::forever('bearer_token', $response->json('data.token'));

        Notification::title('Login')
            ->message('Welcome back '.$response->json('data.me.nickname').'!')
            ->show();

        MenuBar::label('Status: Online');

        return true;
    }
}
