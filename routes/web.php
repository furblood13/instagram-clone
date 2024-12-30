<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SurveyController;
use Illuminate\Support\Facades\Route;

// Ana sayfa direkt login'e yönlendirecek
Route::redirect('/', '/login');

// Authentication Routes
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Survey Routes - Auth gerektiren rotalar
Route::middleware(['auth'])->group(function () {
    // Ana dashboard surveys sayfasına yönlendirecek
    Route::redirect('/dashboard', '/surveys')->name('dashboard');
    
    Route::get('/surveys', [SurveyController::class, 'index'])->name('surveys.index');
    Route::get('/surveys/create', [SurveyController::class, 'create'])->name('surveys.create');
    Route::post('/surveys', [SurveyController::class, 'store'])->name('surveys.store');
    Route::get('/surveys/{survey}', [SurveyController::class, 'show'])->name('surveys.show');
    Route::post('/surveys/{survey}/response', [SurveyController::class, 'submitResponse'])->name('surveys.response');
});
