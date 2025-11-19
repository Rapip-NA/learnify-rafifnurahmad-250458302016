<?php

use App\Livewire\Auth;

Route::prefix('auth')->group(function () {
    Route::get('/login', Auth\Login::class)->name('login');
    Route::get('/register', Auth\Register::class)->name('register');
});
