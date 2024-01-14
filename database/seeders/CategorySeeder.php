<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $author = User::create([
            'name' => fake()->name(),
            'email' => fake()->email(),
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        $category = new Category([
            'name' => fake()->name(),
        ]);

        $category->author()->associate($author)->save();

        $posts = Post::all();
        $category->posts()->saveMany($posts);
    }
}
