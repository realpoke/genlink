<?php

namespace App\Livewire\Auth;

use App\Contracts\Auth\AuthenticatesUserContract;
use App\Livewire\Forms\Auth\LoginForm;
use Livewire\Component;

class Login extends Component
{
    public LoginForm $form;

    public function login(AuthenticatesUserContract $authenticator)
    {
        if ($authenticator($this->form)) {
            return $this->redirectRoute('home', navigate: true);
        }

        $this->addError('form.email', __('auth.failed'));
    }
}
