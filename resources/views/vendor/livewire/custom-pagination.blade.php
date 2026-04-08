@if ($paginator->hasPages())
<div class="flex items-center justify-center gap-2 py-2">

    {{-- Previous Button --}}
    @if ($paginator->onFirstPage())
        <span class="mr-4 opacity-30 cursor-not-allowed" aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
            <svg width="9" height="16" viewBox="0 0 12 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 1L2 9.24242L11 17" stroke="#111820" stroke-opacity="0.7" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </span>
    @else
        <button
            wire:click="previousPage"
            wire:loading.attr="disabled"
            class="mr-4 hover:opacity-60 transition-opacity active:scale-95"
            aria-label="{{ __('pagination.previous') }}"
        >
            <svg width="9" height="16" viewBox="0 0 12 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 1L2 9.24242L11 17" stroke="#111820" stroke-opacity="0.7" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </button>
    @endif

    {{-- Page Numbers --}}
    <div class="flex gap-2 text-gray-500 text-sm md:text-base">
        @foreach ($elements as $element)
            {{-- Dots / Ellipsis --}}
            @if (is_string($element))
                <span class="flex items-center justify-center w-9 md:w-10 h-9 md:h-10 text-gray-400 select-none">
                    {{ $element }}
                </span>
            @endif

            {{-- Page Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span
                            aria-current="page"
                            class="flex items-center justify-center active:scale-95 w-9 md:w-10 h-9 md:h-10 aspect-square bg-indigo-500 text-white rounded-md font-medium select-none"
                        >{{ $page }}</span>
                    @else
                        <button
                            wire:click="gotoPage({{ $page }})"
                            wire:loading.attr="disabled"
                            class="flex items-center justify-center active:scale-95 w-9 md:w-10 h-9 md:h-10 aspect-square bg-white border border-gray-200 rounded-md hover:bg-gray-100/70 transition-all"
                        >{{ $page }}</button>
                    @endif
                @endforeach
            @endif
        @endforeach
    </div>

    {{-- Next Button --}}
    @if ($paginator->hasMorePages())
        <button
            wire:click="nextPage"
            wire:loading.attr="disabled"
            class="ml-4 hover:opacity-60 transition-opacity active:scale-95"
            aria-label="{{ __('pagination.next') }}"
        >
            <svg width="9" height="16" viewBox="0 0 12 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1L10 9.24242L1 17" stroke="#111820" stroke-opacity="0.7" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </button>
    @else
        <span class="ml-4 opacity-30 cursor-not-allowed" aria-disabled="true" aria-label="{{ __('pagination.next') }}">
            <svg width="9" height="16" viewBox="0 0 12 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1L10 9.24242L1 17" stroke="#111820" stroke-opacity="0.7" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </span>
    @endif

</div>
@endif
