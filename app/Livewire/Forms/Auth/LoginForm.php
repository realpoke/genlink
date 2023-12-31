<?php

namespace App\Livewire\Forms\Auth;

use App\Traits\Rules\AuthRules;
use Livewire\Form;

class LoginForm extends Form
{
    use AuthRules;

    public string $email = '';

    public string $password = '';

    public function rules(): array
    {
        return [
            'email' => AuthRules::loginKeyRules(),
            'password' => AuthRules::loginPasswordRules(),
        ];
    }
}
