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

        factory(App\User::class, 20)->create();
        factory(App\User::class)->create([
        	'name' => 'Soltee',
        	'email' => 'soltee.13@gmail.com',
        	'email_verified_at' => now(),
        	'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        	'remember_token' => Str::random(10)
        ]);
    }
}
