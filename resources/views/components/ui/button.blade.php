@props(['variant' => 'default', 'size' => 'default'])

@php
    $variants = [
        'default' => 'bg-zinc-900 text-zinc-50 hover:bg-zinc-900/90 shadow',
        'secondary' => 'bg-zinc-100 text-zinc-900 hover:bg-zinc-100/80',
        'outline' => 'border border-zinc-200 bg-white hover:bg-zinc-100 hover:text-zinc-900',
        'ghost' => 'hover:bg-zinc-100 hover:text-zinc-900',
        'destructive' => 'bg-red-500 text-zinc-50 hover:bg-red-500/90 shadow-sm',
        'link' => 'text-zinc-900 underline-offset-4 hover:underline',
    ];
    $sizes = [
        'default' => 'h-9 px-4 py-2',
        'sm' => 'h-8 rounded-md px-3 text-xs',
        'lg' => 'h-10 rounded-md px-8',
        'icon' => 'h-9 w-9',
    ];
    $classes =
        'inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-zinc-950 disabled:pointer-events-none disabled:opacity-50 cursor-pointer ' .
        ($variants[$variant] ?? $variants['default']) .
        ' ' .
        ($sizes[$size] ?? $sizes['default']);
@endphp

@if ($attributes->has('href'))
    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
