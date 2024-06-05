<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Loading extends Component
{
    public function loadingCheck()
    {
        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])->get(config('api.url').'/api/ping');
        } catch (\Throwable $th) {
            return;
        }

        if ($response->successful()) {
            return redirect()->route('home');
        }
    }
}
