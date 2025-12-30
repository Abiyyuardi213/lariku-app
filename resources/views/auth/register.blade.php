@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-[80vh]">
        <div class="w-full max-w-sm space-y-6">
            <div class="space-y-2 text-center">
                <h1 class="text-3xl font-bold">Create an account</h1>
                <p class="text-zinc-500">Enter your information to create an account</p>
            </div>
            <x-ui.card class="p-6">
                <form action="{{ route('register') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-2">
                        <x-ui.label for="name">Full Name</x-ui.label>
                        <x-ui.input id="name" name="name" required placeholder="John Doe"
                            value="{{ old('name') }}" />
                    </div>
                    <div class="space-y-2">
                        <x-ui.label for="email">Email</x-ui.label>
                        <x-ui.input id="email" name="email" type="email" required placeholder="m@example.com"
                            value="{{ old('email') }}" />
                        @error('email')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <x-ui.label for="password">Password</x-ui.label>
                        <x-ui.input id="password" name="password" type="password" required />
                        @error('password')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <x-ui.label for="password_confirmation">Confirm Password</x-ui.label>
                        <x-ui.input id="password_confirmation" name="password_confirmation" type="password" required />
                    </div>
                    <div class="space-y-2">
                        <x-ui.label for="avatar">Profile Photo (Optional)</x-ui.label>
                        <x-ui.input id="avatar" name="avatar" type="file" accept="image/*"
                            class="file:bg-zinc-100 file:border-0 file:rounded-md file:px-2 file:py-1 file:text-xs file:font-semibold hover:file:bg-zinc-200" />
                    </div>
                    <x-ui.button type="submit" class="w-full">Sign Up</x-ui.button>
                </form>
                <div class="mt-4 text-center text-sm">
                    Already have an account?
                    <a href="{{ route('login') }}" class="underline font-medium">Sign in</a>
                </div>
            </x-ui.card>
        </div>
    </div>
@endsection
