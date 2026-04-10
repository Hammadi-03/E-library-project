<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Qatar National Library @yield('title')</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('SVG Website.svg') }}">
    <link href="https://fonts.cdnfonts.com/css/proxima-nova-2" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/react-notifications.tsx'])
    <style>
        body { font-family: 'Proxima Nova', sans-serif; }
        .hero-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased rounded-t-[48px]">

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
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-sm font-bold text-gray-900 border-b-2 border-red-900 pb-1">{{ __('Home') }}</a>
                    <a href="#" class="text-sm font-medium text-gray-500 hover:text-red-900 transition">{{ __('Browse') }}</a>
                    <a href="#" class="text-sm font-medium text-gray-500 hover:text-red-900 transition">{{ __('About') }}</a>
                </nav>

                <!-- Search Bar with Live Suggestions (Alpine.js) -->
                <div class="flex-1 max-w-lg mx-8 hidden lg:block" 
                     x-data="{ 
                        query: '{{ $search ?? '' }}', 
                        suggestions: [], 
                        loading: false, 
                        show: false,
                        async fetchSuggestions() {
                            if (this.query.length < 2) {
                                this.suggestions = [];
                                this.show = false;
                                return;
                            }
                            this.loading = true;
                            try {
                                const res = await fetch(`/api/books/suggestions?query=${encodeURIComponent(this.query)}`);
                                this.suggestions = await res.json();
                                this.show = this.suggestions.length > 0;
                            } catch (e) {
                                console.error(e);
                            } finally {
                                this.loading = false;
                            }
                        }
                     }">
                    <form action="{{ url('/') }}" method="GET" class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-magnifying-glass text-gray-400 text-sm" x-show="!loading"></i>
                            <i class="fa-solid fa-spinner fa-spin text-red-900 text-sm" x-show="loading" x-cloak></i>
                        </div>
                        <input type="text" name="search" 
                               x-model="query"
                               @input.debounce.300ms="fetchSuggestions()"
                               @click.away="show = false"
                               @focus="if(suggestions.length > 0) show = true"
                               class="block w-full pl-11 pr-4 py-2.5 border border-red-900 rounded-full leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-red-900 sm:text-sm shadow-sm transition-all" 
                               placeholder="{{ __('app.search') }}"
                               autocomplete="off">
                        
                        <!-- Suggestions Dropdown -->
                        <div x-show="show" x-cloak
                             class="absolute mt-2 w-full bg-white rounded-xl shadow-2xl border border-gray-100 z-[100] overflow-hidden">
                            <template x-for="book in suggestions" :key="book.id">
                                <a :href="`/books/${book.id}`" 
                                   class="flex items-center gap-3 p-3 hover:bg-red-50 transition-colors border-b border-gray-50 last:border-0 group">
                                    <div class="w-10 h-14 bg-gray-100 flex-shrink-0 overflow-hidden rounded shadow-sm">
                                        <img :src="book.cover_image ? `/images/books/${book.cover_image}` : ''" 
                                             :alt="book.title"
                                             loading="lazy"
                                             class="w-full h-full object-cover"
                                             x-on:error="$el.src = 'https://placehold.co/40x60?text=Book'">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-bold text-gray-900 truncate group-hover:text-red-900" x-text="book.title"></p>
                                        <p class="text-xs text-gray-500 truncate" x-text="book.author"></p>
                                    </div>
                                    <i class="fa-solid fa-chevron-right text-[10px] text-gray-300 group-hover:text-red-900 pr-2"></i>
                                </a>
                            </template>
                            <div class="p-2 bg-gray-50 text-[10px] text-center text-gray-400 border-t border-gray-100 uppercase tracking-widest font-bold">
                                Press Enter to see all results
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Right Side: Language Switcher + Auth Buttons -->
                <div class="flex items-center gap-4">

                    <!-- Language Switcher Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center gap-1.5 text-sm font-medium text-gray-600 hover:text-red-900 border border-gray-200 rounded-full px-3 py-1.5 hover:border-red-200 transition">
                            @if(app()->getLocale() === 'id') <i class="fa-solid fa-flag text-red-600"></i>
                            @elseif(app()->getLocale() === 'en') <i class="fa-solid fa-earth-americas text-blue-600"></i>
                            @elseif(app()->getLocale() === 'ar') <i class="fa-solid fa-moon text-emerald-600"></i>
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
                                <i class="fa-solid fa-flag text-red-600 w-4"></i> Indonesia
                            </a>
                            <a href="{{ route('lang.switch', 'en') }}"
                                class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-900 {{ app()->getLocale() === 'en' ? 'font-bold text-red-900' : '' }}">
                                <i class="fa-solid fa-earth-americas text-blue-600 w-4"></i> English
                            </a>
                            <a href="{{ route('lang.switch', 'ar') }}"
                                class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-900 {{ app()->getLocale() === 'ar' ? 'font-bold text-red-900' : '' }}">
                                <i class="fa-solid fa-moon text-emerald-600 w-4"></i> العربية
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
    <div class="text-white pt-24 pb-36 relative overflow-hidden bg-[#0a192f]">
        {{-- Pixel Grid Background --}}
        <div id="hero-pixel-grid" class="absolute inset-0 opacity-40"></div>
        
        {{-- Subtle overlays for depth --}}
        <div class="absolute top-0 right-0 -mt-20 -mr-20 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-72 h-72 bg-indigo-500/10 rounded-full blur-3xl"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="mb-8 md:mb-0 md:w-1/2 text-center md:text-left">
                    <div class="inline-flex items-center gap-2 mb-6 px-4 py-1.5 bg-white/10 backdrop-blur-md rounded-full text-blue-100 uppercase tracking-widest text-[10px] font-black border border-white/10">
                        <i class="fa-solid fa-moon text-blue-200"></i> <span>{{ __('app.ramadan_reads') }}</span>
                    </div>
                    <h1 class="text-5xl md:text-6xl font-black leading-tight mb-6 tracking-tight drop-shadow-sm">
                        {{ __('app.hero_title') }}
                    </h1>
                    <p class="text-blue-100/80 text-lg mb-10 max-w-lg leading-relaxed font-medium">
                        {{ __('app.hero_desc') }}
                    </p>
                    <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                        <a href="#" class="inline-block px-10 py-4 bg-white text-blue-900 font-bold rounded-full hover:shadow-xl hover:-translate-y-0.5 transition duration-300">
                            {{ __('app.view_collection') }}
                        </a>
                        <a href="#" class="inline-block px-10 py-4 bg-transparent border-2 border-white/20 text-white font-bold rounded-full hover:bg-white/10 hover:border-white/40 transition duration-300">
                            Learn More
                        </a>
                    </div>
                </div>
                
                {{-- React PerspectiveBook for Hero --}}
                <div class="hidden lg:flex w-1/3 items-center justify-center relative ml-auto">
                    <div class="absolute inset-0 bg-blue-500/20 blur-3xl rounded-full pointer-events-none"></div>
                    <div id="hero-book-root"
                         data-cover="{{ asset('images/books/selamat-tinggal.jpg') }}"
                         data-title="Selamat Tinggal"
                         class="relative flex items-center justify-center min-h-[320px]">
                        {{-- Fallback while React loads --}}
                        <img src="{{ asset('images/books/selamat-tinggal.jpg') }}" alt="Selamat Tinggal"
                             class="w-48 h-auto rounded-xl shadow-2xl border-4 border-white/10 object-cover">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-16">

        @if(isset($searchResults))
            <!-- Search Results Section -->
            <section>
                <div class="flex justify-between items-end mb-6 border-b border-gray-100 pb-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                            <i class="fa-solid fa-magnifying-glass text-red-900"></i> {{ __('app.search_results') ?? 'Search Results' }}
                        </h2>
                        <p class="text-sm text-gray-500 mt-1">Found {{ $searchResults->count() }} books for "{{ $search }}"</p>
                    </div>
                    <a href="{{ url('/') }}" class="text-sm font-semibold text-red-900 hover:underline flex items-center gap-1">
                       <i class="fa-solid fa-xmark"></i> Clear Search
                    </a>
                </div>
                
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
                    @forelse ($searchResults as $book)
                    <a href="{{ route('books.show', ['id' => $book->id]) }}" class="group block animate-in fade-in slide-in-from-bottom-4 duration-500">
                        <div class="aspect-[2/3] bg-white shadow-sm rounded-xl overflow-hidden mb-3 relative group-hover:shadow-md transition border border-gray-100">
                             @if($book->cover_image && file_exists(public_path('images/books/' . $book->cover_image)))
                                <img src="{{ asset('images/books/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @else
                                <div class="w-full h-full bg-gray-100 flex items-center justify-center p-4 text-center">
                                    <span class="text-[10px] text-gray-400 font-bold uppercase">{{ $book->title }}</span>
                                </div>
                            @endif
                            <div class="absolute bottom-0 left-0 right-0 bg-red-900/90 text-white text-xs font-bold py-1 text-center translate-y-full group-hover:translate-y-0 transition duration-300">
                                {{ __('app.borrow') }}
                            </div>
                        </div>
                        <h3 class="font-semibold text-gray-900 text-sm leading-tight mb-1 truncate">{{ $book->title }}</h3>
                        <p class="text-xs text-gray-500 truncate">{{ $book->author }}</p>
                    </a>
                    @empty
                        <div class="col-span-full py-20 text-center">
                            <div class="text-gray-300 text-6xl mb-4 text-center mx-auto w-full"><i class="fa-solid fa-book-open"></i></div>
                            <p class="text-gray-500 font-medium">No books found matching your search.</p>
                            <p class="text-gray-400 text-sm mt-1">Try a different title, author, or keyword.</p>
                        </div>
                    @endforelse
                </div>
            </section>
        @else

        <!-- Just Added Section -->
        <section>
            <div class="flex justify-between items-end mb-6">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                    <i class="fa-solid fa-book-sparkles text-indigo-600"></i> {{ __('app.just_added') }}
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
                <a href="{{ route('books.show', ['id' => is_array($book) ? $book['id'] : $book->id]) }}" class="group block">
                    <div class="aspect-[2/3] bg-white shadow-sm rounded-xl overflow-hidden mb-3 relative group-hover:shadow-md transition border border-gray-100">
                        <img src="{{ asset('images/books/' . (is_array($book) ? $book['cover_image'] : $book->cover_image)) }}" alt="{{ is_array($book) ? $book['title'] : $book->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute bottom-0 left-0 right-0 bg-red-900/90 text-white text-xs font-bold py-1 text-center translate-y-full group-hover:translate-y-0 transition duration-300">
                            {{ __('app.borrow') }}
                        </div>
                    </div>
                    <h3 class="font-semibold text-gray-900 text-sm leading-tight mb-1 truncate">{{ is_array($book) ? $book['title'] : $book->title }}</h3>
                    <p class="text-xs text-gray-500 truncate">{{ is_array($book) ? $book['author'] : $book->author }}</p>
                </a>
                @endforeach
            @else
                @foreach ($justAddedBooks as $book)
                <a href="{{ route('books.show', ['id' => is_array($book) ? $book['id'] : $book->id]) }}" class="group block">
                    <div class="aspect-[2/3] bg-white shadow-sm rounded-xl overflow-hidden mb-3 relative group-hover:shadow-md transition border border-gray-100">
                        <img src="{{ asset('images/books/' . (is_array($book) ? $book['cover_image'] : $book->cover_image)) }}" alt="{{ is_array($book) ? $book['title'] : $book->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute bottom-0 left-0 right-0 bg-red-900/90 text-white text-xs font-bold py-1 text-center translate-y-full group-hover:translate-y-0 transition duration-300">
                            {{ __('app.borrow') }}
                        </div>
                    </div>
                    <h3 class="font-semibold text-gray-900 text-sm leading-tight mb-1 truncate">{{ is_array($book) ? $book['title'] : $book->title }}</h3>
                    <p class="text-xs text-gray-500 truncate">{{ is_array($book) ? $book['author'] : $book->author }}</p>
                </a>
                @endforeach
            @endif
            </div>
        </section>

        <!-- Recommended Books Section -->
        <section>
            <div class="flex justify-between items-end mb-6">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                    <i class="fa-solid fa-star text-yellow-400"></i> Buku Rekomendasi ✨
                </h2>
                <a href="#" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800">{{ __('app.view_all') }}</a>
            </div>
            
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
@if(!isset($recommendedBooks) || count($recommendedBooks) === 0)
                @php
                    $recommendedBooks = \App\Models\Book::where('author', 'Tere Liye')->take(6)->get();
                @endphp
                @if($recommendedBooks->isEmpty())
                @php
                    $recommendedBooks = [
                        ['title' => 'Nebula', 'author' => 'Tere Liye', 'cover_image' => 'tere-liye-1.jpg', 'id' => 26],
                        ['title' => 'Negeri di Ujung Tanduk', 'author' => 'Tere Liye', 'cover_image' => 'tere-liye-2.jpg', 'id' => 27],
                        ['title' => 'Cinta Antara Jakarta & Kuala Lumpur', 'author' => 'Tere Liye', 'cover_image' => 'tere-liye-3.jpg', 'id' => 28],
                        ['title' => 'Jengki', 'author' => 'Tere Liye', 'cover_image' => 'tere-liye-4.jpg', 'id' => 29],
                        ['title' => 'Sebelas', 'author' => 'Tere Liye', 'cover_image' => 'tere-liye-5.jpg', 'id' => 30],
                        ['title' => 'Selamat Tinggal', 'author' => 'Tere Liye', 'cover_image' => 'selamat-tinggal.jpg', 'id' => 31],
                    ];
                @endphp
                @endif
                @foreach ($recommendedBooks as $book)
                <a href="{{ route('books.show', ['id' => is_array($book) ? $book['id'] : $book->id]) }}" class="group block">
                    <div class="aspect-[2/3] bg-white shadow-sm rounded-xl overflow-hidden mb-3 relative group-hover:shadow-md transition border border-gray-100">
                        @php $cover = is_array($book) ? $book['cover_image'] : $book->cover_image; @endphp
                        @if($cover && file_exists(public_path('images/books/' . $cover)))
                            <img src="{{ asset('images/books/' . $cover) }}" alt="{{ is_array($book) ? $book['title'] : $book->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <div class="w-full h-full bg-gray-100 flex flex-col items-center justify-center p-4 text-center">
                                <span class="text-[10px] text-gray-500 font-bold uppercase mb-1">{{ is_array($book) ? $book['author'] : $book->author }}</span>
                                <span class="text-xs text-gray-800 font-extrabold">{{ is_array($book) ? $book['title'] : $book->title }}</span>
                            </div>
                        @endif
                        <div class="absolute bottom-0 left-0 right-0 bg-red-900/90 text-white text-xs font-bold py-1 text-center translate-y-full group-hover:translate-y-0 transition duration-300">
                            {{ __('app.borrow') }}
                        </div>
                    </div>
                    <h3 class="font-semibold text-gray-900 text-sm leading-tight mb-1 truncate">{{ is_array($book) ? $book['title'] : $book->title }}</h3>
                    <p class="text-xs text-gray-500 truncate">{{ is_array($book) ? $book['author'] : $book->author }}</p>
                </a>
                @endforeach
            @else
                @foreach ($recommendedBooks as $book)
                <a href="{{ route('books.show', ['id' => is_array($book) ? $book['id'] : $book->id]) }}" class="group block">
                    <div class="aspect-[2/3] bg-white shadow-sm rounded-xl overflow-hidden mb-3 relative group-hover:shadow-md transition border border-gray-100">
                        <img src="{{ asset('images/books/' . (is_array($book) ? $book['cover_image'] : $book->cover_image)) }}" alt="{{ is_array($book) ? $book['title'] : $book->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute bottom-0 left-0 right-0 bg-red-900/90 text-white text-xs font-bold py-1 text-center translate-y-full group-hover:translate-y-0 transition duration-300">
                            {{ __('app.borrow') }}
                        </div>
                    </div>
                    <h3 class="font-semibold text-gray-900 text-sm leading-tight mb-1 truncate">{{ is_array($book) ? $book['title'] : $book->title }}</h3>
                    <p class="text-xs text-gray-500 truncate">{{ is_array($book) ? $book['author'] : $book->author }}</p>
                </a>
                @endforeach
            @endif
            </div>
        </section>

        <!-- Mental Health Section -->
        <section>
            <div class="flex justify-between items-end mb-6">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                    <i class="fa-solid fa-brain text-emerald-500"></i> {{ __('Mental Health') }}
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
                <a href="{{ route('books.show', ['id' => is_array($book) ? $book['id'] : $book->id]) }}" class="group block">
                    <div class="book-3d-root mb-3" 
                         data-title="{{ is_array($book) ? $book['title'] : $book->title }}" 
                         data-color="#9D2127" 
                         data-textured="true"
                         data-variant="simple">
                    </div>
                    <h3 class="font-semibold text-gray-900 text-sm leading-tight mb-1 truncate">{{ is_array($book) ? $book['title'] : $book->title }}</h3>
                    <p class="text-xs text-gray-500 truncate">{{ is_array($book) ? $book['author'] : $book->author }}</p>
                </a>
                @endforeach
            @else
                @foreach ($mentalHealthBooks as $book)
                <a href="{{ route('books.show', ['id' => is_array($book) ? $book['id'] : $book->id]) }}" class="group block">
                    <div class="aspect-[2/3] bg-white shadow-sm overflow-hidden mb-3 relative group-hover:shadow-md transition border border-gray-100">
                        <img src="{{ asset('images/books/' . (is_array($book) ? $book['cover_image'] : $book->cover_image)) }}" alt="{{ is_array($book) ? $book['title'] : $book->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute bottom-0 left-0 right-0 bg-red-900/90 text-white text-xs font-bold py-1 text-center translate-y-full group-hover:translate-y-0 transition duration-300">
                            {{ __('app.borrow') }}
                        </div>
                    </div>
                    <h3 class="font-semibold text-gray-900 text-sm leading-tight mb-1 truncate">{{ is_array($book) ? $book['title'] : $book->title }}</h3>
                    <p class="text-xs text-gray-500 truncate">{{ is_array($book) ? $book['author'] : $book->author }}</p>
                </a>
                @endforeach
            @endif
            </div>
        </section>

        <!-- Korean Literature Section -->
        <section>
            <div class="flex justify-between items-end mb-6">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                    <i class="fa-solid fa-earth-asia text-red-500"></i> {{ __('Korean Literature') }}
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
                <a href="{{ route('books.show', ['id' => is_array($book) ? $book['id'] : $book->id]) }}" class="group block">
                    <div class="book-3d-root mb-3" 
                         data-title="{{ is_array($book) ? $book['title'] : $book->title }}" 
                         data-color="#FED954" 
                         data-textured="true"
                         data-variant="stripe">
                    </div>
                    <h3 class="font-semibold text-gray-900 text-sm leading-tight mb-1 truncate">{{ is_array($book) ? $book['title'] : $book->title }}</h3>
                    <p class="text-xs text-gray-500 truncate">{{ is_array($book) ? $book['author'] : $book->author }}</p>
                </a>
                @endforeach
            @else
                @foreach ($koreanBooks as $book)
                <a href="{{ route('books.show', ['id' => is_array($book) ? $book['id'] : $book->id]) }}" class="group block">
                    <div class="aspect-[2/3] bg-white shadow-sm rounded-xl overflow-hidden mb-3 relative group-hover:shadow-md transition border border-gray-100">
                        <img src="{{ asset('images/books/' . (is_array($book) ? $book['cover_image'] : $book->cover_image)) }}" alt="{{ is_array($book) ? $book['title'] : $book->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute bottom-0 left-0 right-0 bg-red-900/90 text-white text-xs font-bold py-1 text-center translate-y-full group-hover:translate-y-0 transition duration-300">
                            {{ __('app.borrow') }}
                        </div>
                    </div>
                    <h3 class="font-semibold text-gray-900 text-sm leading-tight mb-1 truncate">{{ is_array($book) ? $book['title'] : $book->title }}</h3>
                    <p class="text-xs text-gray-500 truncate">{{ is_array($book) ? $book['author'] : $book->author }}</p>
                </a>
                @endforeach
            @endif
            </div>
        </section>
        @endif

    </main>

    <!-- Footer -->
    <x-footer />

    <!-- Alpine.js for dropdown -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</body>
</html>