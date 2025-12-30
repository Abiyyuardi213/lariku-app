<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lariku - Road to Start Line</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-zinc-50 text-zinc-900 antialiased pb-20 md:pb-0">

    <div class="min-h-screen md:flex">
        @auth
            <!-- Desktop Sidebar -->
            <aside class="hidden md:flex flex-col w-64 border-r border-zinc-200 bg-white h-screen fixed inset-y-0 left-0">
                <div class="p-6 border-b border-zinc-100">
                    <h1 class="text-xl font-bold tracking-tight">Lariku.</h1>
                </div>
                <nav class="flex-1 p-4 space-y-1">
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('dashboard') ? 'bg-zinc-100 text-zinc-900' : 'text-zinc-500 hover:text-zinc-900 hover:bg-zinc-50' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('events.index') }}"
                        class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('events*') ? 'bg-zinc-100 text-zinc-900' : 'text-zinc-500 hover:text-zinc-900 hover:bg-zinc-50' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Events
                    </a>
                    <a href="{{ route('trainings.index') }}"
                        class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('trainings*') ? 'bg-zinc-100 text-zinc-900' : 'text-zinc-500 hover:text-zinc-900 hover:bg-zinc-50' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Training
                    </a>
                    <div class="mt-auto pt-4 border-t border-zinc-100">
                        <div class="px-3 py-2 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-zinc-100 overflow-hidden border border-zinc-200">
                                    @if (auth()->user()->avatar)
                                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}"
                                            class="w-full h-full object-cover" alt="Avatar">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-zinc-400">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="text-sm">
                                    <p class="font-medium text-zinc-900 line-clamp-1">{{ auth()->user()->name }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="px-3 space-y-1">
                            <a href="{{ route('profile.edit') }}"
                                class="block px-3 py-2 text-xs text-zinc-500 hover:text-zinc-900 rounded-md hover:bg-zinc-50">Edit
                                Profile</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-3 py-2 text-xs text-red-500 hover:text-red-700 rounded-md hover:bg-red-50">Sign
                                    Out</button>
                            </form>
                        </div>
                    </div>
                </nav>
            </aside>
        @endauth

        <!-- Main Content -->
        <main class="flex-1 @auth md:ml-64 @endauth p-4 md:p-8 w-full">
            @if (session('success'))
                <div class="mb-4 p-4 text-sm text-green-700 bg-green-50 rounded-lg border border-green-200"
                    role="alert">
                    <span class="font-medium">Success!</span> {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>

        @auth
            <!-- Mobile Bottom Nav -->
            <nav
                class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-zinc-200 flex justify-around p-3 pb-safe z-50">
                <a href="{{ route('dashboard') }}"
                    class="flex flex-col items-center gap-1 {{ request()->routeIs('dashboard') ? 'text-zinc-900' : 'text-zinc-400' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="text-[10px] font-medium">Home</span>
                </a>
                <a href="{{ route('events.index') }}"
                    class="flex flex-col items-center gap-1 {{ request()->routeIs('events*') ? 'text-zinc-900' : 'text-zinc-400' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="text-[10px] font-medium">Events</span>
                </a>
                <a href="{{ route('trainings.index') }}"
                    class="flex flex-col items-center gap-1 {{ request()->routeIs('trainings*') ? 'text-zinc-900' : 'text-zinc-400' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    <span class="text-[10px] font-medium">Train</span>
                </a>
                <a href="{{ route('profile.edit') }}"
                    class="flex flex-col items-center gap-1 {{ request()->routeIs('profile*') ? 'text-zinc-900' : 'text-zinc-400' }}">
                    <div class="w-6 h-6 rounded-full bg-zinc-100 overflow-hidden border border-zinc-200">
                        @if (auth()->user()->avatar)
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}"
                                class="w-full h-full object-cover" alt="Profile">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-zinc-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <span class="text-[10px] font-medium">Me</span>
                </a>
            </nav>
        @endauth
    </div>
</body>

</html>
