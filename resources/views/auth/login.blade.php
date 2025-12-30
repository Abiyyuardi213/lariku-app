@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-[80vh]">
        <div class="w-full max-w-md space-y-8">
            <div class="space-y-4 text-center">
                <div
                    class="mx-auto w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center text-3xl animate-bounce">
                    👟
                </div>
                <h1 class="text-3xl font-extrabold tracking-tight text-zinc-900">
                    Jadwalin Lari <br>
                    <span class="text-pink-600">Mas Abiiii</span> & <span class="text-blue-600">Pincen</span>
                </h1>
                <p class="text-zinc-500 text-lg">
                    Ayo login dulu biar wacana lari kita jadi nyata! 🏃💨
                </p>
            </div>

            <x-ui.card class="p-8 border-2 border-zinc-100 shadow-xl shadow-zinc-200/50">
                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="space-y-2">
                        <x-ui.label for="email">Email Mas Abi / Pincen</x-ui.label>
                        <x-ui.input id="email" name="email" type="email" required placeholder="nama@lariku.com"
                            value="{{ old('email') }}" class="h-11 bg-zinc-50" />
                        @error('email')
                            <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <x-ui.label for="password">Password Rahasia</x-ui.label>
                        </div>
                        <x-ui.input id="password" name="password" type="password" required class="h-11 bg-zinc-50" />
                    </div>

                    <x-ui.button type="submit"
                        class="w-full h-11 text-base font-bold bg-gradient-to-r from-zinc-900 to-zinc-700 hover:to-zinc-800 transition-all">
                        Gass Masuk! 🚀
                    </x-ui.button>
                </form>

                <div class="mt-6 text-center text-sm text-zinc-500">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="underline font-bold text-zinc-900 hover:text-pink-600">Bikin
                        dulu sini</a>
                </div>
            </x-ui.card>

            <p class="text-center text-xs text-zinc-400">
                Created with ❤️ for our healthy journey
            </p>
        </div>
    </div>
@endsection
