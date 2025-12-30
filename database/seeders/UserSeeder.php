<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Helper to download avatar
        $downloadAvatar = function ($seed) {
            $url = "https://api.dicebear.com/7.x/adventurer/png?seed=" . $seed;
            $contents = Http::get($url)->body();
            $filename = 'avatars/' . Str::random(10) . '.png';
            Storage::disk('public')->put($filename, $contents);
            return $filename;
        };

        // Buat folder avatars jika belum ada
        if (!Storage::disk('public')->exists('avatars')) {
            Storage::disk('public')->makeDirectory('avatars');
        }

        User::create([
            'name' => 'Abiyyu Ardilian',
            'email' => 'abiyyu@lariku.com',
            'password' => Hash::make('password'),
            'avatar' => $downloadAvatar('Abiyyu'),
        ]);

        User::create([
            'name' => 'Vincentia Meiliana',
            'email' => 'vincentia@lariku.com',
            'password' => Hash::make('password'),
            'avatar' => $downloadAvatar('Vincentia'),
        ]);

        $this->command->info('Users seeded! Login: abiyyu@lariku.com / password');
    }
}
