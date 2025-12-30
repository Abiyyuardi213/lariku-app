@extends('layouts.app')

@section('content')
    <div class="space-y-8">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-bold tracking-tight">Dashboard</h2>
            <div class="flex items-center space-x-2">
                <x-ui.button href="{{ route('events.create') }}">Create Event</x-ui.button>
            </div>
        </div>

        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
            <x-ui.card class="p-6">
                <div class="flex flex-row items-center justify-between space-y-0 pb-2">
                    <h3 class="tracking-tight text-sm font-medium">Total Estimasi Budget</h3>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="h-4 w-4 text-zinc-500">
                        <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                    </svg>
                </div>
                <div class="text-2xl font-bold">Rp {{ number_format($totalEstimated, 0, ',', '.') }}</div>
                <p class="text-xs text-zinc-500">Untuk semua event wishlist & registered</p>
            </x-ui.card>
            <x-ui.card class="p-6">
                <div class="flex flex-row items-center justify-between space-y-0 pb-2">
                    <h3 class="tracking-tight text-sm font-medium">Budget Terpakai</h3>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="h-4 w-4 text-zinc-500">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                        <circle cx="8.5" cy="7" r="4" />
                        <line x1="20" x2="23" y1="8" y2="11" />
                        <line x1="23" x2="20" y1="8" y2="11" />
                    </svg>
                </div>
                <div class="text-2xl font-bold">Rp {{ number_format($totalActual, 0, ',', '.') }}</div>
                <p class="text-xs text-zinc-500">
                    @if ($totalEstimated > 0)
                        {{ number_format(($totalActual / $totalEstimated) * 100, 1) }}% dari estimasi
                    @else
                        0%
                    @endif
                </p>
            </x-ui.card>
        </div>

        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-7">
            <!-- Upcoming Events -->
            <x-ui.card class="col-span-4">
                <div class="p-6 pb-3">
                    <div class="flex items-center justify-between">
                        <h3 class="font-semibold leading-none tracking-tight">Upcoming Events</h3>
                        <a href="{{ route('events.index') }}" class="text-sm text-zinc-500 hover:text-zinc-900">View All</a>
                    </div>
                </div>
                <div class="p-6 pt-0">
                    @if ($upcomingEvents->count() > 0)
                        <div class="space-y-4">
                            @foreach ($upcomingEvents as $event)
                                <div
                                    class="flex items-center justify-between p-4 border border-zinc-100 rounded-lg hover:bg-zinc-50 transition-colors">
                                    <div class="space-y-1">
                                        <p class="text-sm font-medium leading-none">{{ $event->name }}</p>
                                        <p class="text-xs text-zinc-500">{{ $event->event_date->format('d M Y') }} •
                                            {{ $event->location }}</p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <x-ui.badge
                                            variant="{{ $event->type === 'trail' ? 'default' : 'secondary' }}">{{ strtoupper($event->type) }}</x-ui.badge>
                                        <div class="text-sm font-bold">{{ $event->distance_category }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="py-8 text-center text-zinc-500 text-sm">Belum ada event yang didaftarkan.</div>
                    @endif
                </div>
            </x-ui.card>

            <!-- Next Training -->
            <x-ui.card class="col-span-3">
                <div class="p-6 pb-3">
                    <h3 class="font-semibold leading-none tracking-tight">Next Training</h3>
                </div>
                <div class="p-6 pt-0 h-full">
                    @if ($nextTraining)
                        <div class="flex flex-col h-full justify-center space-y-4 rounded-lg bg-zinc-950 p-6 text-zinc-50">
                            <div class="space-y-1">
                                <span class="text-xs text-zinc-400 capitalize">{{ $nextTraining->type }} Session</span>
                                <h4 class="text-2xl font-bold tracking-tight">{{ $nextTraining->title }}</h4>
                            </div>
                            <div class="space-y-2 text-sm text-zinc-300">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $nextTraining->scheduled_at->format('l, d M H:i') }}
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ $nextTraining->location ?? 'TBA' }}
                                </div>
                                @if ($nextTraining->target_distance_km)
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                        Target: {{ $nextTraining->target_distance_km }} KM
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center h-40 text-center text-zinc-500">
                            <p class="text-sm">Tidak ada jadwal latihan.</p>
                            <x-ui.button variant="outline" size="sm" class="mt-4"
                                href="{{ route('trainings.index') }}">Schedule Now</x-ui.button>
                        </div>
                    @endif
                </div>
            </x-ui.card>
        </div>
    </div>
@endsection
