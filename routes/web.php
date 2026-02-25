<?php

use App\Livewire\Dashboard;
use App\Livewire\AdminDashboard;
use App\Livewire\BooksIndex;
use App\Livewire\LoansIndex;
use App\Livewire\ReturnIndex;
use App\Livewire\CollectionsIndex;
use App\Livewire\SubjectsIndex;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;

// Ubah Bahasa 
Route::get('/lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    $role = auth()->user()->role ?? 'user';
    if ($role == 'admin') {
        return app(AdminDashboard::class)();
    } else {
        return app(Dashboard::class)();
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. Profile Management (Standard Controller)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/books', \App\Livewire\Books\Index::class)->name('books');
    Route::get('/loans', \App\Livewire\Loans\Index::class)->name('loans');
    Route::get('/return', \App\Livewire\Returns\Index::class)->name('return');
    Route::get('/collections', CollectionsIndex::class)->name('collections');
    Route::get('/subjects', SubjectsIndex::class)->name('subjects');
});

require __DIR__.'/auth.php';