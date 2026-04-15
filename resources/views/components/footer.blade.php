<footer class="bg-[#0f172a] text-gray-300 border-t border-gray-800 w-full" x-data="{ showCookies: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
            <div class="col-span-1 md:col-span-2">
                 <div class="flex items-center gap-2 mb-4 text-white">
                    <img src="{{ asset('svgviewer-png-output.png') }}" class="h-14 w-auto" alt="Qatar National Library">
                </div>
                <p class="text-sm text-gray-400 max-w-sm font-medium leading-relaxed">
                    {{ __('app.footer_desc') ?? 'Koneksi perpustakaan digital. Pinjam ebook, audiobook, dan lainnya dari perpustakaan lokal Anda secara gratis!' }}
                </p>
            </div>
            <div>
                <h3 class="text-white font-bold mb-6 text-xs uppercase tracking-widest">{{ __('AKUN SAYA') }}</h3>
                <ul class="space-y-4 text-[13px] font-medium text-gray-400">
                    <li><a href="#" class="hover:text-white transition-colors">{{ __('Masuk') }}</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">{{ __('Butuh kartu perpustakaan?') }}</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-white font-bold mb-6 text-xs uppercase tracking-widest">{{ __('DUKUNGAN') }}</h3>
                <ul class="space-y-4 text-[13px] font-medium text-gray-400">
                    <li><a href="#" class="hover:text-white transition-colors">{{ __('Bantuan') }}</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">{{ __('Dapatkan Dukungan') }}</a></li>
                </ul>
            </div>
        </div>
        
        <div class="pt-8 border-t border-gray-800 flex flex-col md:flex-row items-center justify-center gap-4 text-[13px] font-medium text-gray-400 flex-wrap">
            <a href="https://www.overdrive.com/policies/privacy-policy" target="_blank" class="hover:text-white transition-colors">Privacy Policy</a>
            <span>·</span>
            <button @click="showCookies = true" class="hover:text-white transition-colors">Cookie Settings</button>
            <span>·</span>
            <a href="https://www.overdrive.com/policies/accessibility" target="_blank" class="hover:text-white transition-colors">Accessibility</a>
            <span>·</span>
            <a href="https://www.overdrive.com/policies/copyright" target="_blank" class="hover:text-white transition-colors">Important Notice about Copyrighted Materials</a>
            <span>·</span>
            <div class="whitespace-nowrap">
                &copy; 2026 IDNBS Library. {{ __('Semua hak dilindungi.') }}
            </div>
        </div>
    </div>

    <!-- Cookie Settings Modal -->
    <template x-teleport="body">
        <div x-show="showCookies" 
             class="fixed inset-0 z-[1000] overflow-y-auto" 
             x-cloak
             @keydown.escape.window="showCookies = false">
            <div class="flex min-h-full items-center justify-center p-4">
                <!-- Backdrop -->
                <div x-show="showCookies" 
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity" 
                     @click="showCookies = false"></div>

                <!-- Modal Content -->
                <div x-show="showCookies"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="relative w-full max-w-2xl transform overflow-hidden rounded-2xl bg-white p-8 text-left shadow-2xl transition-all">
                    
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">Cookie Settings</h2>
                        <button @click="showCookies = false" class="text-gray-400 hover:text-gray-600 p-2 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <!-- Policy Text -->
                    <div class="text-[14px] text-gray-600 mb-8 leading-relaxed">
                        IDNBS Library uses cookies and similar technologies to improve your experience, monitor our performance, and understand overall usage trends for IDNBS Library services (including IDNBS Library websites and apps). We use this information to create a better experience for all users. Please review the types of cookies we use below.
                    </div>

                    <!-- Options -->
                    <div class="space-y-8 overflow-y-auto max-h-[40vh] pr-4 custom-scrollbar">
                        <!-- Required Cookies -->
                        <div class="flex items-start gap-4">
                            <div class="pt-1">
                                <div class="w-5 h-5 rounded flex items-center justify-center bg-gray-200 text-gray-500">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="4"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-900 mb-1">Required cookies</h3>
                                <p class="text-sm text-gray-500 leading-relaxed">These cookies allow you to explore IDNBS Library services and use our core features. Without these cookies, we can't provide services to you.</p>
                            </div>
                        </div>

                        <!-- Performance -->
                        <div class="flex items-start gap-4">
                            <div class="pt-1">
                                <input type="checkbox" checked class="w-5 h-5 rounded border-gray-300 text-black focus:ring-black">
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-900 mb-1">Performance and reliability cookies</h3>
                                <p class="text-sm text-gray-500 leading-relaxed">These cookies allow us to monitor IDNBS Library's performance and reliability. They alert us when IDNBS Library services are not working as expected. Without these cookies, we won't know if you have any performance-related issues that we may be able to address.</p>
                            </div>
                        </div>

                        <!-- Research -->
                        <div class="flex items-start gap-4">
                            <div class="pt-1">
                                <input type="checkbox" checked class="w-5 h-5 rounded border-gray-300 text-black focus:ring-black">
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-900 mb-1">Research and analytics cookies</h3>
                                <p class="text-sm text-gray-500 leading-relaxed">These cookies help us understand user behavior within our services. For example, they let us know which features and sections are most popular. This information helps us design a better experience for all users.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Links -->
                    <div class="mt-8 pt-6 border-t border-gray-100 text-[13px] text-gray-500 italic">
                        To learn more about cookies, please see our complete <a href="#" class="underline hover:text-black">cookie policy</a>. To learn more about how we use and protect your data, please see our <a href="#" class="underline hover:text-black">Privacy Policy</a>.
                    </div>

                    <!-- Confirm Button -->
                    <div class="mt-8 flex justify-end">
                        <button @click="showCookies = false" 
                                class="bg-black text-white px-8 py-2.5 rounded shadow-lg hover:bg-gray-800 transition-all font-bold text-sm">
                            Confirm cookie settings
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #aaa;
        }
    </style>
</footer>
