<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Qatar National Library @yield('title')</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('SVG Website.svg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.cdnfonts.com/css/proxima-nova-2" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/react-notifications.tsx'])
    <style>
        body { font-family: 'Proxima Nova', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    <!-- Header -->
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="flex items-center gap-2">
                        <img src="{{ asset('logo.png') }}" class="h-12 w-auto" alt="IDN Boarding School Library">
                    </a>
                </div>

                <!-- Navigation & Search -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-sm font-medium text-gray-700 hover:text-red-900">{{ __('Home') }}</a>
                </div>

                <!-- Search Bar -->
                <div class="flex-1 max-w-lg mx-8 hidden lg:block">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-full leading-5 bg-gray-50 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-red-900 focus:ring-1 focus:ring-red-900 sm:text-sm" placeholder="{{ __('app.search') }}">
                    </div>
                </div>

                <!-- Right Side: Language Switcher + Auth Buttons -->
                <div class="flex items-center gap-4">

                    <!-- Language Switcher Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center gap-1.5 text-sm font-medium text-gray-600 hover:text-red-900 border border-gray-200 rounded-full px-3 py-1.5 hover:border-red-200 transition">
                            @if(app()->getLocale() === 'id') 🇮🇩
                            @elseif(app()->getLocale() === 'en') 🇬🇧
                            @elseif(app()->getLocale() === 'ar') 🇸🇦
                            @endif
                            <span class="uppercase">{{ app()->getLocale() }}</span>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 mt-2 w-40 bg-white rounded-xl shadow-lg border border-gray-100 py-1 z-50">
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
                                🇸🇦 العربية
                            </a>
                        </div>
                    </div>

                    <!-- Auth Buttons -->
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-700 hover:text-red-900">{{ __('app.dashboard') }}</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-red-900">
                            {{ __('app.login') }}
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-2 border border-transparent rounded-full shadow-sm text-sm font-medium text-white bg-black hover:bg-red-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            {{ __('app.sign_up') }}
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section (Ramadan Reads) -->
    <div class="bg-emerald-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="mb-8 md:mb-0 md:w-1/2">
                    <div class="flex items-center gap-2 mb-4 text-emerald-200 uppercase tracking-wide text-sm font-bold">
                        <span>🌙</span> <span>{{ __('app.ramadan_reads') }}</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-4">
                        {{ __('app.hero_title') }}
                    </h1>
                    <p class="text-emerald-100 text-lg mb-8 max-w-lg">
                        {{ __('app.hero_desc') }}
                    </p>
                    <a href="#" class="inline-block px-8 py-3 bg-white text-emerald-900 font-bold rounded-full hover:bg-emerald-50 transition">
                        {{ __('app.view_collection') }}
                    </a>
                </div>

            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-16">

        <!-- Just Added Section -->
        <section>
            <div class="flex justify-between items-end mb-6">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                    <span class="text-indigo-600">📔</span> {{ __('app.just_added') }}
                </h2>
                <a href="#" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800">{{ __('app.view_all') }}</a>
            </div>
            
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
@if(!isset($justAddedBooks) || count($justAddedBooks) === 0)
                @php
                    $justAddedBooks = [
                        ['title' => 'At Night All Blood Is Black', 'author' => 'David Diop', 'cover_image' => 'j-book1.jpg', 'id' => 'j-book1'],
                        ['title' => 'I Live in the Slums', 'author' => 'Can Xue', 'cover_image' => 'j-book2.jpg', 'id' => 'j-book2'],
                        ['title' => 'Minor Detail', 'author' => 'Adania Shibli', 'cover_image' => 'j-book3.jpg', 'id' => 'j-book3'],
                        ['title' => 'When We Cease to Understand the World', 'author' => 'Benjamin Labatut', 'cover_image' => 'j-book4.jpg', 'id' => 'j-book4'],
                        ['title' => 'The Power of Focus', 'author' => 'Brian Tracy', 'cover_image' => 'j-book5.jpg', 'id' => 'j-book5'],
                        ['title' => 'Arsus', 'author' => 'Ahmed Al Hamdan', 'cover_image' => 'book-extra1.jpg', 'id' => 'book-extra1'],
                    ];
                @endphp
                @foreach ($justAddedBooks as $book)
                <a href="{{ route('books.show', ['id' => $book['id']]) }}" class="group block">
                    <div class="aspect-[2/3] bg-white shadow-sm overflow-hidden mb-3 relative group-hover:shadow-md transition border border-gray-100">
                        <img src="{{ asset('images/books/' . $book['cover_image']) }}" alt="{{ $book['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute bottom-0 left-0 right-0 bg-indigo-900/90 text-white text-xs font-bold py-1 text-center translate-y-full group-hover:translate-y-0 transition duration-300">
                            {{ __('app.borrow') }}
                        </div>
                    </div>
                    <h3 class="font-semibold text-gray-900 text-sm leading-tight mb-1 truncate">{{ $book['title'] }}</h3>
                    <p class="text-xs text-gray-500 truncate">{{ $book['author'] }}</p>
                </a>
                @endforeach
            @else
                @foreach ($justAddedBooks as $book)
                <a href="{{ route('books.show', ['id' => $book->id]) }}" class="group block">
                    <div class="aspect-[2/3] bg-white shadow-sm overflow-hidden mb-3 relative group-hover:shadow-md transition border border-gray-100">
                        <img src="{{ asset('images/books/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute bottom-0 left-0 right-0 bg-indigo-900/90 text-white text-xs font-bold py-1 text-center translate-y-full group-hover:translate-y-0 transition duration-300">
                            {{ __('app.borrow') }}
                        </div>
                    </div>
                    <h3 class="font-semibold text-gray-900 text-sm leading-tight mb-1 truncate">{{ $book->title }}</h3>
                    <p class="text-xs text-gray-500 truncate">{{ $book->author }}</p>
                </a>
                @endforeach
            @endif
            </div>
        </section>

        <!-- Mental Health Section -->
        <section>
            <div class="flex justify-between items-end mb-6">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                    <span class="text-emerald-500">🧠</span> {{ __('Mental Health') }}
                </h2>
                <a href="#" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800">{{ __('app.view_all') }}</a>
            </div>
            
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
@if(!isset($mentalHealthBooks) || count($mentalHealthBooks) === 0)
                @php
                    $mentalHealthBooks = [
                        ['title' => 'Stop Letting Everything Affect You', 'author' => 'Daniel Chidiac', 'cover_image' => 'm-book1.jpg', 'id' => 'm-book1'],
                        ['title' => 'Afraid', 'author' => 'Arash Javanbakht, MD', 'cover_image' => 'm-book2.jpg', 'id' => 'm-book2'],
                        ['title' => 'The Body Keeps the Score', 'author' => 'Bessel van der Kolk, M.D.', 'cover_image' => 'm-book3.jpg', 'id' => 'm-book3'],
                        ['title' => 'The Body Keeps the Score', 'author' => 'Bessel van der Kolk, M.D.', 'cover_image' => 'm-book4.jpg', 'id' => 'm-book4'],
                        ['title' => 'Unwinding Anxiety', 'author' => 'Judson Brewer, MD, PhD', 'cover_image' => 'm-book5.jpg', 'id' => 'm-book5'],
                        ['title' => 'The Cabinet', 'author' => 'Un-Su Kim', 'cover_image' => 'book-extra2.jpg', 'id' => 'book-extra2'],
                    ];
                @endphp

                @foreach ($mentalHealthBooks as $book)
                <a href="{{ route('books.show', ['id' => $book['id']]) }}" class="group block">
                    <div class="aspect-[2/3] bg-white shadow-sm overflow-hidden mb-3 relative group-hover:shadow-md transition border border-gray-100">
                        <img src="{{ asset('images/books/' . $book['cover_image']) }}" alt="{{ $book['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute bottom-0 left-0 right-0 bg-indigo-900/90 text-white text-xs font-bold py-1 text-center translate-y-full group-hover:translate-y-0 transition duration-300">
                            {{ __('app.borrow') }}
                        </div>
                    </div>
                    <h3 class="font-semibold text-gray-900 text-sm leading-tight mb-1 truncate">{{ $book['title'] }}</h3>
                    <p class="text-xs text-gray-500 truncate">{{ $book['author'] }}</p>
                </a>
                @endforeach
            @else
                @foreach ($mentalHealthBooks as $book)
                <a href="{{ route('books.show', ['id' => $book->id]) }}" class="group block">
                    <div class="aspect-[2/3] bg-white shadow-sm overflow-hidden mb-3 relative group-hover:shadow-md transition border border-gray-100">
                        <img src="{{ asset('images/books/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute bottom-0 left-0 right-0 bg-indigo-900/90 text-white text-xs font-bold py-1 text-center translate-y-full group-hover:translate-y-0 transition duration-300">
                            {{ __('app.borrow') }}
                        </div>
                    </div>
                    <h3 class="font-semibold text-gray-900 text-sm leading-tight mb-1 truncate">{{ $book->title }}</h3>
                    <p class="text-xs text-gray-500 truncate">{{ $book->author }}</p>
                </a>
                @endforeach
            @endif
            </div>
        </section>

        <!-- Korean Literature Section -->
        <section>
            <div class="flex justify-between items-end mb-6">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                    <span class="text-red-500">🇰🇷</span> {{ __('Korean Literature') }} 📚📖✨
                </h2>
                <a href="#" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800">{{ __('app.view_all') }}</a>
            </div>
            
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
@if(!isset($koreanBooks) || count($koreanBooks) === 0)
                @php
                    $koreanBooks = [
                        ['title' => 'Kim Jiyoung, Born 1982', 'author' => 'Cho Nam-joo', 'cover_image' => 'k-book1.jpg', 'id' => 'k-book1'],
                        ['title' => 'Eligible', 'author' => 'Curtis Sittenfeld', 'cover_image' => 'k-book2.jpg', 'id' => 'k-book2'],
                        ['title' => 'At Dusk', 'author' => 'Hwang Sok-yong', 'cover_image' => 'k-book3.jpg', 'id' => 'k-book3'],
                        ['title' => 'Beasts of a Little Land', 'author' => 'Juhea Kim', 'cover_image' => 'k-book4.jpg', 'id' => 'k-book4'],
                        ['title' => 'Kim Jiyoung, Born 1982', 'author' => 'Cho Nam-joo', 'cover_image' => 'k-book5.jpg', 'id' => 'k-book5'],
                        ['title' => 'The Cabinet', 'author' => 'Un-Su Kim', 'cover_image' => 'book-extra2.jpg', 'id' => 'book-extra2'],
                    ];
                @endphp

                @foreach ($koreanBooks as $book)
                <a href="{{ route('books.show', ['id' => $book['id']]) }}" class="group block">
                    <div class="aspect-[2/3] bg-white shadow-sm overflow-hidden mb-3 relative group-hover:shadow-md transition border border-gray-100">
                        <img src="{{ asset('images/books/' . $book['cover_image']) }}" alt="{{ $book['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute bottom-0 left-0 right-0 bg-indigo-900/90 text-white text-xs font-bold py-1 text-center translate-y-full group-hover:translate-y-0 transition duration-300">
                            {{ __('app.borrow') }}
                        </div>
                    </div>
                    <h3 class="font-semibold text-gray-900 text-sm leading-tight mb-1 truncate">{{ $book['title'] }}</h3>
                    <p class="text-xs text-gray-500 truncate">{{ $book['author'] }}</p>
                </a>
                @endforeach
            @else
                @foreach ($koreanBooks as $book)
                <a href="{{ route('books.show', ['id' => $book->id]) }}" class="group block">
                    <div class="aspect-[2/3] bg-white shadow-sm overflow-hidden mb-3 relative group-hover:shadow-md transition border border-gray-100">
                        <img src="{{ asset('images/books/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute bottom-0 left-0 right-0 bg-indigo-900/90 text-white text-xs font-bold py-1 text-center translate-y-full group-hover:translate-y-0 transition duration-300">
                            {{ __('app.borrow') }}
                        </div>
                    </div>
                    <h3 class="font-semibold text-gray-900 text-sm leading-tight mb-1 truncate">{{ $book->title }}</h3>
                    <p class="text-xs text-gray-500 truncate">{{ $book->author }}</p>
                </a>
                @endforeach
            @endif
            </div>
        </section>

    </main>

    <!-- Footer -->
    <x-footer />

    <!-- Alpine.js for dropdown -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</body>
</html>
