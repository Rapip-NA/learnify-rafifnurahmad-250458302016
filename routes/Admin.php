<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Features\Admin;

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        //Menu Utama
        Route::get('/dashboard', Admin\Dashboard::class)->name('dashboard');
        Route::get('/analytics', Admin\Analytics::class)->name('analytics');

        //Qualifier Routes
        Route::prefix('qualifier')->name('qualifier.')->group(function () {
            Route::get('/', Admin\ListQualifier\QualifierList::class)->name('index');
            Route::get('/{id}', Admin\ListQualifier\QualifierShow::class)->name('show');
        });

        // Peserta Routes
        Route::prefix('peserta')->name('peserta.')->group(function () {
            Route::get('/', Admin\ListPeserta\PesertaList::class)->name('index');
            Route::get('/{id}', Admin\ListPeserta\PesertaShow::class)->name('show');
        });

        // Competition Routes
        Route::prefix('competitions')->name('competitions.')->group(function () {
            Route::get('/', Admin\Competitions\CompetitionIndex::class)->name('index');
            Route::get('/create', Admin\Competitions\CompetitionCreate::class)->name('create');
            Route::get('/{competition}', Admin\Competitions\CompetitionView::class)->name('view');
            Route::get('/{competition}/edit', Admin\Competitions\CompetitionEdit::class)->name('edit');
        });

        // Category Routes
        Route::prefix('categories')->name('categories.')->group(function () {
            Route::get('/', Admin\Category\CategoryIndex::class)->name('index');
            Route::get('/create', Admin\Category\CategoryCreate::class)->name('create');
            Route::get('/{category}', Admin\Category\CategoryView::class)->name('view');
            Route::get('/{category}/edit', Admin\Category\CategoryEdit::class)->name('edit');
        });

        // Question Routes
        Route::prefix('questions')->name('questions.')->group(function () {
            Route::get('/', Admin\Question\QuestionIndex::class)->name('index');
            Route::get('/create', Admin\Question\QuestionCreate::class)->name('create');
            Route::get('/{id}', Admin\Question\QuestionView::class)->name('view');
            Route::get('/{id}/edit', Admin\Question\QuestionEdit::class)->name('edit');
        });

        // Badge Routes
        Route::prefix('badges')->name('badges.')->group(function () {
            Route::get('/', Admin\Badge\BadgeIndex::class)->name('index');
            Route::get('/create', Admin\Badge\BadgeCreate::class)->name('create');
            Route::get('/{badge}', Admin\Badge\BadgeView::class)->name('view');
            Route::get('/{badge}/edit', Admin\Badge\BadgeEdit::class)->name('edit');
        });
    });



