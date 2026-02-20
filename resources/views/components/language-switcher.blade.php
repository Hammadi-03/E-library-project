{{-- Reusable Language Switcher Dropdown --}}
<div class="relative" x-data="{ open: false }">
    <button @click="open = !open"
        class="flex items-center gap-1.5 text-sm font-medium text-gray-600 hover:text-red-900 border border-gray-200 rounded-full px-3 py-1.5 hover:border-red-200 transition bg-white">
        @if(app()->getLocale() === 'id') 🇮🇩
        @elseif(app()->getLocale() === 'en') 🇬🇧
        @elseif(app()->getLocale() === 'ar') 🇸🇦
        @else 🌐
        @endif
        <span class="uppercase font-semibold">{{ app()->getLocale() }}</span>
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    <div x-show="open"
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         @click.away="open = false"
         class="absolute right-0 mt-2 w-44 bg-white rounded-xl shadow-lg border border-gray-100 py-1 z-50">
        <a href="{{ route('lang.switch', 'id') }}"
            class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-900 transition {{ app()->getLocale() === 'id' ? 'font-bold text-red-900 bg-red-50' : '' }}">
            🇮🇩 <span>Indonesia</span>
            @if(app()->getLocale() === 'id')
                <svg class="w-4 h-4 ml-auto text-red-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            @endif
        </a>
        <a href="{{ route('lang.switch', 'en') }}"
            class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-900 transition {{ app()->getLocale() === 'en' ? 'font-bold text-red-900 bg-red-50' : '' }}">
            🇬🇧 <span>English</span>
            @if(app()->getLocale() === 'en')
                <svg class="w-4 h-4 ml-auto text-red-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            @endif
        </a>
        <a href="{{ route('lang.switch', 'ar') }}"
            class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-900 transition {{ app()->getLocale() === 'ar' ? 'font-bold text-red-900 bg-red-50' : '' }}">
            🇸🇦 <span>العربية</span>
            @if(app()->getLocale() === 'ar')
                <svg class="w-4 h-4 ml-auto text-red-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            @endif
        </a>
    </div>
</div>
