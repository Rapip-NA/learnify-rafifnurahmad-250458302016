<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Features\Peserta;

Route::prefix('peserta')
    ->name('peserta.')
    ->group(function () {

        Route::get('/dashboard', Peserta\Dashboard::class)->name('dashboard');

        Route::prefix('competitions')->name('competitions.')->group(function () {
            Route::get('/', Peserta\Competitions\CompetitionList::class)->name('list');
            Route::get('/{competitionId}/quiz', Peserta\Competitions\CompetitionQuiz::class)->name('quiz');
            Route::get('/{competitionId}/result', Peserta\Competitions\CompetitionResult::class)->name('result');
        });
    });