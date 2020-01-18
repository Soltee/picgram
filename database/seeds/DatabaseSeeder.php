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

        factory(App\User::class, 40)->create();
        factory(App\Post::class, 100)->create();
        factory(App\PostImage::class, 200)->create();
        
    }
}
