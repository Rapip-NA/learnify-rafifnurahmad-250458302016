<?php

use App\Livewire\Auth;
use Qualifier\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Livewire\Features\Admin\Dashboard as AdminDashboard;
use App\Livewire\Features\Peserta\Dashboard as PesertaDashboard;
use App\Livewire\Features\Qualifier\Dashboard as QualifierDashboard;
use App\Livewire\Features\Peserta;


Route::get('/', function () {
    return view('welcome');
});

Route::fallback(function () {
    return view('404');
});

Route::middleware(['role:peserta'])->group(function () {
    Route::get('/peserta/dashboard', PesertaDashboard::class)->name('peserta.dashboard');
});

Route::middleware(['role:qualifier'])->group(function () {
    Route::get('/qualifier/dashboard', QualifierDashboard::class)->name('qualifier.dashboard');
});


Route::middleware(['auth'])->group(function () {
    // Routes untuk peserta
    Route::get('/competitions', Peserta\Competitions\CompetitionList::class)->name('competition.list');
    Route::get('/competition/{competitionId}/quiz', Peserta\Competitions\CompetitionQuiz::class)->name('competition.quiz');
    Route::get('/competition/{competitionId}/result', Peserta\Competitions\CompetitionResult::class)->name('competition.result');
});


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

