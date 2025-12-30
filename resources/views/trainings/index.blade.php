@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-bold tracking-tight">Training Log</h2>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            <!-- New Training Form -->
            <div class="lg:col-span-1">
                <x-ui.card class="p-6 sticky top-6">
                    <h3 class="font-semibold mb-4">Schedule Training</h3>
                    <form action="{{ route('trainings.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="space-y-2">
                            <x-ui.label>Title</x-ui.label>
                            <x-ui.input name="title" placeholder="e.g. Morning Easy Run" required />
                        </div>
                        <div class="space-y-2">
                            <x-ui.label>Type</x-ui.label>
                            <select name="type"
                                class="flex h-9 w-full rounded-md border border-zinc-200 bg-white px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-zinc-950">
                                <option value="run">Easy Run</option>
                                <option value="long_run">Long Run</option>
                                <option value="interval">Interval/Speed</option>
                                <option value="strength">Strength</option>
                                <option value="recce">Trail Recce</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <x-ui.label>Date & Time</x-ui.label>
                            <x-ui.input type="datetime-local" name="scheduled_at" required />
                        </div>
                        <div class="space-y-2">
                            <x-ui.label>Target Distance (KM)</x-ui.label>
                            <x-ui.input type="number" step="0.1" name="target_distance_km" />
                        </div>
                        <div class="space-y-2">
                            <x-ui.label>Location</x-ui.label>
                            <x-ui.input name="location" placeholder="e.g. GBK" />
                        </div>
                        <x-ui.button type="submit" class="w-full">Schedule</x-ui.button>
                    </form>
                </x-ui.card>
            </div>

            <!-- Training List -->
            <div class="lg:col-span-2 space-y-4">
                @forelse($trainings as $training)
                    <x-ui.card class="p-5 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex gap-4">
                            <div
                                class="flex flex-col items-center justify-center w-14 h-14 bg-zinc-100 rounded-lg text-zinc-900 border border-zinc-200">
                                <span class="text-xs font-bold uppercase">{{ $training->scheduled_at->format('M') }}</span>
                                <span class="text-xl font-bold">{{ $training->scheduled_at->format('d') }}</span>
                            </div>
                            <div class="space-y-1">
                                <div class="flex items-center gap-2">
                                    <h4 class="font-bold">{{ $training->title }}</h4>
                                    <x-ui.badge
                                        variant="secondary">{{ ucfirst(str_replace('_', ' ', $training->type)) }}</x-ui.badge>
                                </div>
                                <div class="text-sm text-zinc-500 flex items-center gap-3">
                                    <span>{{ $training->scheduled_at->format('H:i') }}</span>
                                    <span>•</span>
                                    <span>{{ $training->location ?? 'Anywhere' }}</span>
                                    @if ($training->target_distance_km)
                                        <span>•</span>
                                        <span class="font-medium text-zinc-900">{{ $training->target_distance_km }}
                                            KM</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </x-ui.card>
                @empty
                    <div class="text-center py-12 text-zinc-500">
                        No scheduled trainings.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
