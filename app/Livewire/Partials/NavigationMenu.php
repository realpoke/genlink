<?php

namespace App\Livewire\Partials;

use App\Contracts\Auth\LogoutUserContract;
use Livewire\Component;

class NavigationMenu extends Component
{
    public function logout(LogoutUserContract $logouter)
    {
        $logouter();

        return $this->redirectRoute('home', navigate: true);
    }
}
