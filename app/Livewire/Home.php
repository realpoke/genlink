<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Native\Laravel\Dialog;
use Native\Laravel\Facades\Notification;

class Home extends Component
{
    public function test()
    {
        // TODO: Fix the disks for native.
        dd(Storage::disk('documents')->files());
        $folder = Dialog::new()->folders()->open();
        dd($folder);
        // Notification::title('Hello from NativePHP')
        //     ->message('This is a detail message coming from your Laravel app.')
        //     ->show();
    }
}
