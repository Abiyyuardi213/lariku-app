@extends('layouts.app')

@section('content')
    <div class="space-y-8">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="space-y-1">
                <h2
                    class="text-3xl font-extrabold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-zinc-900 to-zinc-600">
                    Halo, {{ explode(' ', auth()->user()->name)[0] }}! 👋
                </h2>
                <p class="text-zinc-500 font-medium">Siap membakar kalori dan dompet hari ini? 🏃💸</p>
            </div>
            <div class="flex items-center gap-2">
                <x-ui.button href="{{ route('events.create') }}"
                    class="bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white shadow-lg shadow-pink-200">
                    <span class="mr-2">🏆</span> Daftar Event Baru
                </x-ui.button>
            </div>
        </div>

        <!-- Budget Cards -->
        <div class="grid gap-4 md:grid-cols-2">
            <!-- Total Budget Card -->
            <div class="relative overflow-hidden rounded-xl border border-zinc-100 bg-white p-6 shadow-sm">
                <div class="absolute -right-6 -top-6 h-24 w-24 rounded-full bg-blue-50 opacity-50"></div>
                <div class="relative">
                    <div class="flex items-center justify-between pb-2">
                        <h3 class="text-sm font-semibold text-zinc-500">RAB Impian (Estimasi)</h3>
                        <span class="text-2xl">💭</span>
                    </div>
                    <div class="text-2xl font-bold tracking-tight text-blue-600">
                        Rp {{ number_format($totalEstimated, 0, ',', '.') }}
                    </div>
                    <p class="mt-2 text-xs text-zinc-400">Total angan-angan biaya event</p>
                </div>
            </div>

            <!-- Actual Budget Card -->
            <div class="relative overflow-hidden rounded-xl border border-zinc-100 bg-white p-6 shadow-sm">
                <div class="absolute -right-6 -top-6 h-24 w-24 rounded-full bg-pink-50 opacity-50"></div>
                <div class="relative">
                    <div class="flex items-center justify-between pb-2">
                        <h3 class="text-sm font-semibold text-zinc-500">Uang Melayang (Realita)</h3>
                        <span class="text-2xl">💸</span>
                    </div>
                    <div class="text-2xl font-bold tracking-tight text-pink-600">
                        Rp {{ number_format($totalActual, 0, ',', '.') }}
                    </div>
                    <div class="mt-2 flex items-center gap-2">
                        @if ($totalEstimated > 0)
                            <div class="h-1.5 w-full rounded-full bg-zinc-100 overflow-hidden">
                                <div class="h-full rounded-full bg-pink-500"
                                    style="width: {{ min(($totalActual / $totalEstimated) * 100, 100) }}%"></div>
                            </div>
                            <span
                                class="text-xs font-bold text-pink-600">{{ number_format(($totalActual / $totalEstimated) * 100, 0) }}%</span>
                        @else
                            <span class="text-xs text-zinc-400">Belum ada pengeluaran</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="grid gap-6 md:grid-cols-2 items-start">
            <!-- Upcoming Events (Left) -->
            <x-ui.card class="border-2 border-zinc-100 shadow-none h-full">
                <div class="p-6 pb-4 border-b border-zinc-50">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="text-xl">🗓️</span>
                            <h3 class="font-bold text-zinc-900">Kalender Balap</h3>
                        </div>
                        <a href="{{ route('events.index') }}"
                            class="text-xs font-semibold text-pink-600 hover:text-pink-700">Lihat Semua →</a>
                    </div>
                </div>
                <div class="p-6">
                    @if ($upcomingEvents->count() > 0)
                        <div class="space-y-4">
                            @foreach ($upcomingEvents as $event)
                                <div
                                    class="group relative flex items-center justify-between rounded-xl border border-zinc-100 bg-zinc-50/50 p-4 hover:border-pink-200 hover:bg-pink-50/30 transition-all">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="flex h-12 w-12 flex-col items-center justify-center rounded-lg bg-white border border-zinc-200 shadow-sm font-bold text-zinc-700">
                                            <span
                                                class="text-[10px] uppercase text-zinc-400">{{ $event->event_date->format('M') }}</span>
                                            <span class="text-lg leading-none">{{ $event->event_date->format('d') }}</span>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-zinc-900">{{ $event->name }}</h4>
                                            <p class="text-xs text-zinc-500 flex items-center gap-1">
                                                <span>📍 {{ $event->location }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <x-ui.badge variant="{{ $event->type === 'trail' ? 'default' : 'secondary' }}"
                                            class="mb-1">
                                            {{ $event->distance_category }}
                                        </x-ui.badge>
                                        <div class="text-xs font-medium text-pink-600">
                                            {{ now()->diffInDays($event->event_date, false) > 0 ? now()->diffInDays($event->event_date) . ' hari lagi' : 'Hari ini!' }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center py-10 text-center">
                            <span class="text-4xl mb-2">😴</span>
                            <p class="text-zinc-500 font-medium">Belum ada jadwal race.</p>
                            <p class="text-xs text-zinc-400">Yuk daftar event biar ada motivasi!</p>
                        </div>
                    @endif
                </div>
            </x-ui.card>

            <!-- Next Training (Right) -->
            <div>
                <div
                    class="relative overflow-hidden rounded-xl bg-gradient-to-br from-zinc-900 to-zinc-800 text-white shadow-xl h-full">
                    <!-- Decor -->
                    <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-white opacity-5 blur-3xl"></div>
                    <div class="absolute -left-10 bottom-0 h-32 w-32 rounded-full bg-pink-500 opacity-10 blur-2xl"></div>

                    <div class="p-6 relative flex flex-col h-full justify-between">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="font-bold flex items-center gap-2">
                                <span class="animate-pulse">🔥</span> Latihan Berikutnya
                            </h3>
                            @if ($nextTraining)
                                <div class="px-2 py-1 rounded bg-white/10 text-xs font-medium border border-white/10">
                                    {{ $nextTraining->type == 'long_run' ? 'Long Run' : ucfirst($nextTraining->type) }}
                                </div>
                            @endif
                        </div>

                        @if ($nextTraining)
                            <div class="space-y-6">
                                <div>
                                    <h2 class="text-3xl font-black tracking-tight leading-tight mb-1">
                                        {{ $nextTraining->title }}
                                    </h2>
                                    <p class="text-zinc-400 text-sm flex items-center gap-2">
                                        <span>🕒 {{ $nextTraining->scheduled_at->format('l, d F • H:i') }}</span>
                                    </p>
                                </div>

                                <div class="grid grid-cols-2 gap-3">
                                    <div class="rounded-lg bg-white/5 p-3 border border-white/5">
                                        <div class="text-xs text-zinc-400 uppercase tracking-wider mb-1">Target</div>
                                        <div class="text-lg font-bold text-pink-400">
                                            {{ $nextTraining->target_distance_km ? $nextTraining->target_distance_km . ' KM' : 'Just Run!' }}
                                        </div>
                                    </div>
                                    <div class="rounded-lg bg-white/5 p-3 border border-white/5">
                                        <div class="text-xs text-zinc-400 uppercase tracking-wider mb-1">Lokasi</div>
                                        <div class="text-lg font-bold text-blue-400 truncate">
                                            {{ $nextTraining->location ?? 'Bebas' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-2">
                                    <p class="text-xs text-center text-zinc-500 italic">"Jangan lupa stretching biar nggak
                                        jompo ya, Mas!"</p>
                                </div>
                            </div>
                        @else
                            <div class="py-10 text-center space-y-4">
                                <span class="text-4xl block">🛋️</span>
                                <div>
                                    <p class="font-bold">Mode Santai</p>
                                    <p class="text-sm text-zinc-400">Belum ada jadwal latihan nih.</p>
                                </div>
                                <x-ui.button variant="secondary" size="sm" href="{{ route('trainings.index') }}">
                                    Buat Jadwal Lari
                                </x-ui.button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
