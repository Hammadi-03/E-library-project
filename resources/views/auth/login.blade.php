@section('title', 'Login - Qatar National Library')

<x-guest-layout>
<div class="min-h-screen flex flex-col bg-white">

    {{-- ===== TOP NAVBAR ===== --}}
    <nav style="background-color: #333333;" class="w-full">
        <div class="max-w-full px-0 flex items-center justify-betwee h-14">

            {{-- Left: Logo block (white background) --}}
            <div class="flex items-center bg-white h-14 px-4 gap-3 min-w-[220px]">
                <img src="{{ asset('logo.png') }}" class="h-10 w-auto" alt="Libraries Connected Logo">
            </div>

            {{-- Center: Home icon --}}
            <div class="flex items-center px-6">
                <a href="/" class="text-white flex items-center gap-1 text-sm hover:text-gray-200 transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7A1 1 0 003 11h1v6a1 1 0 001 1h4v-4h2v4h4a1 1 0 001-1v-6h1a1 1 0 00.707-1.707l-7-7z"/>
                    </svg>
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </a>
            </div>

            {{-- Right: Login / Language links --}}
            <div class="flex items-center gap-4 px-6 text-white text-sm">
                <a href="{{ route('login') }}" class="flex items-center gap-1 hover:text-gray-200 transition font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    {{ __('app.login') }}
                </a>
                <span class="opacity-100">|</span>
                {{-- Language Switcher --}}
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center gap-1 hover:text-gray-200 transition">
                        @if(app()->getLocale() === 'id') 🇮🇩 ID
                        @elseif(app()->getLocale() === 'en') 🇬🇧 EN
                        @elseif(app()->getLocale() === 'ar') 🇸🇦
                        @endif
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         class="absolute right-0 mt-2 w-40 bg-white rounded shadow-lg border border-gray-100 py-1 z-50">
                        <a href="{{ route('lang.switch', 'id') }}"
                           class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-900 {{ app()->getLocale() === 'id' ? 'font-bold text-red-900' : '' }}">
                            🇮🇩 Indonesia
                        </a>
                        <a href="{{ route('lang.switch', 'en') }}"
                           class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-900 {{ app()->getLocale() === 'en' ? 'font-bold text-red-900' : '' }}">
                            🇬🇧 English
                        </a>
                        <a href="{{ route('lang.switch', 'ar') }}"
                           class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-900 {{ app()->getLocale() === 'ar' ? 'font-bold text-red-900' : '' }}">
                            🇸🇦 عربي
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    {{-- ===== LOGIN AREA ===== --}}
    <div class="flex-1 flex items-center justify-center py-10 px-4 md:px-0">
        <div class="w-full max-w-6xl flex flex-col md:flex-row bg-white rounded-2xl overflow-hidden shadow-2xl border border-gray-100 min-h-[600px]">
            
            {{-- Illustration Column --}}
            <div class="hidden md:flex flex-1 bg-gray-50 items-center justify-center p-12 relative overflow-hidden">
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute -top-10 -left-10 w-40 h-40 bg-red-900 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-10 -right-10 w-60 h-60 bg-emerald-900 rounded-full blur-3xl"></div>
                </div>
                
                <div class="relative z-10 w-full max-w-lg aspect-square">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 600" class="w-full h-full drop-shadow-2xl">
                        <!-- Background Shape -->
                        <path d="M150,200 Q200,50 400,100 T650,200 Q750,350 500,450 T150,200" fill="#E8D5DD" opacity="0.6"/>
                        
                        <!-- Books on Shelf/Spines -->
                        <rect x="180" y="280" width="60" height="300" fill="#8E1B3B" rx="5" />
                        <rect x="250" y="220" width="70" height="360" fill="#3E6B5D" rx="5" />
                        <rect x="330" y="280" width="50" height="300" fill="#E0C0CE" rx="5" />
                        <rect x="430" y="240" width="60" height="340" fill="#8B2144" rx="5" />
                        <rect x="500" y="220" width="80" height="360" fill="#829E9A" rx="5" />
                        <rect x="590" y="290" width="70" height="290" fill="#B07090" rx="5" transform="rotate(10 625 435)" />
                        
                        <!-- Monitor and Tablet -->
                        <rect x="340" y="420" width="380" height="250" fill="#555" rx="10" /> 
                        <rect x="360" y="445" width="340" height="200" fill="#FFF" /> 
                        <rect x="320" y="670" width="420" height="20" fill="#DDD" rx="10" /> 
                        <rect x="30" y="430" width="200" height="300" fill="#DDD" rx="15" transform="perspective(500) rotateY(20)" />
                        <rect x="45" y="445" width="170" height="270" fill="#FFF" rx="5" transform="perspective(500) rotateY(20)" />
                        
                        <!-- Lamp or Decorative Elements -->
                        <circle cx="285" cy="100" r="20" fill="#000" /> 
                        <path d="M260,120 Q285,110 310,120 L310,200 L260,200 Z" fill="#FFF" /> 
                        <path d="M260,200 L245,280 M310,200 L325,280" stroke="#8B2144" stroke-width="15" /> 
                        
                        <!-- Mouse or small accessories -->
                        <circle cx="130" cy="550" r="15" fill="#3D2B1F" /> 
                        <rect x="110" y="570" width="40" height="80" fill="#8B1B3B" rx="10" /> 
                        <path d="M120,650 L120,750 L200,750" stroke="#CCC" stroke-width="15" fill="none" /> 
                        <rect x="90" y="730" width="70" height="90" fill="#3E6B5D" /> 
                        
                        <!-- Window-like highlights or smaller books on screen -->
                        <rect x="380" y="500" width="40" height="60" fill="#E0C0CE" rx="2" />
                        <rect x="430" y="500" width="40" height="60" fill="#B07090" rx="2" />
                        <rect x="480" y="500" width="40" height="60" fill="#829E9A" rx="2" />
                    </svg>
                </div>
            </div>

            {{-- Form Column --}}
            <div class="flex-1 flex flex-col p-8 md:p-16 justify-center">
                <div class="mb-10 text-center md:text-left">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ __('app.welcome_portal') }}</h2>
                    <p class="text-gray-500 text-sm">{{ __('app.login_details') }}</p>
                </div>

                {{-- Session Status --}}
                <x-auth-session-status class="mb-4" :status="session('status')" />

                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-xl text-sm text-red-700 font-medium">
                        @foreach ($errors->all() as $error)
                            <p class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $error }}
                            </p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 px-1">
                            {{ __('app.email') }}
                        </label>
                        <div class="group">
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="name@example.com"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3.5 text-gray-900 focus:outline-none focus:border-red-900 focus:bg-white transition"
                            >
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2 px-1">
                            <label for="password" class="block text-xs font-bold text-gray-400 uppercase tracking-widest">
                                {{ __('app.password') }}
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs text-red-900 font-bold hover:underline">
                                    {{ __('app.forgot_password') }}?
                                </a>
                            @endif
                        </div>
                        <div class="relative group">
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="••••••••"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3.5 text-gray-900 focus:outline-none focus:border-red-900 focus:bg-white transition"
                            >
                            <button type="button" onclick="togglePassword()"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-900 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shadow-sm" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            style="background-color: #6d1a36;"
                            class="w-full py-4 text-white font-bold rounded-xl shadow-xl hover:shadow-red-900/20 hover:-translate-y-0.5 transition focus:outline-none focus:ring-4 focus:ring-red-900/10">
                            {{ __('app.sign_in_btn') }}
                        </button>
                    </div>
                </form>

                <div class="mt-10 pt-10 border-t border-gray-100 text-center md:text-left">
                    <p class="text-gray-500 text-sm">
                        {{ __("Don't have an account?") }} 
                        <a href="{{ route('register') }}" class="text-red-900 font-bold hover:underline transition">
                            {{ __('app.create_account') }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function togglePassword() {
        var x = document.getElementById("password");
        x.type = x.type === "password" ? "text" : "password";
    }
</script>
</x-guest-layout>
