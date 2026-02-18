<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Qatar National Library @yield('title')</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
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
                        <img src="{{ asset('Frame 33863.jpg') }}" class="h-12 w-auto" alt="Qatar National Library">
                    </a>
                </div>

                <!-- Navigation & Search -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="text-sm font-medium text-gray-700 hover:text-red-900">Subjects</a>
                    <a href="#" class="text-sm font-medium text-gray-700 hover:text-red-900">Collections</a>
                </div>

                <!-- Search Bar -->
                <div class="flex-1 max-w-lg mx-8 hidden lg:block">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-full leading-5 [bg-gray-50 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-red-900 focus:ring-1 focus:ring-red-900 sm:text-sm" placeholder="Search">
                    </div>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-700 hover:text-red-900">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-red-900 mr-4">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-2 border border-transparent rounded-full shadow-sm text-sm font-medium text-white bg-black hover:bg-red-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Sign up
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
                        <span>🌙</span> <span>Ramadan Reads | Bacaan Ramadan</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-4">
                        Discover Spiritual <br> & Reflective Books
                    </h1>
                    <p class="text-emerald-100 text-lg mb-8 max-w-lg">
                        Explore our curated collection of books perfect for the holy month. Find peace, knowledge, and inspiration.
                    </p>
                    <a href="#" class="inline-block px-8 py-3 bg-white text-emerald-900 font-bold rounded-full hover:bg-emerald-50 transition">
                        View Collection
                    </a>
                </div>
                <!-- Hero Image Placeholder -->
                <div class="md:w-1/2 flex justify-center">
                    <div class="grid grid-cols-3 gap-4 transform rotate-3">
                         <div class="bg-white/10 p-2 rounded shadow-lg w-32 h-48"></div>
                         <div class="bg-white/20 p-2 rounded shadow-lg w-32 h-48 -mt-8"></div>
                         <div class="bg-white/10 p-2 rounded shadow-lg w-32 h-48"></div>
                    </div>
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
                    <span class="text-indigo-600">📔</span> Just Added
                </h2>
                <a href="#" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800">View All &rarr;</a>
            </div>
            
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
                <!-- Book Items (Loop Placeholder) -->
                @for ($i = 0; $i < 6; $i++)
                <div class="group">
                    <div class="aspect-[2/3] bg-gray-200 rounded-lg shadow-sm overflow-hidden mb-3 relative group-hover:shadow-md transition">
                        <!-- Placeholder Cover -->
                        <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center text-gray-400">
                             Cover
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 bg-indigo-900/90 text-white text-xs font-bold py-1 text-center translate-y-full group-hover:translate-y-0 transition duration-300">
                            BORROW
                        </div>
                    </div>
                    <h3 class="font-semibold text-gray-900 text-sm leading-tight mb-1 truncate">Book Title {{ $i+1 }}</h3>
                    <p class="text-xs text-gray-500 truncate">Author Name</p>
                </div>
                @endfor
            </div>
        </section>

        <!-- Trending Section -->
        <section>
            <div class="flex justify-between items-end mb-6">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                    <span class="text-orange-500"></span>The 2016 Era 📚
                </h2>
                <a href="#" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800">View All &rarr;</a>
            </div>
            
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
                 @for ($i = 0; $i < 6; $i++)
                <div class="group">
                    <div class="aspect-[2/3] bg-gray-200 rounded-lg shadow-sm overflow-hidden mb-3 relative group-hover:shadow-md transition">
                         <div class="w-full h-full bg-gradient-to-br from-orange-50 to-orange-100 flex items-center justify-center text-orange-300">
                             Cover
                        </div>
                         <div class="absolute bottom-0 left-0 right-0 bg-indigo-900/90 text-white text-xs font-bold py-1 text-center translate-y-full group-hover:translate-y-0 transition duration-300">
                            BORROW
                        </div>
                    </div>
                    <h3 class="font-semibold text-gray-900 text-sm leading-tight mb-1 truncate">Trending Book {{ $i+1 }}</h3>
                    <p class="text-xs text-gray-500 truncate">Famous Author</p>
                </div>
                @endfor
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 border-t border-gray-800 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                     <div class="flex items-center gap-2 mb-4 text-white">
                        <img src="{{ asset('svgviewer-png-output.png') }}" class="h-14 w-auto" alt="Qatar National Library">
                    </div>
                    <p class="text-sm text-gray-400 max-w-sm">
                        Digital library connection. Borrow ebooks, audiobooks, and more from your local library for free!
                    </p>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">My account</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white">Sign in</a></li>
                        <li><a href="#" class="hover:text-white">Need a library card?</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Support</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white">Help</a></li>
                        <li><a href="#" class="hover:text-white">Get support</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-800 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} Qatar National Library. All rights reserved.
            </div>
        </div>
    </footer>

</body>
</html>
