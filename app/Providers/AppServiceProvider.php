<?php

namespace App\Providers;

use App\Actions\Auth\AuthenticateUser;
use App\Actions\Auth\LogoutUser;
use App\Contracts\Auth\AuthenticatesUserContract;
use App\Contracts\Auth\LogoutUserContract;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthenticatesUserContract::class, Authenticateuser::class);
        $this->app->bind(LogoutUserContract::class, LogoutUser::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::if('hasuser', function () {
            return session()->has('user');
        });
    }
}
