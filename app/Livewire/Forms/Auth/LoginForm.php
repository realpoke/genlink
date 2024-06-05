<?php

namespace App\Livewire\Forms\Auth;

use Livewire\Form;

class LoginForm extends Form
{
    public string $email = '';

    public string $password = '';

    public function rules(): array
    {
        return [
            'email' => 'required',
            'password' => 'required',
        ];
    }
}
