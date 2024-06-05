<?php

namespace App\Contracts\Auth;

use App\Livewire\Forms\Auth\LoginForm;
use Illuminate\Routing\Redirector;

interface AuthenticatesUserContract
{
    public function __invoke(LoginForm $form): bool|Redirector;
}
