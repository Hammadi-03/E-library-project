<x-slot name="header">
    <h2 class="font-semibold text-xl text-white leading-tight">
        {{ __('Manage Peminjaman | Loan Management') }}
    </h2>
</x-slot>

<div class="p-6">
    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    <!-- 1. Header & Tombol Tambah -->
    <div class="flex justify-between items-center mb-4">
        <button wire:click="openModal" class="bg-red-800 text-white px-4 py-2  hover:bg-red-900">
            + {{ __('app.record_loan') }}
        </button>
    </div>

    <!-- 2. Search -->
    <div class="mb-4">
        <input wire:model.live.debounce.300ms="search" type="text" 
            placeholder=" {{ __('app.search') }}" class="border p-2 rounded w-full">
    </div>


    <!-- 3. Tabel Data -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="p-3">No</th>
                    <th class="p-3">{{ __('app.peminjam') }}</th>
                    <th class="p-3">{{ __ ('app.book_title') }}</th>
                    <th class="p-3">{{ __('app.borrow_date') }}</th>
                    <th class="p-3">{{ __('app.due_date') }}</th>
                    <th class="p-3">{{ __('app.status') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loans as $loan)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ ($loans->currentPage()-1) * $loans->perPage() + $loop->iteration }}</td>
                        <td class="p-3">
                            <div class="font-bold">{{ $loan->user->name }}</div>
                            <div class="text-xs text-gray-500">{{ $loan->user->email }}</div>
                        </td>
                        <td class="p-3">
                            <div class="font-semibold">{{ $loan->book->title }}</div>
                            <div class="text-xs text-gray-400">ISBN: {{ $loan->book->isbn }}</div>
                        </td>
                        <td class="p-3 text-sm">{{ $loan->borrow_date->format('d M Y') }}</td>
                        <td class="p-3 text-sm">{{ $loan->due_date->format('d M Y') }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 rounded text-xs font-bold uppercase
                                @if($loan->status == 'borrowed') bg-blue-100 text-blue-800
                                @elseif($loan->status == 'returned') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ $loan->status }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="p-4 text-center text-gray-500">{{ __('app.no_data') }}</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">{{ $loans->links() }}</div>
    </div>

    <!-- 4. Modal Form (Add Loan) -->
    @if($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-8 w-full max-w-lg shadow-lg">
                <h3 class="text-xl font-bold mb-6 text-gray-800">{{ __('app.record_loan') }}</h3>

                <form wire:submit.prevent="save">
                    <div class="space-y-5">

                        {{-- Peminjam --}}
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1 uppercase tracking-wide">
                                {{ __('app.peminjam') }} (User)
                            </label>
                            <select wire:model="user_id"
                                class="w-full border border-gray-400 bg-white px-3 py-2 text-sm text-gray-700
                                       focus:outline-none focus:border-red-900
                                       hover:border-red-900 transition-colors duration-150">
                                <option value="">-- {{ __('app.peminjam') }} --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                            @error('user_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        {{-- Judul Buku --}}
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1 uppercase tracking-wide">
                                {{ __('app.book_title') }}
                            </label>
                            <select wire:model="book_id"
                                class="w-full border border-gray-400 bg-white px-3 py-2 text-sm text-gray-700
                                       focus:outline-none focus:border-red-900
                                       hover:border-red-900 transition-colors duration-150">
                                <option value="">-- {{ __('app.book_title') }} --</option>
                                @foreach($books as $book)
                                    <option value="{{ $book->id }}">{{ $book->title }} ({{ $book->isbn }})</option>
                                @endforeach
                            </select>
                            @error('book_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        {{-- Tanggal --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1 uppercase tracking-wide">
                                    {{ __('app.borrow_date') }}
                                </label>
                                <input type="date" wire:model="borrow_date"
                                    class="w-full border border-gray-400 px-3 py-2 text-sm text-gray-700
                                           focus:outline-none focus:border-red-900
                                           hover:border-red-900 transition-colors duration-150">
                                @error('borrow_date') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1 uppercase tracking-wide">
                                    {{ __('app.due_date') }}
                                </label>
                                <input type="date" wire:model="due_date"
                                    class="w-full border border-gray-400 px-3 py-2 text-sm text-gray-700
                                           focus:outline-none focus:border-red-900
                                           hover:border-red-900 transition-colors duration-150">
                                @error('due_date') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                    </div>

                    {{-- Buttons --}}
                    <div class="flex justify-end gap-3 mt-8">
                        <button type="button" wire:click="$set('showModal', false)"
                            class="px-5 py-2 text-sm border border-gray-400 text-gray-600
                                   hover:border-red-900 hover:text-red-900 transition-colors duration-150">
                            {{ __('Cancel') }}
                        </button>
                        <button type="submit"
                            class="px-5 py-2 text-sm bg-red-800 text-white font-semibold uppercase tracking-wider
                                   hover:bg-red-900 transition-colors duration-150">
                            {{ __('app.record_loan') }}
                        </button>
                    </div>

                </form>
            </div>
        </div>
    @endif
</div>
