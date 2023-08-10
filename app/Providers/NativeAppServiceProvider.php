<?php

namespace App\Providers;

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
    }
}
