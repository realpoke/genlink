<?php

use App\Livewire\Home;
use App\Livewire\Loading;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/loading', Loading::class)
    ->name('loading');

Route::get('/', Home::class)
    ->middleware('check')
    ->name('home');
