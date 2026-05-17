@props(['active', 'icon'])

@php
$classes = ($active ?? false)
            ? 'flex items-center px-3 py-2 rounded-xl bg-zinc-950 dark:bg-white text-white dark:text-zinc-950 font-bold transition-all duration-300 shadow-lg group'
            : 'flex items-center px-3 py-2 rounded-xl text-zinc-500 hover:text-zinc-900 dark:hover:text-white hover:bg-zinc-200 dark:hover:bg-zinc-900 font-semibold transition-all duration-300 group';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}" />
    </svg>
    <span 
        x-show="expanded" 
        x-transition:enter="transition ease-out duration-300 delay-75"
        x-transition:enter-start="opacity-0 translate-x-2"
        x-transition:enter-end="opacity-100 translate-x-0"
        class="ml-3 truncate overflow-hidden whitespace-nowrap"
    >
        {{ $slot }}
    </span>
</a>
