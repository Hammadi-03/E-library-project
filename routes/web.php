<?php

use App\Livewire\Dashboard;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;

// Language Switcher
Route::get('/lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');

// 1. The Landing Page
Route::get('/', function () {
    return view('welcome');
});

// 2. The Interactive Dashboard (Protected by Auth)
// We use 'Dashboard::class' to tell Laravel to load your Livewire component
Route::get('/dashboard', Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// 3. Profile Management (Standard Controller)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';