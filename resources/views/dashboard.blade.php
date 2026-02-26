@section('title', 'Home | Qatar National Library')

<div>
    <!-- Hero Section (Authenticated) -->
    <div class="bg-emerald-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="mb-8 md:mb-0 md:w-1/2">
                    <div class="flex items-center gap-2 mb-4 text-emerald-200 uppercase tracking-wide text-sm font-bold">
                        <span>🌙</span> <span>{{ __('app.ramadan_reads') }}</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-4">
                        {{ __('app.welcome_back') }} {{ Auth::user()->name }}!
                    </h1>
                    <p class="text-emerald-100 text-lg mb-8 max-w-lg">
                        Continue your reading journey. You have 2 {{ __('app.books_due_soon') }}
                    </p>
                    <div class="flex gap-4">
                         <a href="#" class="inline-block px-8 py-3 bg-white text-emerald-900 font-bold rounded-full hover:bg-emerald-50 transition">
                            {{ __('app.browse_collection') }}
                        </a>
                        <a href="{{ route('profile.edit') }}" class="inline-block px-8 py-3 border-2 border-white text-white font-bold rounded-full hover:bg-white/10 transition">
                            {{ __('app.my_account') }}
                        </a>
                    </div>
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
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

            <!-- My Loans (Simulated) -->
             <section>
                <div class="flex justify-between items-end mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                        <span class="text-indigo-600">📖</span> {{ __('app.your_loans') }}
                    </h2>
                     <a href="#" class="text-sm font-semibold text-black hover:text-red-900">{{ __('app.view_all') }}</a>
                </div>
                
                 <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
                    @for ($i = 0; $i < 3; $i++)
                    <div class="group">
                        <div class="aspect-[2/3] bg-gray-200 shadow-sm overflow-hidden mb-3 relative group-hover:shadow-md transition">
                            <div class="w-full h-full bg-gradient-to-br from-indigo-50 to-indigo-100 flex items-center justify-center text-indigo-300">
                                Cover
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 bg-yellow-600/90 text-white text-xs font-bold py-1 text-center">
                                {{ __('app.due_in_days', ['days' => 2]) }}
                            </div>
                        </div>
                        <h3 class="font-semibold text-gray-900 text-sm leading-tight mb-1 truncate">Borrowed Book {{ $i+1 }}</h3>
                         <button class="text-xs text-black hover:text-red-900 font-medium">{{ __('app.renew') }}</button>
                    </div>
                    @endfor
                </div>
            </section>

             <!-- Recommended For You -->
            <section>
                <div class="flex justify-between items-end mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                        <span class="text-pink-500">✨</span> {{ __('app.recommended') }}
                    </h2>
                    <a href="#" class="text-sm font-semibold text-black hover:text-red-900">{{ __('app.view_all') }}</a>
                </div>
                
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
                    @for ($i = 0; $i < 6; $i++)
                    <div class="group">
                        <div class="aspect-[2/3] bg-gray-200 shadow-sm overflow-hidden mb-3 relative group-hover:shadow-md transition">
                            <div class="w-full h-full bg-gradient-to-br from-pink-50 to-pink-100 flex items-center justify-center text-pink-300">
                                Cover
                            </div>
                        </div>
                        <h3 class="font-semibold text-gray-900 text-sm leading-tight mb-1 truncate">Recommended Title {{ $i+1 }}</h3>
                        <p class="text-xs text-gray-500 truncate">Author Name</p>
                    </div>
                    @endfor
                </div>
            </section>

        </div>
    </div>
      <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 border-t border-gray-800 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                     <div class="flex items-center gap-2 mb-4 text-white">
                        <img src="{{ asset('svgviewer-png-output.png') }}" class="h-14 w-auto" alt="Qatar National Library">
                    </div>
                    <p class="text-sm text-gray-400 max-w-sm">
                        {{ __('app.footer_desc') }}
                    </p>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">{{ __('app.my_account') }}</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white">{{ __('app.sign_in') }}</a></li>
                        <li><a href="#" class="hover:text-white">{{ __('app.need_card') }}</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">{{ __('app.support') }}</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white">{{ __('app.help') }}</a></li>
                        <li><a href="#" class="hover:text-white">{{ __('app.get_support') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-800 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} Qatar National Library. {{ __('app.all_rights') }}
            </div>
        </div>
    </footer>
</div>