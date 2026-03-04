<div class="p-6">
    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    <!-- 1. Header & Tombol Tambah -->
     <x-slot name="header">
    <h2 class="font-semibold text-xl text-white leading-tight ">
        {{ __('Kelola Buku | Manage Books') }}
    </h2>
</x-slot>
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-gray-800">{{ __('app.manage_books') }}</h2>
        <button wire:click="openModal" class="bg-red-900 text-white px-4 py-2  hover:bg-red-950">
            + {{ __('app.add_new_book') }}
        </button>
    </div>


    <!-- 2. Search & Filter -->
    <div class="flex gap-4 mb-4">
        <input wire:model.live.debounce.300ms="search" type="text" 
            placeholder=" {{ __('app.search') }}" class="border p-2 rounded w-full">
        
        <select wire:model.live="Category" class="border p-2 rounded">
            <option value="">{{ __('app.category') }}</option>
            @foreach($categoriesList as $cat)
                <option value="{{ $cat }}">{{ $cat }}</option>
            @endforeach
        </select>
    </div>


    <!-- 3. Tabel Data -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="p-3">No</th>
                    <th class="p-3">{{ __('app.book_title') }}</th>
                    <th class="p-3">{{ __('app.author') }}</th>
                    <th class="p-3">{{ __('app.category') }}</th>
                    <th class="p-3">{{ __('app.actions') }}</th>
                </tr>
            </thead>

            <tbody>
                @forelse($books as $book)
                    <tr class="border-b hover:bg-white">
                        <td class="p-3">{{ ($books->currentPage()-1) * $books->perPage() + $loop->iteration }}</td>
                        <td class="p-3">
                            <div class="font-bold">{{ $book->title }}</div>
                            <div class="text-xs text-gray-500">ISBN: {{ $book->isbn }}</div>
                        </td>
                        <td class="p-3">{{ $book->author }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">
                                {{ $book->Category ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="p-3">
                            <button wire:click="editBook({{ $book->id }})" class="text-blue-600 hover:underline mr-2">{{ __('Edit') }}</button>
                            <button wire:click="confirmDelete({{ $book->id }})" class="text-red-600 hover:underline">{{ __('Delete') }}</button>
                        </td>

                    </tr>
                @empty
                    <tr><td colspan="5" class="p-4 text-center text-gray-500">{{ __('app.no_data') }}</td></tr>
                @endforelse

            </tbody>
        </table>
        <div class="p-4">{{ $books->links() }}</div>
    </div>

    <!-- 4. Modal Form (Create/Edit) -->
    @if($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-8 w-full max-w-lg shadow-lg rounded-t-lg max-h-[90vh] overflow-y-auto">
                <h3 class="text-xl font-bold mb-6 text-gray-800">{{ $isEdit ? __('app.edit_book') : __('app.add_new_book') }}</h3>

                <form wire:submit.prevent="save">
                    <div class="space-y-5">

                        {{-- Judul Buku --}}
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1 uppercase tracking-wide">
                                {{ __('app.book_title') }}
                            </label>
                            <input type="text" wire:model="title"
                                class="w-full border border-gray-400 px-3 py-2 text-sm text-gray-700
                                       focus:outline-none focus:border-red-900
                                       hover:border-red-900 transition-colors duration-150">
                            @error('title') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        {{-- Author / Penulis --}}
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1 uppercase tracking-wide">
                                {{ __('app.author') }}
                            </label>
                            <input type="text" wire:model="author"
                                class="w-full border border-gray-400 px-3 py-2 text-sm text-gray-700
                                       focus:outline-none focus:border-red-900
                                       hover:border-red-900 transition-colors duration-150">
                            @error('author') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        {{-- ISBN & Kategori --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1 uppercase tracking-wide">
                                    {{ __('app.isbn') }}
                                </label>
                                <input type="text" wire:model="isbn"
                                    class="w-full border border-gray-400 px-3 py-2 text-sm text-gray-700
                                           focus:outline-none focus:border-red-900
                                           hover:border-red-900 transition-colors duration-150">
                                @error('isbn') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1 uppercase tracking-wide">
                                    {{ __('app.category') }}
                                </label>
                                <input type="text" wire:model="Category" placeholder="Contoh: Fiksi"
                                    class="w-full border border-gray-400 px-3 py-2 text-sm text-gray-700
                                           focus:outline-none focus:border-red-900
                                           hover:border-red-900 transition-colors duration-150">
                                @error('Category') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                    </div>

                    {{-- Buttons --}}
                    <div class="flex justify-end gap-3 mt-8">
                        <button type="button" wire:click="closeModal"
                            class="px-5 py-2 text-sm border border-gray-400 text-gray-600
                                   hover:border-red-900 hover:text-red-900 transition-colors duration-150">
                            {{ __('Cancel') }}
                        </button>
                        <button type="submit"
                            class="px-5 py-2 text-sm bg-red-800 text-white font-semibold uppercase tracking-wider
                                   hover:bg-red-900 transition-colors duration-150">
                            {{ $isEdit ? __('app.save_changes') : __('app.save_changes') }}
                        </button>
                    </div>

                </form>
            </div>
        </div>
    @endif

    <!-- 5. Delete Confirmation Modal -->
    @if($showDeleteModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-8 w-full max-w-sm shadow-lg rounded-t-lg">
                <h3 class="text-xl font-bold mb-3 text-gray-800">{{ __('Konfirmasi Hapus') }}</h3>
                <p class="mb-6 text-sm text-gray-600">{{ __('Are you sure you want to delete this book?') }}</p>
                <div class="flex justify-end gap-3">
                    <button type="button" wire:click="$set('showDeleteModal', false)"
                        class="px-5 py-2 text-sm border border-gray-400 text-gray-600
                               hover:border-red-900 hover:text-red-900 transition-colors duration-150">
                        {{ __('Cancel') }}
                    </button>
                    <button type="button" wire:click="deleteBook"
                        class="px-5 py-2 text-sm bg-red-800 text-white font-semibold uppercase tracking-wider
                               hover:bg-red-900 transition-colors duration-150">
                        {{ __('Delete') }}
                    </button>
                </div>
            </div>
        </div>
    @endif

</div>
