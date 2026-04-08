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
    $justAddedBooks = \App\Models\Book::where('Category', 'Just Added')->get();
    $mentalHealthBooks = \App\Models\Book::where('Category', 'Mental Health')->get();
    $koreanBooks = \App\Models\Book::where('Category', 'Korean Literature')->get();

    return view('welcome', compact('justAddedBooks', 'mentalHealthBooks', 'koreanBooks'));
});

Route::get('/books/{id}', \App\Livewire\Books\Show::class)->name('books.show');


Route::get('/dashboard', function () {
    return app(AdminDashboard::class)();
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

    // Endpoints for React component to poll notifications in real-time
    Route::get('/api/user/notifications', function () {
        return auth()->user()->unreadNotifications->map(function($n) {
            return [
                'id' => $n->id,
                'title' => $n->data['book_title'] ?? 'Notification',
                'description' => $n->data['message'] ?? '',
                'time' => $n->created_at->diffForHumans(),
            ];
        });
    });

    Route::delete('/api/user/notifications/{id}', function ($id) {
        $notification = auth()->user()->notifications()->find($id);
        if ($notification) {
            $notification->delete();
        }
        return response()->json(['success' => true]);
    });
});

require __DIR__.'/auth.php';