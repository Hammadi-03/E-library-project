<nav x-data="{ open: false, collectionsOpen: false }" class="bg-white border-b border-black">

    {{-- TOP UTILITY BAR --}}
    <div class="border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-end items-center h-8 gap-4 text-xs text-gray-500">
                <a href="#" class="hover:text-red-900 transition">{{ __('app.help') }}</a>

                {{-- Language Switcher --}}
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center gap-1 hover:text-red-900 transition">
                        @if(app()->getLocale() === 'id') <i class="fa-solid fa-flag text-red-600"></i> ID
                        @elseif(app()->getLocale() === 'en') <i class="fa-solid fa-earth-americas text-blue-600"></i> EN
                        @elseif(app()->getLocale() === 'ar') <i class="fa-solid fa-moon text-emerald-600"></i> AR
                        @endif
                        <i class="fa-solid fa-chevron-down text-[10px] ml-1"></i>
                    </button>
                    <div x-show="open" @click.away="open = false" x-cloak
                        class="absolute right-0 mt-1 w-36 bg-white shadow-lg border border-gray-100 py-1 z-50 text-sm">
                        <a href="{{ route('lang.switch', 'id') }}" class="flex items-center gap-2 px-3 py-1.5 hover:bg-gray-50 {{ app()->getLocale() === 'id' ? 'font-bold text-red-900' : 'text-gray-700' }}">🇮🇩 Indonesia</a>
                        <a href="{{ route('lang.switch', 'en') }}" class="flex items-center gap-2 px-3 py-1.5 hover:bg-gray-50 {{ app()->getLocale() === 'en' ? 'font-bold text-red-900' : 'text-gray-700' }}">🇬🇧 English</a>
                        <a href="{{ route('lang.switch', 'ar') }}" class="flex items-center gap-2 px-3 py-1.5 hover:bg-gray-50 {{ app()->getLocale() === 'ar' ? 'font-bold text-red-900' : 'text-gray-700' }}">🇸🇦 العربية</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MAIN NAV BAR --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            {{-- LEFT: Logo + Nav Links --}}
            <div class="flex items-center gap-16">
                {{-- Logo --}}
                <a href="{{ route('dashboard') }}" class="shrink-0">
                    <img src="{{ asset('Frame 33863.jpg') }}" class="h-12 w-auto -ml-4" alt="Qatar National Library">
                </a>

                {{-- Nav Links (desktop) --}}
                <div class="hidden sm:flex items-center gap-1 text-sm font-medium text-gray-700">

                    <a href="{{ route('dashboard') }}"
                       class="px-3 py-2 hover:text-red-900 transition border-b-2 {{ request()->routeIs('dashboard') ? 'border-red-900 text-red-900' : 'border-transparent' }}">
                        {{ __('Dashboard') }}
                    </a>

                    <a href="{{ url('/') }}"
                       class="px-3 py-2 hover:text-red-900 transition border-b-2 {{ request()->is('/') ? 'border-red-900 text-red-900' : 'border-transparent' }}">
                        {{ __('Home') }}
                    </a>

                    {{-- Collections dropdown --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center gap-1 px-3 py-2 hover:text-red-900 transition border-b-2 {{ request()->routeIs('collections') ? 'border-red-900 text-red-900' : 'border-transparent' }}">
                            {{ __('Collections') }}
                            <i class="fa-solid fa-chevron-down text-[10px] ml-1"></i>
                        </button>
                        <div x-show="open" @click.away="open = false" x-cloak
                            class="absolute left-0 mt-1 w-44 bg-white shadow-lg border border-gray-100 py-1 z-50 text-sm">
                            <a href="{{ route('collections') }}" class="block px-4 py-2 hover:bg-gray-50 text-gray-700">{{ __('Collections') }}</a>
                        </div>
                    </div>

                    @auth
                    <a href="{{ route('books') }}"
                       class="px-3 py-2 hover:text-red-900 transition border-b-2 {{ request()->routeIs('books') ? 'border-red-900 text-red-900' : 'border-transparent' }}">
                        {{ __('Kelola Buku') }}
                    </a>
                    <a href="{{ route('loans') }}"
                       class="px-3 py-2 hover:text-red-900 transition border-b-2 {{ request()->routeIs('loans') ? 'border-red-900 text-red-900' : 'border-transparent' }}">
                        {{ __('Peminjaman') }}
                    </a>
                    <a href="{{ route('return') }}"
                       class="px-3 py-2 hover:text-red-900 transition border-b-2 {{ request()->routeIs('return') ? 'border-red-900 text-red-900' : 'border-transparent' }}">
                        {{ __('Return') }}
                    </a>
                    @endauth
                </div>
            </div>

            {{-- RIGHT: Search + Notifications + User --}}
            <div class="hidden sm:flex items-center gap-3">

                {{-- Search button --}}
                <button class="flex items-center gap-1.5 text-sm text-gray-600 hover:text-red-900 transition px-2 py-1">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    {{ __('Search') }}
                </button>

                {{-- React Notifications Component --}}
                @php
                    $notificationsData = auth()->user()->unreadNotifications->map(function($n) {
                        return [
                            'id' => $n->id,
                            'title' => $n->data['book_title'] ?? 'Notification',
                            'description' => $n->data['message'] ?? '',
                            'time' => $n->created_at->diffForHumans(),
                        ];
                    });
                @endphp
                <div id="notifications-root" data-notifications="{{ json_encode($notificationsData) }}"></div>

                {{-- User dropdown --}}
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2 bg-red-900 text-white text-sm font-semibold px-4 py-1.5 hover:bg-red-900 transition">
                            {{ Auth::user()->name }}
                            <i class="fa-solid fa-chevron-down text-[10px] ml-1"></i>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('app.profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('app.logout') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- Hamburger (mobile) --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition">
                    <i :class="{'hidden': open, 'inline-block': !open}" class="fa-solid fa-bars text-xl"></i>
                    <i :class="{'hidden': !open, 'inline-block': open}" class="fa-solid fa-xmark text-xl hidden"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- MOBILE MENU --}}
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden border-t border-gray-100">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <a href="{{ route('dashboard') }}" class="block py-2 text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-red-900' : 'text-gray-700' }}">{{ __('Dashboard') }}</a>
            <a href="{{ url('/') }}" class="block py-2 text-sm font-medium {{ request()->is('/') ? 'text-red-900' : 'text-gray-700' }}">{{ __('Home') }}</a>
            <a href="{{ route('collections') }}" class="block py-2 text-sm font-medium {{ request()->routeIs('collections') ? 'text-red-900' : 'text-gray-700' }}">{{ __('Collections') }}</a>
            <a href="{{ route('books') }}" class="block py-2 text-sm font-medium {{ request()->routeIs('books') ? 'text-red-900' : 'text-gray-700' }}">{{ __('Kelola Buku') }}</a>
            <a href="{{ route('loans') }}" class="block py-2 text-sm font-medium {{ request()->routeIs('loans') ? 'text-red-900' : 'text-gray-700' }}">{{ __('Peminjaman') }}</a>
            <a href="{{ route('return') }}" class="block py-2 text-sm font-medium {{ request()->routeIs('return') ? 'text-red-900' : 'text-gray-700' }}">{{ __('Return') }}</a>
        </div>
        <div class="pt-4 pb-3 border-t border-gray-200 px-4">
            <div class="font-medium text-gray-800 text-sm">{{ Auth::user()->name }}</div>
            <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block py-2 text-sm text-gray-700">{{ __('Profile') }}</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block py-2 text-sm text-gray-700 w-full text-left">{{ __('Log Out') }}</button>
                </form>
            </div>
        </div>
    </div>

</nav>
