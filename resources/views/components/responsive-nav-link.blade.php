@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-red-900 text-start text-base font-medium text-red-900 bg-red-50 focus:outline-none focus:text-red-900 focus:bg-red-100 focus:border-red-900 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-red-900 hover:bg-red-50 hover:border-red-900 focus:outline-none focus:text-red-900 focus:bg-red-50 focus:border-red-900 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
