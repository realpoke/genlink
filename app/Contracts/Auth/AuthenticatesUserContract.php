<?php

namespace App\Contracts\Auth;

use App\Livewire\Forms\Auth\LoginForm;
use Illuminate\Routing\Redirector;

interface AuthenticatesUserContract
{
    public function authenticate(LoginForm $form): bool|Redirector;
}
