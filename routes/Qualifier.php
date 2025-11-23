<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Features\Qualifier;

Route::prefix('qualifier')
    ->name('qualifier.')
    ->group(function () {

        Route::get('/dashboard', Qualifier\Dashboard::class)->name('dashboard');

    });