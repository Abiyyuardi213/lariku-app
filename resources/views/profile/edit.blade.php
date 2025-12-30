@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto space-y-6">
        <div class="space-y-2">
            <h2 class="text-3xl font-bold tracking-tight">Profile Settings</h2>
            <p class="text-zinc-500">Manage your account settings and preferences.</p>
        </div>

        <x-ui.card class="p-6">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Avatar Section -->
                <div class="flex items-center gap-6">
                    <div class="relative w-24 h-24 rounded-full overflow-hidden border border-zinc-200 bg-zinc-100">
                        @if ($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" class="w-full h-full object-cover"
                                alt="Avatar">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-zinc-400">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="space-y-2 flex-1">
                        <x-ui.label for="avatar">Change Photo</x-ui.label>
                        <x-ui.input id="avatar" name="avatar" type="file" accept="image/*" />
                        <p class="text-xs text-zinc-500">JPG, GIF or PNG. Max size of 2MB.</p>
                    </div>
                </div>

                <div class="space-y-2">
                    <x-ui.label for="name">Display Name</x-ui.label>
                    <x-ui.input id="name" name="name" value="{{ old('name', $user->name) }}" required />
                </div>

                <div class="space-y-2">
                    <x-ui.label for="email">Email Address</x-ui.label>
                    <x-ui.input id="email" name="email" type="email" value="{{ old('email', $user->email) }}"
                        required />
                </div>

                <hr class="border-zinc-100 my-4">

                <div class="space-y-4">
                    <h3 class="font-medium">Change Password</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <x-ui.label for="password">New Password</x-ui.label>
                            <x-ui.input id="password" name="password" type="password"
                                placeholder="Leave blank to keep current" />
                        </div>
                        <div class="space-y-2">
                            <x-ui.label for="password_confirmation">Confirm Password</x-ui.label>
                            <x-ui.input id="password_confirmation" name="password_confirmation" type="password" />
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <x-ui.button type="submit">Save Changes</x-ui.button>
                </div>
            </form>
        </x-ui.card>
    </div>
@endsection
