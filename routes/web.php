<?php

use App\Livewire\Landing;
use App\Livewire\Loading;
use Illuminate\Support\Facades\Route;

Route::middleware('check')->group(function () {
    Route::get('/loading', Loading::class)->name('loading');
    Route::get('/', Landing::class)->name('home');
});
