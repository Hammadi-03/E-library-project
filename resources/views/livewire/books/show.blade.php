<div class="py-12 bg-white min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Breadcrumbs (optional but good) --}}
        <nav class="flex mb-8 text-sm text-gray-500" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="/" class="hover:text-red-900 transition underline underline-offset-4">Home</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ml-1 md:ml-2 text-gray-700 font-medium">{{ $book->title }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col lg:flex-row gap-12">
            
            {{-- Left Side: Cover --}}
            <div class="lg:w-1/3 shrink-0">
                <div class="sticky top-24">
                    <div class="bg-white p-4 shadow-xl border border-gray-100 rounded-sm">
                        <img src="{{ Str::startsWith($book->cover_image, 'http') ? $book->cover_image : asset('images/books/' . ($book->cover_image ?? 'default.jpg')) }}" 
                             alt="{{ $book->title }}" 
                             class="w-full h-auto object-cover rounded-sm">
                    </div>
                </div>
            </div>

            {{-- Center: Info --}}
            <div class="lg:w-1/2 flex-1">
                <div class="border-b border-gray-100 pb-8 mb-8">
                    <h1 class="text-4xl font-serif font-bold text-gray-900 mb-2 leading-tight">
                        {{ $book->title }}
                    </h1>
                    <p class="text-xl text-gray-600 mb-4 font-light">A Novel</p>
                    <div class="flex flex-col gap-1 mb-6 text-sm">
                        <p class="text-gray-500">by <span class="text-blue-600 hover:underline cursor-pointer font-medium">{{ $book->author }}</span></p>
                        <p class="text-gray-400">Anna Moschovakis (Translator)</p>
                    </div>

                    <div class="flex items-center gap-2 mb-8 uppercase tracking-widest text-xs font-bold text-gray-600">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        EBOOK
                    </div>

                    <div class="flex items-center gap-2 text-sm text-gray-700 bg-gray-50 px-4 py-2 rounded-md w-fit mb-8 border border-gray-100">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="font-medium">1 of 1 copy available</span>
                    </div>

                    <div class="flex flex-wrap gap-4 mb-4">
                        <button class="flex items-center gap-2 px-6 py-2 border border-gray-300 rounded-full text-xs font-bold uppercase tracking-wider text-gray-700 hover:bg-gray-50 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Add to Wish List
                        </button>
                        <button class="flex items-center gap-2 px-6 py-2 border border-gray-300 rounded-full text-xs font-bold uppercase tracking-wider text-gray-700 hover:bg-gray-50 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Add to History
                        </button>
                    </div>
                </div>

                <div class="prose prose-blue max-w-none">
                    <div class="mt-2 pt-2 border-t border-gray-100 text-gray-700 leading-relaxed text-[16px] font-serif">
                        {{ $book->description }}
                    </div>
                </div>
            </div>

            {{-- Right Side: Sidebar --}}
            <div class="lg:w-64 space-y-10 pl-0 lg:pl-6 lg:border-l lg:border-gray-100">

                <div>
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-4 border-b border-gray-100 pb-2">Subjects</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($book->subjects ?? [] as $subject)
                            <span class="px-4 py-1.5 border border-gray-200 rounded-full text-[10px] uppercase font-bold text-gray-600 hover:bg-indigo-50 hover:text-indigo-700 hover:border-indigo-200 cursor-pointer transition tracking-wider">{{ $subject }}</span>
                        @endforeach
                    </div>
                </div>

                <div>
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-4 border-b border-gray-100 pb-2">Languages</h3>
                    <p class="text-sm text-gray-800 font-medium">{{ $book->lang ?? 'English' }}</p>
                </div>

            </div>

        </div>

    </div>
</div>
