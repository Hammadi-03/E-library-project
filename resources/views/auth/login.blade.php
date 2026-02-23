@section('title', 'Login - Qatar National Library')

<x-guest-layout>
<div class="min-h-screen flex flex-col bg-white">n

    {{-- ===== TOP NAVBAR ===== --}}
    <nav style="background-color: #333333;" class="w-full">
        <div class="max-w-full px-0 flex items-center justify-betwee h-14">

            {{-- Left: Logo block (white background) --}}
            <div class="flex items-center bg-white h-14 px-4 gap-3 min-w-[220px]">
                <img src="{{ asset('Frame 33863.jpg') }}" class="h-10 w-auto" alt="Qatar National Library Logo">
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

    {{-- ===== WELCOME BANNER ===== --}}
    <div class="w-full bg-gray-100 border-b border-gray-200 py-5 text-center">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-1">
            {{ __('app.welcome_portal') }}
        </h1>
        <p class="text-sm text-gray-500">
           {{ __('app.login_details') }}
        </p>
    </div>

    {{-- ===== LOGIN FORM ===== --}}
    <div class="flex-1 flex items-start justify-center pt-10 px-4">
        <div class="w-full max-w-xl">

            {{-- Session Status --}}
            <x-auth-session-status class="mb-4" :status="session('status')" />

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded text-sm text-red-700">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                {{-- User Name / Email --}}
                <div class="flex items-center gap-4">
                    <label for="email" class="w-28 text-sm text-gray-600 text-right flex-shrink-0">
                        {{ __('app.email') }}
                    </label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="290xxx or a.mohamed"
                        class="flex-1 border border-gray-300 rounded px-3 py-2 text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:border-red-800 focus:ring-1 focus:ring-red-800"
                    >
                </div>

                {{-- Password --}}
                <div class="flex items-center gap-4">
                    <label for="password" class="w-28 text-sm text-gray-600 text-right flex-shrink-0">
                        {{ __('app.password') }}
                    </label>
                    <div class="flex-1 relative">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            class="w-full border border-gray-300 rounded px-3 py-2 text-sm text-gray-700 focus:outline-none focus:border-red-800 focus:ring-1 focus:ring-red-800"
                        >
                        <button type="button" onclick="togglePassword()"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Login Button --}}
                <div class="g-recaptcha" data-sitekey="{{ env('6Lc5v3QsAAAAACqzZs8iTw9SxOR31Wu3AfJG9QeA') }}"></div>
                
                <div class="flex justify-center pt-2">
                    <button type="submit"
                        style="background-color: #6d1a36;"
                        class="px-12 py-2 text-white text-sm font-bold rounded hover:opacity-90 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-900">
                        {{ __('app.sign_in_btn') }}
                    </button>
                </div>
            </form>

            {{-- Bottom Links --}}
            <div class="mt-4 flex flex-col items-center gap-1">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-gray-500 hover:text-gray-800 underline-offset-2 hover:underline transition">
                        {{ __('app.forgot_password') }}
                    </a>
                @endif
                <a href="{{ route('register') }}" class="text-sm text-gray-500 hover:text-gray-800 underline-offset-2 hover:underline transition">
                    {{ __('app.create_account') }}
                </a>
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
