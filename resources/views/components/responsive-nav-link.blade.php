@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-white text-start text-base font-medium text-white bg-indigo-500/50 focus:outline-none focus:text-white focus:bg-indigo-500/50 focus:border-white transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-indigo-200 hover:text-white hover:bg-indigo-500/50 hover:border-indigo-300 focus:outline-none focus:text-white focus:bg-indigo-500/50 focus:border-indigo-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
