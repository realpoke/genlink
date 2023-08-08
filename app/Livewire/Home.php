<?php

namespace App\Livewire;

use Livewire\Component;
use Native\Laravel\Facades\Notification;

class Home extends Component
{
    public function test()
    {
        Notification::title('Hello from NativePHP')
            ->message('This is a detail message coming from your Laravel app.')
            ->show();
    }
}
