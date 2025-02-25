<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('login'); // Redirect ke login jika belum login
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');
    Route::get('/agenda/create', [AgendaController::class, 'create'])->name('agenda.create');
    Route::post('/agenda', [AgendaController::class, 'store'])->name('agenda.store');
    Route::get('/agenda/{id}/edit', [AgendaController::class, 'edit'])->name('agenda.edit');
    Route::put('/agenda/{id}', [AgendaController::class, 'update'])->name('agenda.update');

    Route::middleware(['admin'])->group(function () {
        Route::delete('/agenda/{id}', [AgendaController::class, 'destroy'])->name('agenda.destroy');
        Route::post('/agenda/{id}/restore', [AgendaController::class, 'restore'])->name('agenda.restore');
        Route::delete('/agenda/{id}/forcedelete', [AgendaController::class, 'forcedelete'])->name('agenda.forcedelete');
        Route::get('agenda/history', [AgendaController::class, 'history'])->name('agenda.history');
        Route::get('/agenda/{id}/edit', [AgendaController::class, 'edit'])->name('agenda.edit');
        Route::put('/agenda/{id}', [AgendaController::class, 'update'])->name('agenda.update');
    });
    Route::get('/about', [HomeController::class, 'about'])->name('about');
});

Route::get('/error-permission', function() {
    return view('errors.permission');
})->name('error.permission');