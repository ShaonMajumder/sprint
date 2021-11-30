<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Link;
use App\Models\Sprint;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $default_password = bcrypt(env('ACCOUNT_DEFAULT_PASSWORD'));
        
        $user1 = User::factory()->create([
            "name" => "Shaon Majumder",
            "email"=> "smazoomder@gmail.com",
            "password" => $default_password
        ]);

        User::factory(100)->create([
            "password" => $default_password
        ]);

        Sprint::factory(5)->create();

        Category::factory()->create([
            "title" => "open",
            "class" => "open",
            "sort_id" => 0,
            "icon" => '<i class="fas fa-folder-open"></i>',
            "color" => '#C1CEAD'
        ]);
        Category::factory()->create([
            "title" => 'done',
            "class" => "done",
            "sort_id" => 1,
            "icon" => '<i class="fas fa-check"></i>',
            "color" => '#52B67C'
        ]);
        Category::factory()->create([
            "title" => 'bug',
            "class" => "bug",
            "sort_id" => 2,
            "icon" => '<i class="fas fa-times"></i>',
            "color" => '#D35352'
        ]);
        Category::factory()->create([
            "title" => 'qa',
            "class" => "qa",
            "sort_id" => 3,
            "icon" => '<i class="fab fa-searchengin"></i>',
            "color" => '#5d7db8'
        ]);
        Category::factory()->create([
            "title" => 'progress',
            "class" => "in-progress",
            "sort_id" => 4,
            "icon" => '<i class="fas fa-wrench"></i>',
            "color" => '#D6D46A'
        ]);

        
    
    
    
        

    }
}
