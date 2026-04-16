<footer class="bg-[#0f172a] text-gray-300 border-t border-gray-800 w-full" x-data="{ showCookies: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
            <div class="col-span-1 md:col-span-2">
                 <div class="flex items-center gap-2 mb-4 text-white">
                    <img src="{{ asset('svgviewer-png-output.png') }}" class="h-14 w-auto" alt="Libraries Connected">
                </div>
                <p class="text-sm text-gray-400 max-w-sm font-medium leading-relaxed">
                    {{ __('app.footer_desc') }}
                </p>
            </div>
            <div>
                <h3 class="text-white font-bold mb-6 text-xs uppercase tracking-widest">{{ __('app.my_account') }}</h3>
                <ul class="space-y-4 text-[13px] font-medium text-gray-400">
                    <li><a href="{{ route('login') }}" class="hover:text-white transition-colors">{{ __('app.login') }}</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">{{ __('app.need_card') }}</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-white font-bold mb-6 text-xs uppercase tracking-widest">{{ __('app.support') }}</h3>
                <ul class="space-y-4 text-[13px] font-medium text-gray-400">
                    <li><a href="#" class="hover:text-white transition-colors">{{ __('app.help') }}</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">{{ __('app.get_support') }}</a></li>
                </ul>
            </div>
        </div>
        
        <div class="pt-8 border-t border-gray-800 flex flex-col md:flex-row items-center justify-center gap-4 text-[13px] font-medium text-gray-400 flex-wrap">
            <a href="https://www.overdrive.com/policies/privacy-policy" target="_blank" class="hover:text-white transition-colors">{{ __('app.privacy_policy') }}</a>
            <span>·</span>
            <button @click="showCookies = true" class="hover:text-white transition-colors">{{ __('app.cookie_settings') }}</button>
            <span>·</span>
            <a href="https://www.overdrive.com/policies/accessibility" target="_blank" class="hover:text-white transition-colors">{{ __('app.accessibility') }}</a>
            <span>·</span>
            <a href="https://www.overdrive.com/policies/copyright" target="_blank" class="hover:text-white transition-colors">{{ __('app.copyright_notice') }}</a>
            <span>·</span>
            <div class="whitespace-nowrap">
                &copy; {{ date('Y') }} Libraries Connected. {{ __('app.all_rights') }}
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
                        <h2 class="text-2xl font-bold text-gray-900">{{ __('app.cookie_settings') }}</h2>
                        <button @click="showCookies = false" class="text-gray-400 hover:text-gray-600 p-2 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <!-- Policy Text -->
                    <div class="text-[14px] text-gray-600 mb-8 leading-relaxed">
                        {{ __('app.cookie_modal_desc') }}
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
                                <h3 class="font-bold text-gray-900 mb-1">{{ __('app.required_cookies') }}</h3>
                                <p class="text-sm text-gray-500 leading-relaxed">{{ __('app.required_cookies_desc') }}</p>
                            </div>
                        </div>

                        <!-- Performance -->
                        <div class="flex items-start gap-4">
                            <div class="pt-1">
                                <input type="checkbox" checked class="w-5 h-5 rounded border-gray-300 text-black focus:ring-black">
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-900 mb-1">{{ __('app.performance_cookies') }}</h3>
                                <p class="text-sm text-gray-500 leading-relaxed">{{ __('app.performance_cookies_desc') }}</p>
                            </div>
                        </div>

                        <!-- Research -->
                        <div class="flex items-start gap-4">
                            <div class="pt-1">
                                <input type="checkbox" checked class="w-5 h-5 rounded border-gray-300 text-black focus:ring-black">
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-900 mb-1">{{ __('app.research_cookies') }}</h3>
                                <p class="text-sm text-gray-500 leading-relaxed">{{ __('app.research_cookies_desc') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Links -->
                    <div class="mt-8 pt-6 border-t border-gray-100 text-[13px] text-gray-500 italic">
                        {{ __('To learn more about cookies, please see our complete') }} <a href="#" class="underline hover:text-black">{{ __('cookie policy') }}</a>. {{ __('To learn more about how we use and protect your data, please see our') }} <a href="#" class="underline hover:text-black">{{ __('app.privacy_policy') }}</a>.
                    </div>

                    <!-- Confirm Button -->
                    <div class="mt-8 flex justify-end">
                        <button @click="showCookies = false" 
                                class="bg-black text-white px-8 py-2.5 rounded shadow-lg hover:bg-gray-800 transition-all font-bold text-sm">
                            {{ __('app.confirm_cookies') }}
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
