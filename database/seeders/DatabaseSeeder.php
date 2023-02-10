<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Membuat user secara manual
        User::create([
            'name' => 'benk skuy',
            'username' => 'benk',
            'email' => 'ibenk@email.com',
            'password' => bcrypt('password')
        ]);
        // membuat user random otomatis, 3 user
        User::factory(3)->create();

        // bikin category secara manual
        Category::create([
            'name' => 'Web Programming',
            'slug' => 'web-programming'
        ]);
        
        Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);
        
        Category::create([
            'name' => 'Web Design',
            'slug' => 'web-design'
        ]);

        Post::factory(24)->create();
        
    }
}
