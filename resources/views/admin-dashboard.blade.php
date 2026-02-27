@section('title', 'Admin Dashboard | Qatar National Library')

<x-slot name="header">
    <h2 class="font-semibold text-xl text-white leading-tight">
        {{ __('Welcome, Admin! | Admin Dashboard') }}
    </h2>
</x-slot>

<div>
    <!-- Hero Section -->
    <div class="bg-emerald-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="mb-8 md:mb-0 md:w-1/2">
                    <div class="flex items-center gap-2 mb-4 text-emerald-200 uppercase tracking-wide text-sm font-bold">
                        <span><i class="fa-solid fa-shield-halved"></i></span> <span>Admin Control Panel</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-4">
                        {{ __('app.welcome_back') }} {{ Auth::user()->name }}!
                    </h1>
                    <p class="text-emerald-100 text-lg mb-8 max-w-lg">
                        Manage books, loans, returns, and all library operations from here.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('books') }}" class="inline-block px-6 py-3 bg-white text-emerald-900 font-bold rounded-full hover:bg-emerald-50 transition">
                            <i class="fa-solid fa-book-open mr-1"></i> Manage Books
                        </a>
                        <a href="{{ route('loans') }}" class="inline-block px-6 py-3 border-2 border-white text-white font-bold rounded-full hover:bg-white/10 transition">
                            <i class="fa-solid fa-clipboard-list mr-1"></i> Manage Loans
                        </a>
                        <a href="{{ route('return') }}" class="inline-block px-6 py-3 border-2 border-white text-white font-bold rounded-full hover:bg-white/10 transition">
                            <i class="fa-solid fa-rotate-left mr-1"></i> Returns
                        </a>
                    </div>
                </div>
                <!-- Hero decorative right -->
                <div class="md:w-1/2 flex justify-center">
                    <div class="grid grid-cols-3 gap-4 transform rotate-3">
                        <div class="bg-white/10 p-2 rounded shadow-lg w-32 h-48"></div>
                        <div class="bg-white/20 p-2 rounded shadow-lg w-32 h-48 -mt-8"></div>
                        <div class="bg-white/10 p-2 rounded shadow-lg w-32 h-48"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===================== STATUS CARDS ===================== -->
    <div class="bg-gray-50 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                <span><i class="fa-solid fa-chart-bar text-blue-500"></i></span> Status Overview
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-5">

                <!-- Total Books -->
                <div class="bg-white shadow p-5 flex flex-col items-center text-center border-t-4 border-blue-500 hover:shadow-lg transition">
                    <div class="text-4xl mb-2 text-blue-500"><i class="fa-solid fa-book"></i></div>
                    <div class="text-3xl font-extrabold text-blue-600">{{ $stats['total_books'] }}</div>
                    <div class="text-sm font-semibold text-gray-500 mt-1">Total Buku</div>
                </div>

                <!-- Total User -->
                <div class="bg-white  shadow p-5 flex flex-col items-center text-center border-t-4 border-purple-500 hover:shadow-lg transition">
                    <div class="text-4xl mb-2 text-purple-500"><i class="fa-solid fa-users"></i></div>
                    <div class="text-3xl font-extrabold text-purple-600">{{ $stats['total_users'] }}</div>
                    <div class="text-sm font-semibold text-gray-500 mt-1">Total Pengguna</div>
                </div>

                <!-- Active-->
                <div class="bg-white shadow p-5 flex flex-col items-center text-center border-t-4 border-emerald-500 hover:shadow-lg transition">
                    <div class="text-4xl mb-2 text-emerald-500"><i class="fa-solid fa-book-reader"></i></div>
                    <div class="text-3xl font-extrabold text-emerald-600">{{ $stats['active_loans'] }}</div>
                    <div class="text-sm font-semibold text-gray-500 mt-1">Sedang Dipinjam</div>
                </div>

                <!-- Overdue -->
                <div class="bg-white  shadow p-5 flex flex-col items-center text-center border-t-4 border-red-500 hover:shadow-lg transition">
                    <div class="text-4xl mb-2 text-red-500"><i class="fa-solid fa-triangle-exclamation"></i></div>
                    <div class="text-3xl font-extrabold text-red-600">{{ $stats['overdue_loans'] }}</div>
                    <div class="text-sm font-semibold text-gray-500 mt-1">Terlambat / Overdue</div>
                </div>

                <!-- Returned -->
                <div class="bg-white shadow p-5 flex flex-col items-center text-center border-t-4 border-teal-500 hover:shadow-lg transition">
                    <div class="text-4xl mb-2 text-teal-500"><i class="fa-solid fa-circle-check"></i></div>
                    <div class="text-3xl font-extrabold text-teal-600">{{ $stats['returned_loans'] }}</div>
                    <div class="text-sm font-semibold text-gray-500 mt-1">Sudah Dikembalikan</div>
                </div>

                <!-- Total Loans (Semua Peminjaman) -->
                <div class="bg-white shadow p-5 flex flex-col items-center text-center border-t-4 border-orange-500 hover:shadow-lg transition">
                    <div class="text-4xl mb-2 text-orange-500"><i class="fa-solid fa-layer-group"></i></div>
                    <div class="text-3xl font-extrabold text-orange-600">{{ $stats['total_loans'] }}</div>
                    <div class="text-sm font-semibold text-gray-500 mt-1">Total Peminjaman</div>
                </div>

            </div>
        </div>
    </div>

    <!-- ===================== RECENT LOANS TABLE ===================== -->
    <div class="bg-white py-10 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                    <span><i class="fa-solid fa-clock text-emerald-600"></i></span> Peminjaman Terbaru
                </h2>
                <a href="{{ route('loans') }}" class="text-sm font-semibold text-emerald-700 hover:text-emerald-900">
                    {{ __('app.view_all') }} →
                </a>
            </div>

            <div class="overflow-x-auto rounded-xl shadow">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-emerald-900 text-white">
                        <tr>
                            <th class="px-5 py-3 text-left font-semibold">#</th>
                            <th class="px-5 py-3 text-left font-semibold">Peminjam</th>
                            <th class="px-5 py-3 text-left font-semibold">Judul Buku</th>
                            <th class="px-5 py-3 text-left font-semibold">Tgl Pinjam</th>
                            <th class="px-5 py-3 text-left font-semibold">Batas Kembali</th>
                            <th class="px-5 py-3 text-left font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($recentLoans as $index => $loan)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-5 py-3 text-gray-500">{{ $index + 1 }}</td>
                            <td class="px-5 py-3 font-medium text-gray-800">
                                {{ $loan->user?->name ?? '-' }}
                            </td>
                            <td class="px-5 py-3 text-gray-700">
                                {{ $loan->book?->title ?? '-' }}
                            </td>
                            <td class="px-5 py-3 text-gray-600">
                                {{ $loan->borrow_date?->format('d M Y') ?? '-' }}
                            </td>
                            <td class="px-5 py-3 text-gray-600">
                                {{ $loan->due_date?->format('d M Y') ?? '-' }}
                            </td>
                            <td class="px-5 py-3">
                                @php
                                    $statusColor = match($loan->status) {
                                        'borrowed'  => 'bg-emerald-100 text-emerald-700',
                                        'overdue'   => 'bg-red-100 text-red-700',
                                        'returned'  => 'bg-teal-100 text-teal-700',
                                        default     => 'bg-gray-100 text-gray-600',
                                    };
                                    $statusLabel = match($loan->status) {
                                        'borrowed'  => '<i class="fa-solid fa-book-reader mr-1"></i> Dipinjam',
                                        'overdue'   => '<i class="fa-solid fa-triangle-exclamation mr-1"></i> Terlambat',
                                        'returned'  => '<i class="fa-solid fa-circle-check mr-1"></i> Dikembalikan',
                                        default     => $loan->status,
                                    };
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $statusColor }}">
                                    {!! $statusLabel !!}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-5 py-8 text-center text-gray-400 italic">
                                Belum ada data peminjaman.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ===================== QUICK LINKS ===================== -->
    <div class="bg-gray-50 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                <span><i class="fa-solid fa-bolt text-yellow-500"></i></span> Quick Links
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="{{ route('books') }}" class="bg-white rounded-xl shadow p-5 flex flex-col items-center gap-2 hover:shadow-md hover:border-blue-400 border-2 border-transparent transition text-center">
                    <span class="text-3xl text-blue-500"><i class="fa-solid fa-book"></i></span>
                    <span class="font-semibold text-gray-700">Kelola Buku</span>
                </a>
                <a href="{{ route('loans') }}" class="bg-white rounded-xl shadow p-5 flex flex-col items-center gap-2 hover:shadow-md hover:border-emerald-400 border-2 border-transparent transition text-center">
                    <span class="text-3xl text-emerald-500"><i class="fa-solid fa-clipboard-list"></i></span>
                    <span class="font-semibold text-gray-700">Kelola Peminjaman</span>
                </a>
                <a href="{{ route('return') }}" class="bg-white rounded-xl shadow p-5 flex flex-col items-center gap-2 hover:shadow-md hover:border-teal-400 border-2 border-transparent transition text-center">
                    <span class="text-3xl text-teal-500"><i class="fa-solid fa-rotate-left"></i></span>
                    <span class="font-semibold text-gray-700">Pengembalian</span>
                </a>
                <a href="{{ route('profile.edit') }}" class="bg-white rounded-xl shadow p-5 flex flex-col items-center gap-2 hover:shadow-md hover:border-purple-400 border-2 border-transparent transition text-center">
                    <span class="text-3xl text-purple-500"><i class="fa-solid fa-gear"></i></span>
                    <span class="font-semibold text-gray-700">Profil Admin</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 border-t border-gray-800 mt-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-2 mb-4 text-white">
                        <img src="{{ asset('svgviewer-png-output.png') }}" class="h-14 w-auto" alt="Qatar National Library">
                    </div>
                    <p class="text-sm text-gray-400 max-w-sm">
                        {{ __('app.footer_desc') }}
                    </p>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">{{ __('app.my_account') }}</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white">{{ __('app.sign_in') }}</a></li>
                        <li><a href="#" class="hover:text-white">{{ __('app.need_card') }}</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">{{ __('app.support') }}</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white">{{ __('app.help') }}</a></li>
                        <li><a href="#" class="hover:text-white">{{ __('app.get_support') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-800 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} Qatar National Library. {{ __('app.all_rights') }}
            </div>
        </div>
    </footer>
</div>
