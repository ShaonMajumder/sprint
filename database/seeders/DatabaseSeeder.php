<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $default_password = bcrypt("123456");

        // \App\Models\User::factory(10)->create();
        $user1 = User::factory()->create([
            "name" => "Shaon Majumder",
            "email"=> "smazoomder@gmail.com",
            "password" => $default_password
        ]);

        User::factory(50)->create([
            "password" => $default_password
        ]);

    }
}
