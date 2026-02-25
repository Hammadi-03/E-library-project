<div class="p-6">
    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    <!-- 1. Header -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-gray-800">🔄 Pengembalian Buku</h2>
        <div class="text-sm text-gray-500">
            Daftar buku yang sedang dipinjam
        </div>
    </div>

    <!-- 2. Search -->
    <div class="mb-4">
        <input wire:model.live.debounce.300ms="search" type="text" 
            placeholder="🔍 Cari nama peminjam, judul buku, atau ISBN..." class="border p-2 rounded w-full">
    </div>

    <!-- 3. Tabel Data -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="p-3">No</th>
                    <th class="p-3">Peminjam</th>
                    <th class="p-3">Buku</th>
                    <th class="p-3">Tanggal Pinjam</th>
                    <th class="p-3">Batas Kembali</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($borrowedBooks as $loan)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ ($borrowedBooks->currentPage()-1) * $borrowedBooks->perPage() + $loop->iteration }}</td>
                        <td class="p-3">
                            <div class="font-bold text-gray-800">{{ $loan->user->name }}</div>
                            <div class="text-xs text-gray-500">{{ $loan->user->email }}</div>
                        </td>
                        <td class="p-3">
                            <div class="font-semibold">{{ $loan->book->title }}</div>
                            <div class="text-xs text-gray-400">ISBN: {{ $loan->book->isbn }}</div>
                        </td>
                        <td class="p-3 text-sm text-gray-600">{{ $loan->borrow_date->format('d M Y') }}</td>
                        <td class="p-3 text-sm">
                            <span class="{{ $loan->due_date < now() ? 'text-red-600 font-bold' : 'text-gray-600' }}">
                                {{ $loan->due_date->format('d M Y') }}
                            </span>
                            @if($loan->due_date < now())
                                <div class="text-[10px] text-red-500 font-bold uppercase mt-0.5">Terlambat!</div>
                            @endif
                        </td>
                        <td class="p-3">
                            <button 
                                wire:click="markAsReturned({{ $loan->id }})" 
                                wire:confirm="Yakin ingin memproses pengembalian buku ini?"
                                class="bg-emerald-600 text-white px-3 py-1.5 rounded-md text-sm font-semibold hover:bg-emerald-700 transition flex items-center gap-1">
                                <span>✅</span> Kembali
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="p-4 text-center text-gray-500">Tidak ada buku yang sedang dipinjam.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">{{ $borrowedBooks->links() }}</div>
    </div>
</div>
