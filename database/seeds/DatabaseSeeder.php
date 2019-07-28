<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(App\Category::class)->create(['name' => 'Art']);
        factory(App\Category::class)->create(['name' => 'Beauty']);
        factory(App\Category::class)->create(['name' => 'Comics']);
        factory(App\Category::class)->create(['name' => 'Entertainment']);
        factory(App\Category::class)->create(['name' => 'Fitness']);
        factory(App\Category::class)->create(['name' => 'Technology']);
    }
}
