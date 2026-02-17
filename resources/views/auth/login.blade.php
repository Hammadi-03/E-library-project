<x-guest-layout>
    <div class="flex min-h-screen bg-gray-50">
        <!-- Left Side: Login Form -->
        <div class="w-full md:w-1/2 flex flex-col justify-center px-8 sm:px-12 lg:px-24 bg-white">
            <div class="sm:mx-auto sm:w-full sm:max-w-md mb-10">
                <a href="/" class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-indigo-900 rounded-lg flex items-center justify-center text-white font-bold text-sm">QNL</div>
                     <span class="font-bold text-2xl text-gray-900">Qatar National Library</span>
                </a>
                <h2 class="mt-8 text-3xl font-extrabold text-gray-900">
                    Welcome!
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Please sign in below to borrow content.
                </p>
            </div>

            <div class="sm:mx-auto sm:w-full sm:max-w-md">
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Barcode / Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Barcode</label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" autocomplete="email" required 
                                class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                value="{{ old('email') }}">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- PIN / Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">PIN</label>
                        <div class="mt-1 relative">
                            <input id="password" name="password" type="password" autocomplete="current-password" required
                                class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                                Remember me
                            </label>
                        </div>

                         @if (Route::has('password.request'))
                        <div class="text-sm">
                            <a href="{{ route('password.request') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                                Forgot PIN?
                            </a>
                        </div>
                        @endif
                    </div>

                    <div>
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                            Sign In
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Side: Illustration -->
        <div class="hidden md:block w-1/2 bg-pink-100 relative overflow-hidden">
            <!-- Decorative Background Elements -->
             <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-50"></div>
             <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-indigo-200 rounded-full mix-blend-multiply filter blur-xl opacity-50"></div>
            
            <div class="flex items-center justify-center h-full relative z-10 p-12">
                 <!-- Placeholder for Illustration -->
                 <div class="text-center">
                     <div class="inline-block p-8 bg-white/50 backdrop-blur-md rounded-2xl shadow-xl">
                        <div class="text-6xl mb-4">📚</div>
                         <h3 class="text-2xl font-bold text-gray-800 mb-2">Digital Library</h3>
                         <p class="text-gray-600">Access thousands of books anywhere, anytime.</p>
                     </div>
                 </div>
            </div>
        </div>
    </div>
</x-guest-layout>
