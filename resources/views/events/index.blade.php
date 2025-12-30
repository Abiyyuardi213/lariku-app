@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold tracking-tight">Events</h2>
                <p class="text-zinc-500">Daftar race impian dan yang sudah terdaftar.</p>
            </div>
            <x-ui.button href="{{ route('events.create') }}">Add Event</x-ui.button>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($events as $event)
                <a href="{{ route('events.show', $event) }}" class="group block">
                    <x-ui.card class="h-full transition-shadow hover:shadow-md">
                        <div class="p-6 space-y-4">
                            <div class="flex justify-between items-start">
                                <div class="space-y-1">
                                    <h3 class="font-bold text-lg leading-none group-hover:text-zinc-700">{{ $event->name }}
                                    </h3>
                                    <p class="text-sm text-zinc-500">{{ $event->location }}</p>
                                </div>
                                <x-ui.badge
                                    variant="{{ $event->status === 'registered' ? 'default' : ($event->status === 'done' ? 'secondary' : 'outline') }}">
                                    {{ ucfirst($event->status) }}
                                </x-ui.badge>
                            </div>

                            <div class="grid grid-cols-2 gap-4 py-2">
                                <div>
                                    <p class="text-xs text-zinc-500 uppercase font-semibold">Date</p>
                                    <p class="text-sm font-medium">{{ $event->event_date->format('d M Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-zinc-500 uppercase font-semibold">Distance</p>
                                    <p class="text-sm font-medium">{{ $event->distance_category }}</p>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-2 border-t border-zinc-100">
                                <span
                                    class="text-xs font-medium text-zinc-400 uppercase tracking-wider">{{ $event->type }}</span>
                                <span class="text-xs text-zinc-400 self-end">View Details &rarr;</span>
                            </div>
                        </div>
                    </x-ui.card>
                </a>
            @empty
                <div class="col-span-full py-12 text-center">
                    <p class="text-zinc-500">Belum ada event.</p>
                    <x-ui.button class="mt-4" href="{{ route('events.create') }}">Buat Event Pertama</x-ui.button>
                </div>
            @endforelse
        </div>
    </div>
@endsection
