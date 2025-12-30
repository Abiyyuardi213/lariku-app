@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-start justify-between">
            <div class="space-y-1">
                <div class="flex items-center gap-3">
                    <a href="{{ route('events.index') }}" class="text-zinc-500 hover:text-zinc-900">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7 7-7" />
                        </svg>
                    </a>
                    <h2 class="text-3xl font-bold tracking-tight">{{ $event->name }}</h2>
                    <x-ui.badge
                        variant="{{ $event->status === 'registered' ? 'default' : 'outline' }}">{{ ucfirst($event->status) }}</x-ui.badge>
                </div>
                <div class="flex items-center gap-4 text-zinc-500 text-sm pl-8">
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        {{ $event->location }}
                    </span>
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ $event->event_date->format('d M Y, H:i') }}
                    </span>
                </div>
            </div>
            <div class="text-right">
                <div class="text-4xl font-bold font-mono tracking-tighter">
                    {{ now()->diffInDays($event->event_date, false) > 0 ? now()->diffInDays($event->event_date) : 0 }}</div>
                <div class="text-xs uppercase text-zinc-500 font-bold">Days Left</div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid gap-6 lg:grid-cols-3">

            <!-- Left: Details -->
            <div class="space-y-6 lg:col-span-2">
                <!-- Budget Section -->
                <x-ui.card>
                    <div class="p-6 border-b border-zinc-100 flex items-center justify-between">
                        <h3 class="font-semibold text-lg">Event Budget Plan (RAB)</h3>
                        <span class="text-xs font-mono bg-zinc-100 px-2 py-1 rounded">Total: Rp
                            {{ number_format($event->budgets->sum('estimated_amount'), 0, ',', '.') }}</span>
                    </div>

                    <div class="p-6 space-y-6">
                        <!-- Add Item Form -->
                        <form action="{{ route('events.budgets.store', $event) }}" method="POST"
                            class="flex flex-col md:flex-row gap-3 items-end bg-zinc-50 p-4 rounded-lg border border-zinc-100">
                            @csrf
                            <div class="w-full md:w-1/4 space-y-1">
                                <x-ui.label for="category" class="text-xs">Category</x-ui.label>
                                <select name="category"
                                    class="flex h-9 w-full rounded-md border border-zinc-200 bg-white px-3 py-1 text-sm shadow-sm">
                                    <option value="ticket">Race Ticket</option>
                                    <option value="travel">Travel</option>
                                    <option value="stay">Accommodation</option>
                                    <option value="gear">Gear</option>
                                    <option value="food">Food & Sups</option>
                                </select>
                            </div>
                            <div class="w-full md:w-2/4 space-y-1">
                                <x-ui.label for="item" class="text-xs">Item Name</x-ui.label>
                                <x-ui.input name="item" placeholder="e.g. Flight Ticket" required />
                            </div>
                            <div class="w-full md:w-1/4 space-y-1">
                                <x-ui.label for="estimated_amount" class="text-xs">Est. Cost</x-ui.label>
                                <x-ui.input type="number" name="estimated_amount" placeholder="0" required />
                            </div>
                            <x-ui.button type="submit" size="sm" class="mb-[2px]">Add</x-ui.button>
                        </form>

                        <!-- Table -->
                        <div class="relative w-full overflow-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="border-b border-zinc-200">
                                        <th class="h-10 px-2 text-left align-middle font-medium text-zinc-500">Item</th>
                                        <th class="h-10 px-2 text-right align-middle font-medium text-zinc-500">Est.</th>
                                        <th class="h-10 px-2 text-right align-middle font-medium text-zinc-500">Actual</th>
                                        <th class="h-10 px-2 text-center align-middle font-medium text-zinc-500">Paid?</th>
                                        <th class="h-10 px-2 text-right align-middle font-medium text-zinc-500"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($event->budgets as $budget)
                                        <tr class="border-b border-zinc-100 hover:bg-zinc-50/50 transition-colors">
                                            <td class="p-2 align-middle">
                                                <div class="font-medium">{{ $budget->item }}</div>
                                                <div class="text-xs text-zinc-400 capitalize">{{ $budget->category }}</div>
                                            </td>
                                            <td class="p-2 align-middle text-right font-mono text-zinc-600">
                                                {{ number_format($budget->estimated_amount, 0, ',', '.') }}
                                            </td>
                                            <td class="p-2 align-middle text-right">
                                                <form action="{{ route('budgets.update', $budget) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="number" name="actual_amount"
                                                        value="{{ (int) $budget->actual_amount }}"
                                                        class="w-24 text-right bg-transparent border-b border-transparent hover:border-zinc-300 focus:border-zinc-900 focus:outline-none text-zinc-900 font-mono text-sm"
                                                        onchange="this.form.submit()">
                                                </form>
                                            </td>
                                            <td class="p-2 align-middle text-center">
                                                <form action="{{ route('budgets.update', $budget) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="is_paid" value="0">
                                                    <input type="checkbox" name="is_paid" value="1"
                                                        {{ $budget->is_paid ? 'checked' : '' }}
                                                        class="rounded border-zinc-300 text-zinc-900 focus:ring-zinc-900"
                                                        onchange="this.form.submit()">
                                                </form>
                                            </td>
                                            <td class="p-2 align-middle text-right">
                                                <form action="{{ route('budgets.destroy', $budget) }}" method="POST"
                                                    onsubmit="return confirm('Delete?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-zinc-400 hover:text-red-600">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="bg-zinc-50 font-medium">
                                    <tr>
                                        <td class="p-2 px-4">Total</td>
                                        <td class="p-2 text-right">Rp
                                            {{ number_format($event->budgets->sum('estimated_amount'), 0, ',', '.') }}</td>
                                        <td class="p-2 text-right">Rp
                                            {{ number_format($event->budgets->sum('actual_amount'), 0, ',', '.') }}</td>
                                        <td colspan="2"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </x-ui.card>
            </div>

            <!-- Right: Maps / Info -->
            <div class="space-y-6">
                <x-ui.card class="p-6 space-y-4">
                    <h3 class="font-semibold">Event Info</h3>
                    <dl class="space-y-4 text-sm">
                        <div class="flex justify-between border-b pb-2 border-zinc-50">
                            <dt class="text-zinc-500">Type</dt>
                            <dd class="font-medium capitalize">{{ $event->type }}</dd>
                        </div>
                        <div class="flex justify-between border-b pb-2 border-zinc-50">
                            <dt class="text-zinc-500">Distance</dt>
                            <dd class="font-medium">{{ $event->distance_category }}</dd>
                        </div>
                        <div class="flex justify-between border-b pb-2 border-zinc-50">
                            <dt class="text-zinc-500">Registration</dt>
                            <dd class="font-medium">Rp {{ number_format($event->registration_price, 0, ',', '.') }}</dd>
                        </div>
                    </dl>
                    <x-ui.button variant="outline" class="w-full">Edit Event</x-ui.button>
                </x-ui.card>
            </div>
        </div>
    </div>
@endsection
