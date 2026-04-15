<nav x-data="{ open: false, collectionsOpen: false }" class="bg-white border-b border-black sticky top-0 z-[100]">

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
                        <a href="{{ route('lang.switch', 'id') }}" class="flex items-center gap-2 px-3 py-1.5 hover:bg-gray-50 {{ app()->getLocale() === 'id' ? 'font-bold text-red-900' : 'text-gray-700' }}"><i class="fa-solid fa-flag text-red-600 w-4"></i> Indonesia</a>
                        <a href="{{ route('lang.switch', 'en') }}" class="flex items-center gap-2 px-3 py-1.5 hover:bg-gray-50 {{ app()->getLocale() === 'en' ? 'font-bold text-red-900' : 'text-gray-700' }}"><i class="fa-solid fa-earth-americas text-blue-600 w-4"></i> English</a>
                        <a href="{{ route('lang.switch', 'ar') }}" class="flex items-center gap-2 px-3 py-1.5 hover:bg-gray-50 {{ app()->getLocale() === 'ar' ? 'font-bold text-red-900' : 'text-gray-700' }}"><i class="fa-solid fa-moon text-emerald-600 w-4"></i> العربية</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MAIN NAV BAR --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            {{-- LEFT: Logo + Nav Links --}}
            <div class="flex items-center gap-8 lg:gap-12">
                {{-- Logo --}}
                <a href="{{ route('dashboard') }}" class="shrink-0">
                    <img src="{{ asset('logo.png') }}" class="h-10 w-auto" alt="Libraries Connected Logo">
                </a>

                {{-- Nav Links (desktop) --}}
                <div class="hidden sm:flex items-center gap-1 text-sm font-medium text-gray-700">
                    <a href="{{ route('dashboard') }}"
                       class="whitespace-nowrap px-3 py-2 hover:text-red-900 transition border-b-2 {{ request()->routeIs('dashboard') ? 'border-red-900 text-red-900' : 'border-transparent' }}">
                        {{ __('app.dashboard') ?? 'Dashboard' }}
                    </a>
                    <a href="{{ url('/') }}"
                       class="whitespace-nowrap px-3 py-2 hover:text-red-900 transition border-b-2 {{ request()->is('/') ? 'border-red-900 text-red-900' : 'border-transparent' }}">
                        {{ __('app.home') ?? 'Home' }}
                    </a>
                    @auth
                    <a href="{{ route('books') }}"
                       class="whitespace-nowrap px-3 py-2 hover:text-red-900 transition border-b-2 {{ request()->routeIs('books') ? 'border-red-900 text-red-900' : 'border-transparent' }}">
                        {{ __('app.manage_books') ?? 'Kelola Buku' }}
                    </a>
                    <a href="{{ route('loans') }}"
                       class="whitespace-nowrap px-3 py-2 hover:text-red-900 transition border-b-2 {{ request()->routeIs('loans') ? 'border-red-900 text-red-900' : 'border-transparent' }}">
                        {{ __('app.loans_mgmt') ?? 'Peminjaman' }}
                    </a>
                    <a href="{{ route('return') }}"
                       class="whitespace-nowrap px-3 py-2 hover:text-red-900 transition border-b-2 {{ request()->routeIs('return') ? 'border-red-900 text-red-900' : 'border-transparent' }}">
                        {{ __('app.returns_mgmt') ?? 'Return' }}
                    </a>
                    @endauth
                </div>
            </div>

            {{-- RIGHT: Search + Notifications + User --}}
            <div class="hidden sm:flex items-center gap-3">
                {{-- Search bar removed as per request --}}

                @auth
                {{-- Notifications --}}
                @php
                    $user = auth()->user();
                    $notificationsData = $user ? $user->unreadNotifications->map(function($n) {
                        return [
                            'id' => $n->id,
                            'title' => $n->data['book_title'] ?? 'Notification',
                            'description' => $n->data['message'] ?? '',
                            'time' => $n->created_at->diffForHumans(),
                        ];
                    }) : collect([]);
                    $unreadCount = $user ? $user->unreadNotifications->count() : 0;
                @endphp
                <div id="notifications-root" data-notifications="{{ json_encode($notificationsData) }}" x-data="{ open: false }">
                    <button @click="open = !open" class="relative inline-flex items-center justify-center rounded-full p-2 hover:bg-gray-100 text-gray-600 hover:text-red-900 transition react-notifications-fallback">
                        <i class="fa-regular fa-bell text-lg"></i>
                        @if($unreadCount > 0)
                            <span class="absolute -top-1 -right-1 bg-red-600 text-white text-[10px] font-bold rounded-full min-w-[18px] h-[18px] flex items-center justify-center border-2 border-white">
                                {{ $unreadCount }}
                            </span>
                        @endif
                    </button>
                    <div x-show="open" @click.away="open = false" x-cloak
                         class="absolute right-0 mt-2 w-80 bg-white rounded-2xl shadow-2xl border border-gray-100 z-50 overflow-hidden react-notifications-fallback">
                        <div class="p-4 border-b border-gray-100">
                            <h3 class="font-bold text-gray-900 text-sm">Notifications</h3>
                        </div>
                        @forelse(auth()->user()->unreadNotifications->take(5) as $notif)
                            <div class="flex gap-3 p-4 hover:bg-gray-50 border-b border-gray-50 transition">
                                <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center shrink-0">
                                    <i class="fa-solid fa-book text-red-700 text-xs"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-900 truncate">{{ $notif->data['book_title'] ?? 'Notification' }}</p>
                                    <p class="text-xs text-gray-500 mt-0.5 line-clamp-2">{{ $notif->data['message'] ?? '' }}</p>
                                    <p class="text-[10px] text-gray-400 mt-1">{{ $notif->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="p-6 text-center text-sm text-gray-400">No new notifications</div>
                        @endforelse
                    </div>
                </div>

                {{-- User Dropdown --}}
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2 bg-red-900 text-white text-sm font-semibold px-4 py-1.5 hover:bg-red-800 transition">
                            {{ Auth::user()->name }}
                            <i class="fa-solid fa-chevron-down text-[10px] ml-1"></i>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">{{ __('app.profile') ?? 'Profile' }}</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('app.logout') ?? 'Log Out' }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @else
                    <div class="flex items-center gap-3">
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-red-900">{{ __('app.login') ?? 'Login' }}</a>
                        <a href="{{ route('register') }}" class="bg-black text-white text-sm font-bold px-5 py-2 hover:bg-red-900 transition rounded-full">{{ __('app.sign_up') ?? 'Sign Up' }}</a>
                    </div>
                @endauth
            </div>

            {{-- Hamburger --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition">
                    <i :class="{'hidden': open, 'inline-block': !open}" class="fa-solid fa-bars text-xl"></i>
                    <i :class="{'hidden': !open, 'inline-block': open}" class="fa-solid fa-xmark text-xl hidden"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden border-t border-gray-100">
        <div class="pt-2 pb-3 space-y-1 px-4 text-sm">
            <a href="{{ route('dashboard') }}" class="block py-2 font-medium {{ request()->routeIs('dashboard') ? 'text-red-900' : 'text-gray-700' }}">{{ __('app.dashboard') ?? 'Dashboard' }}</a>
            <a href="{{ url('/') }}" class="block py-2 font-medium {{ request()->is('/') ? 'text-red-900' : 'text-gray-700' }}">{{ __('app.home') ?? 'Home' }}</a>
            @auth
            <a href="{{ route('books') }}" class="block py-2 font-medium">{{ __('app.manage_books') ?? 'Kelola Buku' }}</a>
            <a href="{{ route('loans') }}" class="block py-2 font-medium">{{ __('app.loans_mgmt') ?? 'Peminjaman' }}</a>
            @endauth
        </div>
    </div>
</nav>
