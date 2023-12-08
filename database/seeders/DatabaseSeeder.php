<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->count(10)
            ->has(Post::factory()->count(3))
            ->create();
        User::create([
            'name' => 'Ahmad Zaid',
            'username' => 'adhamz',
            'bio' => 'Your bio goes here.',
            'image' => 'https://ui-avatars.com/api/?name=' . urlencode('Ahmad Zaid'),
            'email' => 'ahmaadzaid7@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'remember_token' => Str::random(10),
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}