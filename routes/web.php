<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\GlobalLeaderboard;

Route::get('/', function () {
    return view('welcome');
});

Route::fallback(function () {
    return view('404');
});

Route::get('/leaderboard', GlobalLeaderboard::class)->name('global.leaderboard');

//Auth
require __DIR__ . '/Auth.php';

Route::middleware('auth')->group(function () {

    //Admin
    require __DIR__ . '/Admin.php';

    //Peserta
    require __DIR__ . '/Peserta.php';

    //Qualifier
    require __DIR__ . '/Qualifier.php';
});

