@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto space-y-6">
        <div class="flex items-center gap-4">
            <a href="{{ route('events.index') }}" class="p-2 -ml-2 rounded-md hover:bg-zinc-100 text-zinc-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h2 class="text-2xl font-bold tracking-tight">New Event</h2>
        </div>

        <x-ui.card>
            <form action="{{ route('events.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                <div class="space-y-2">
                    <x-ui.label for="name">Event Name</x-ui.label>
                    <x-ui.input id="name" name="name" placeholder="e.g. Borobudur Marathon 2025" required />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <x-ui.label for="type">Type</x-ui.label>
                        <select id="type" name="type"
                            class="flex h-9 w-full rounded-md border border-zinc-200 bg-transparent px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-zinc-950">
                            <option value="road">Road Run</option>
                            <option value="trail">Trail Run</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <x-ui.label for="distance">Distance</x-ui.label>
                        <x-ui.input id="distance" name="distance_category" placeholder="e.g. HM, FM, 10K" required />
                    </div>
                </div>

                <div class="space-y-2">
                    <x-ui.label for="location">Location</x-ui.label>
                    <x-ui.input id="location" name="location" placeholder="e.g. Magelang, Central Java" required />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <x-ui.label for="event_date">Date</x-ui.label>
                        <x-ui.input type="datetime-local" id="event_date" name="event_date" required />
                    </div>
                    <div class="space-y-2">
                        <x-ui.label for="status">Status</x-ui.label>
                        <select id="status" name="status"
                            class="flex h-9 w-full rounded-md border border-zinc-200 bg-transparent px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-zinc-950">
                            <option value="wishlist">Wishlist</option>
                            <option value="registered">Registered</option>
                            <option value="done">Done</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-2">
                    <x-ui.label for="registration_price">Registration Price (Est.)</x-ui.label>
                    <div class="relative">
                        <span class="absolute left-3 top-2.5 text-zinc-500 text-sm">Rp</span>
                        <x-ui.input type="number" id="registration_price" name="registration_price" class="pl-9"
                            placeholder="0" />
                    </div>
                </div>

                <div class="pt-4">
                    <x-ui.button type="submit" class="w-full">Create Event</x-ui.button>
                </div>
            </form>
        </x-ui.card>
    </div>
@endsection
