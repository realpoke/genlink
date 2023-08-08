<?php

namespace App\Providers;

use Native\Laravel\Facades\Window;

class NativeAppServiceProvider
{
    /**
     * Executed once the native application has been booted.
     * Use this method to open windows, register global shortcuts, etc.
     */
    public function boot(): void
    {
        Window::open()
            ->width(1400)
            ->height(900);
    }
}
