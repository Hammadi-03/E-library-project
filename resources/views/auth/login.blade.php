@section('title', 'Login - Qatar National Library')

<x-guest-layout>
    <div class="flex min-h-screen bg-white">
        <!-- Left Side: Login Form -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-8 lg:p-12">
            <div class="w-full max-w-md space-y-8">
                <!-- Header -->
                <div class="mb-10">
                    <a href="/" class="block mb-8">
                        <x-application-logo class="h-16 w-auto" />
                    </a>
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">Welcome!</h1>
                    <p class="text-gray-500 text-lg">Please sign in below to borrow content.</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email/Barcode -->
                    <div>
                        <x-input-label for="email" :value="__('EMail')" class="sr-only" />
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">EMail</label>
                        <x-text-input id="email" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4" 
                                        type="email" 
                                        name="email" 
                                        :value="old('email')" 
                                        required 
                                        autofocus 
                                        autocomplete="username" 
                                        placeholder="" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- PIN/Password -->
                    <div class="relative">
                        <x-input-label for="password" :value="__('PIN')" class="sr-only" />
                         <label for="password" class="block text-sm font-medium text-gray-700 mb-1">PIN</label>
                        <x-text-input id="password" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4" 
                                        type="password" 
                                        name="password" 
                                        required 
                                        autocomplete="current-password" 
                                        placeholder="" />
                        <button type="button" onclick="togglePassword()" class="absolute right-0 top-0 mt-9 mr-4 text-gray-400 hover:text-gray-600 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Sign In Button -->
                    <div>
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors duration-200">
                            Sign in
                        </button>
                    </div>
                </form>
                
                <div class="text-right">
                     <a href="#" class="text-sm text-gray-500 hover:text-gray-900">Help</a>
                </div>

            </div>
        </div>

        <!-- Right Side: Illustration -->
        <div class="hidden md:flex md:w-1/2 bg-gray-50 items-center justify-center p-12 relative overflow-hidden">
             <!-- Background Shape -->
             <div class="absolute inset-0 z-0">
                 <!-- You might want to use a specific background image or SVG blob here if needed to match perfectly -->
            </div>
            
            <div class="relative z-10 w-full max-w-lg">
                <img src="{{ asset('images/favicon.png') }}" alt="Library Illustration" class="w-full h-auto object-contain">
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</x-guest-layout>
