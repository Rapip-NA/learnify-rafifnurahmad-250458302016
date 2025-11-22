<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Features\Admin;

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        //Menu Utama
        Route::get('/dashboard', Admin\Dashboard::class)->name('dashboard');

        Route::prefix('qualifier')->name('qualifier.')->group(function () {
            Route::get('/', Admin\ListQualifier\QualifierList::class)->name('index');
            Route::get('/create', Admin\ListQualifier\QualifierCreate::class)->name('create');
            Route::get('/{id}', Admin\ListQualifier\QualifierShow::class)->name('show');
            Route::get('/{id}/edit', Admin\ListQualifier\QualifierEdit::class)->name('edit');
        });

        // Peserta Routes
        Route::prefix('peserta')->name('peserta.')->group(function () {
            Route::get('/', Admin\ListPeserta\PesertaList::class)->name('index');
            Route::get('/create', Admin\ListPeserta\PesertaCreate::class)->name('create');
            Route::get('/{id}', Admin\ListPeserta\PesertaShow::class)->name('show');
            Route::get('/{id}/edit', Admin\ListPeserta\PesertaEdit::class)->name('edit');
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
            Route::get('/', Admin\category\CategoryIndex::class)->name('index');
            Route::get('/create', Admin\category\CategoryCreate::class)->name('create');
            Route::get('/{category}', Admin\category\CategoryView::class)->name('view');
            Route::get('/{category}/edit', Admin\category\CategoryEdit::class)->name('edit');
        });

        // Question Routes
        Route::prefix('questions')->name('questions.')->group(function () {
            Route::get('/', Admin\Question\QuestionIndex::class)->name('index');
            Route::get('/create', Admin\Question\QuestionCreate::class)->name('create');
            Route::get('/{id}', Admin\Question\QuestionView::class)->name('view');
            Route::get('/{id}/edit', Admin\Question\QuestionEdit::class)->name('edit');
        });

    });



