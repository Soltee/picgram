<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        factory(App\User::class, 60)->create();
        factory(App\Post::class, 200)->create();
        factory(App\PostImage::class, 300)->create();
        factory(App\User::class)->create([
            'name' => "Test",
            'email' => "test@example.com",
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Illuminate\Support\Str::random(10),
        ]);
        factory(App\Comment::class, 140)->create();

        
    }
}
