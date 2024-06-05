<?php

use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Route;

Route::middleware('check')->group(function () {
    Route::get('login', Login::class)
        ->name('login');
});
