<nav x-data="{ open: false, collectionsOpen: false }" class="bg-white border-b-4 border-red-900">

    {{-- TOP UTILITY BAR --}}
    <div class="border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-end items-center h-8 gap-4 text-xs text-gray-500">
                <a href="#" class="hover:text-red-900 transition">{{ __('app.help') }}</a>

                {{-- Language Switcher --}}
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center gap-1 hover:text-red-900 transition">
                        @if(app()->getLocale() === 'id') 🇮🇩 ID
                        @elseif(app()->getLocale() === 'en') 🇬🇧 EN
                        @elseif(app()->getLocale() === 'ar') 🇸🇦 AR
                        @endif
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
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
            <div class="flex items-center gap-8">
                {{-- Logo --}}
                <a href="{{ route('dashboard') }}" class="shrink-0">
                    <img src="{{ asset('Frame 33863.jpg') }}" class="h-12 w-auto" alt="Qatar National Library">
                </a>

                {{-- Nav Links (desktop) --}}
                <div class="hidden sm:flex items-center gap-1 text-sm font-medium text-gray-700">

                    <a href="{{ route('dashboard') }}"
                       class="px-3 py-2 hover:text-red-900 transition border-b-2 {{ request()->routeIs('dashboard') ? 'border-red-900 text-red-900' : 'border-transparent' }}">
                        {{ __('Dashboard') }}
                    </a>

                    @if(auth()->user()?->role !== 'admin')
                        <a href="{{ route('subjects') }}"
                           class="px-3 py-2 hover:text-red-900 transition border-b-2 {{ request()->routeIs('subjects') ? 'border-red-900 text-red-900' : 'border-transparent' }}">
                            {{ __('Subjects') }}
                        </a>

                        {{-- Collections dropdown --}}
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="flex items-center gap-1 px-3 py-2 hover:text-red-900 transition border-b-2 {{ request()->routeIs('collections') ? 'border-red-900 text-red-900' : 'border-transparent' }}">
                                {{ __('Collections') }}
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false" x-cloak
                                class="absolute left-0 mt-1 w-44 bg-white shadow-lg border border-gray-100 py-1 z-50 text-sm">
                                <a href="{{ route('collections') }}" class="block px-4 py-2 hover:bg-gray-50 text-gray-700">{{ __('Collections') }}</a>
                            </div>
                        </div>
                    @endif

                    @auth
                    @if(auth()->user()?->role == 'admin')
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
                    @endif
                    @endauth
                </div>
            </div>

            {{-- RIGHT: Search + Notifications + User --}}
            <div class="hidden sm:flex items-center gap-3">

                {{-- Search button --}}
                <button class="flex items-center gap-1.5 text-sm text-gray-600 hover:text-red-900 transition px-2 py-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z"/>
                    </svg>
                    {{ __('Search') }}
                </button>

                {{-- Notifications --}}
                <x-dropdown align="right" width="64">
                    <x-slot name="trigger">
                        <button class="relative p-1 text-gray-500 hover:text-red-900 transition">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
                            @endif
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <div class="px-4 py-2 text-xs text-gray-400">{{ __('Notifications') }}</div>
                        <div class="border-t border-gray-100"></div>
                        @forelse(auth()->user()->unreadNotifications as $notification)
                            <div class="px-4 py-3 hover:bg-gray-50">
                                <p class="text-sm text-gray-600">{{ $notification->data['message'] ?? 'New notification' }}</p>
                                <span class="text-xs text-gray-400">{{ $notification->created_at->diffForHumans() }}</span>
                            </div>
                        @empty
                            <div class="px-4 py-6 text-center text-gray-500 text-sm italic">{{ __('No notifications yet') }}</div>
                        @endforelse
                    </x-slot>
                </x-dropdown>

                {{-- User dropdown --}}
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2 bg-red-900 text-white text-sm font-semibold px-4 py-1.5 hover:bg-red-900 transition">
                            {{ Auth::user()->name }}
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
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
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- MOBILE MENU --}}
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden border-t border-gray-100">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <a href="{{ route('dashboard') }}" class="block py-2 text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-red-900' : 'text-gray-700' }}">{{ __('Dashboard') }}</a>
            @if(auth()->user()?->role !== 'admin')
                <a href="{{ route('subjects') }}" class="block py-2 text-sm font-medium {{ request()->routeIs('subjects') ? 'text-red-900' : 'text-gray-700' }}">{{ __('Subjects') }}</a>
                <a href="{{ route('collections') }}" class="block py-2 text-sm font-medium {{ request()->routeIs('collections') ? 'text-red-900' : 'text-gray-700' }}">{{ __('Collections') }}</a>
            @endif
            @if(auth()->user()?->role == 'admin')
                <a href="{{ route('books') }}" class="block py-2 text-sm font-medium {{ request()->routeIs('books') ? 'text-red-900' : 'text-gray-700' }}">{{ __('Kelola Buku') }}</a>
                <a href="{{ route('loans') }}" class="block py-2 text-sm font-medium {{ request()->routeIs('loans') ? 'text-red-900' : 'text-gray-700' }}">{{ __('Peminjaman') }}</a>
                <a href="{{ route('return') }}" class="block py-2 text-sm font-medium {{ request()->routeIs('return') ? 'text-red-900' : 'text-gray-700' }}">{{ __('Return') }}</a>
            @endif
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
