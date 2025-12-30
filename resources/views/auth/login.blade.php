@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-[80vh]">
        <div class="w-full max-w-sm space-y-6">
            <div class="space-y-2 text-center">
                <h1 class="text-3xl font-bold">Login</h1>
                <p class="text-zinc-500">Enter your email to sign in to your account</p>
            </div>
            <x-ui.card class="p-6">
                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="space-y-2">
                        <x-ui.label for="email">Email</x-ui.label>
                        <x-ui.input id="email" name="email" type="email" required placeholder="m@example.com"
                            value="{{ old('email') }}" />
                        @error('email')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <x-ui.label for="password">Password</x-ui.label>
                            <a href="#" class="text-xs underline">Forgot password?</a>
                        </div>
                        <x-ui.input id="password" name="password" type="password" required />
                    </div>
                    <x-ui.button type="submit" class="w-full">Sign In</x-ui.button>
                </form>
                <div class="mt-4 text-center text-sm">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="underline font-medium">Sign up</a>
                </div>
            </x-ui.card>
        </div>
    </div>
@endsection
