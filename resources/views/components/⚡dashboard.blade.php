<?php

namespace App\Http\Livewire;

use Livewire\Component;
// use App\Models\Book; // Uncomment this once you have a Book model

class Dashboard extends Component
{
    public $search = '';
    public $viewMode = 'grid'; // Toggle between grid and list

    public function render()
    {
        // Static data for now so you can see it working immediately
        $books = [
            ['title' => 'The Great Gatsby', 'author' => 'F. Scott Fitzgerald', 'status' => 'Available'],
            ['title' => '1984', 'author' => 'George Orwell', 'status' => 'Borrowed'],
            ['title' => 'Atomic Habits', 'author' => 'James Clear', 'status' => 'Available'],
        ];

        // Filter logic
        $filteredBooks = array_filter($books, function($book) {
            return str_contains(strtolower($book['title']), strtolower($this->search));
        });

        return view('livewire.dashboard', [
            'books' => $filteredBooks
        ]);
    }
}


?>


<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">📚 Library Catalog</h2>
        <div class="flex space-x-2">
            <button wire:click="$set('viewMode', 'grid')" class="p-2 bg-gray-200 rounded">Grid</button>
            <button wire:click="$set('viewMode', 'list')" class="p-2 bg-gray-200 rounded">List</button>
        </div>
    </div>

    <input wire:model.debounce.200ms="search" type="text" placeholder="Search books by title..." 
           class="w-full p-3 mb-6 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 outline-none">

    <div class="{{ $viewMode === 'grid' ? 'grid grid-cols-1 md:grid-cols-3 gap-4' : 'space-y-2' }}">
        @foreach($books as $book)
            <div class="bg-white p-4 rounded-lg shadow border hover:border-blue-500 transition">
                <h3 class="font-bold text-lg text-blue-600">{{ $book['title'] }}</h3>
                <p class="text-gray-600 text-sm">Author: {{ $book['author'] }}</p>
                <span class="mt-2 inline-block text-xs px-2 py-1 rounded {{ $book['status'] === 'Available' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ $book['status'] }}
                </span>
            </div>
        @endforeach
    </div>
</div>

