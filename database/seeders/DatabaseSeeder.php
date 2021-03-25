<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\User;
use App\Profile;
use App\Post;
use App\PostImage;
use App\Comment;
// use Illuminate\Foundation\Auth\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        factory(User::class, 20)->create();
        factory(User::class)->create([
            'name' => "Test",
            'email' => "test@example.com",
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Illuminate\Support\Str::random(10),
        ]);
        // factory(Profile::class, 21)->create();
        factory(Post::class, 50)->create();
        factory(PostImage::class, 100)->create();
        factory(Comment::class, 100)->create();

        
    }
}
