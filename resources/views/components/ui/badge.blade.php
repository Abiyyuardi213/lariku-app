@props(['variant' => 'default'])
@php
    $variants = [
        'default' => 'border-transparent bg-zinc-900 text-zinc-50 shadow hover:bg-zinc-900/80',
        'secondary' => 'border-transparent bg-zinc-100 text-zinc-900 hover:bg-zinc-100/80',
        'outline' => 'text-zinc-950 border-zinc-200',
        'destructive' => 'border-transparent bg-red-500 text-white shadow hover:bg-red-500/80',
    ];
@endphp
<div
    {{ $attributes->merge(['class' => 'inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-zinc-950 focus:ring-offset-2 ' . ($variants[$variant] ?? $variants['default'])]) }}>
    {{ $slot }}
</div>
