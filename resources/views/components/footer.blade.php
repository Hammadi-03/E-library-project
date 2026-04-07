<footer class="bg-[#0f172a] text-gray-300 border-t border-gray-800 mt-12 w-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="col-span-1 md:col-span-2">
                 <div class="flex items-center gap-2 mb-4 text-white">
                    <img src="{{ asset('svgviewer-png-output.png') }}" class="h-14 w-auto" alt="Qatar National Library">
                </div>
                <p class="text-sm text-gray-400 max-w-sm">
                    {{ __('app.footer_desc') ?? 'Koneksi perpustakaan digital. Pinjam ebook, audiobook, dan lainnya dari perpustakaan lokal Anda secara gratis!' }}
                </p>
            </div>
            <div>
                <h3 class="text-white font-bold mb-4 text-xs uppercase tracking-wider">{{ __('AKUN SAYA') }}</h3>
                <ul class="space-y-3 text-[13px]">
                    <li><a href="#" class="hover:text-white transition">{{ __('Masuk') }}</a></li>
                    <li><a href="#" class="hover:text-white transition">{{ __('Butuh kartu perpustakaan?') }}</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-white font-bold mb-4 text-xs uppercase tracking-wider">{{ __('DUKUNGAN') }}</h3>
                <ul class="space-y-3 text-[13px]">
                    <li><a href="#" class="hover:text-white transition">{{ __('Bantuan') }}</a></li>
                    <li><a href="#" class="hover:text-white transition">{{ __('Dapatkan Dukungan') }}</a></li>
                </ul>
            </div>
        </div>
        <div class="mt-8 pt-8 border-t border-[#1e293b] text-center text-xs text-gray-400">
            &copy; {{ date('Y') }} Qatar National Library. {{ __('Semua hak dilindungi.') }}
        </div>
    </div>
</footer>
