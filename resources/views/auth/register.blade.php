<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-white py-12">
        <div class="w-full max-w-2xl">
            {{-- Header --}}
            <div class="bg-[#e8e4df] py-6 px-8 text-center border-b border-gray-300">
                <h1 class="text-3xl font-serif text-gray-800 tracking-wide">Public Services Portal</h1>
                <p class="text-sm text-[#7b2d3b] mt-1 font-medium">Welcome; Create new account</p>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('register') }}" class="px-8 py-6 bg-white">
                @csrf

                {{-- Name --}}
                <div class="flex items-center py-3 border-b border-gray-200">
                    <label for="name" class="w-44 text-sm text-[#7b2d3b] shrink-0">Name</label>
                    <div class="flex-1">
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                               class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#7b2d3b] focus:border-[#7b2d3b]" />
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>
                </div>

                {{-- Date of Birth --}}
                <div class="flex items-center py-3 border-b border-gray-200">
                    <label for="date_of_birth" class="w-44 text-sm text-[#7b2d3b] shrink-0">Date of birth</label>
                    <div class="flex-1">
                        <input id="date_of_birth" type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" required
                               class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#7b2d3b] focus:border-[#7b2d3b]" />
                        <x-input-error :messages="$errors->get('date_of_birth')" class="mt-1" />
                    </div>
                </div>

                {{-- Email --}}
                <div class="flex items-center py-3 border-b border-gray-200">
                    <label for="email" class="w-44 text-sm text-[#7b2d3b] shrink-0">Email</label>
                    <div class="flex-1">
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                               class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#7b2d3b] focus:border-[#7b2d3b]" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>
                </div>

                {{-- Password --}}
                <div class="flex items-center py-3 border-b border-gray-200">
                    <label for="password" class="w-44 text-sm text-[#7b2d3b] shrink-0">Password</label>
                    <div class="flex-1">
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                               class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#7b2d3b] focus:border-[#7b2d3b]" />
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>
                </div>

                {{-- Confirm Password --}}
                <div class="flex items-center py-3 border-b border-gray-200">
                    <label for="password_confirmation" class="w-44 text-sm text-[#7b2d3b] shrink-0">Confirm Password</label>
                    <div class="flex-1">
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                               class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#7b2d3b] focus:border-[#7b2d3b]" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                    </div>
                </div>

                {{-- reCAPTCHA (hidden from layout but still functional) --}}
                <div class="mt-4">
                    <div class="g-recaptcha" data-sitekey="6Lc5v3QsAAAAACqzZs8iTw9SxOR31Wu3AfJG9QeA"></div>
                    <x-input-error :messages="$errors->get('captcha')" class="mt-1" />
                </div>

                {{-- Actions --}}
                <div class="flex items-center justify-between mt-6">
                    <button type="submit"
                            class="px-6 py-2 bg-[#6b1d2a] text-white text-sm font-semibold rounded hover:bg-[#551622] transition-colors duration-200">
                        Next
                    </button>

                    <a class="text-sm text-gray-500 hover:text-gray-700 underline" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
