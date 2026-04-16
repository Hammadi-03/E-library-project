@section('title', 'Login - Libraries Connected')

<x-guest-layout>
<div class="min-h-screen flex flex-col bg-white font-sans">

    {{-- ===== TOP NAVBAR ===== --}}
    <header class="flex h-16 w-full">
        {{-- Left: Logo block --}}
        <div class="bg-white px-6 flex items-center justify-center shrink-0 border-b border-gray-100">
            <a href="/">
                <img src="{{ asset('logo.png') }}" class="h-10 w-auto" alt="Libraries Connected Logo">
            </a>
        </div>
        
        {{-- Right: Maroon Header --}}
        <div class="bg-[#8B1B3B] flex-1 flex items-center justify-between px-6 text-white text-sm">
            <a href="/" class="hover:text-gray-200 transition">
                <i class="fa-solid fa-home"></i>
            </a>
            
            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}" class="flex items-center gap-2 hover:text-gray-200 transition">
                    <i class="fa-solid fa-sign-in-alt"></i> Login
                </a>
                <span class="text-gray-300">|</span>
                <button class="hover:text-gray-200 transition font-serif text-lg">+A</button>
                <button class="hover:text-gray-200 transition font-serif text-lg">-A</button>
                <span class="text-gray-300">|</span>
                <button class="hover:text-gray-200 transition"><i class="fa-solid fa-eye"></i></button>
                <div class="flex items-center gap-3">
                    <a href="{{ route('lang.switch', 'id') }}" title="Indonesia" class="hover:scale-110 transition {{ app()->getLocale() == 'id' ? 'opacity-100' : 'opacity-60' }}">🇮🇩</a>
                    <a href="{{ route('lang.switch', 'en') }}" title="English" class="hover:scale-110 transition {{ app()->getLocale() == 'en' ? 'opacity-100' : 'opacity-60' }}">🇬🇧</a>
                    <a href="{{ route('lang.switch', 'ar') }}" title="Arabic" class="hover:scale-110 transition {{ app()->getLocale() == 'ar' ? 'opacity-100' : 'opacity-60' }}">🇸🇦</a>
                </div>
            </div>
        </div>
    </header>

    {{-- ===== LOGIN AREA ===== --}}
    <main class="flex-1 flex flex-col items-center pt-16 px-4">
        
        {{-- Header Banner --}}
        <div class="bg-[#f0f0f0] w-full max-w-5xl py-8 px-4 text-center mb-12 shadow-sm rounded-sm">
            <h1 class="text-3xl md:text-4xl font-light text-[#333333] mb-3">Welcome to Libraries Connected Portal for Public Services</h1>
            <p class="text-gray-600 text-lg">Use the same account login details or create new account</p>
        </div>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded text-sm text-red-700 w-full max-w-2xl">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{-- Session Status --}}
        <x-auth-session-status class="mb-4" :status="session('status')" />

        {{-- Form Container --}}
        <div class="w-full max-w-2xl px-4">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- User Name --}}
                <div class="flex flex-col md:flex-row items-start md:items-center mb-6">
                    <label for="email" class="w-full md:w-48 text-[#666666] text-sm mb-2 md:mb-0">
                        User Name
                    </label>
                    <input
                        id="email"
                        type="text"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="flex-1 w-full border border-gray-300 rounded-sm px-3 py-2 text-sm text-gray-700 focus:outline-none focus:border-[#8B1B3B] focus:ring-1 focus:ring-[#8B1B3B]"
                        placeholder="290xxxx or a.mohamed"
                    >
                </div>

                {{-- Password --}}
                <div class="flex flex-col md:flex-row items-start md:items-center mb-10">
                    <label for="password" class="w-full md:w-48 text-[#666666] text-sm mb-2 md:mb-0">
                        Password
                    </label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        class="flex-1 w-full border border-gray-300 rounded-sm px-3 py-2 text-sm text-gray-700 focus:outline-none focus:border-[#8B1B3B] focus:ring-1 focus:ring-[#8B1B3B]"
                    >
                </div>

                {{-- Actions --}}
                <div class="flex flex-col items-center">
                    <button type="submit" class="bg-[#801336] hover:bg-[#600f28] text-white px-8 py-2 rounded-md shadow-md transition mb-6 text-sm">
                        Login
                    </button>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-[#888888] hover:text-[#555555] text-sm mb-4 transition">
                            Forgot password?
                        </a>
                    @endif

                    <a href="{{ route('register') }}" class="text-[#888888] hover:text-[#555555] text-sm transition">
                        Create Account
                    </a>
                </div>
            </form>
        </div>

    </main>

</div>
</x-guest-layout>

