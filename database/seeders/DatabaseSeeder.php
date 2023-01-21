<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Database\Factories\CategoryFactory;
use Database\Factories\TagFactory;
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
        Category::factory(20)->create();
        $tags =Tag::factory(30)->create();
        $posts =Post::factory(200)->create();

         foreach ($posts as $post){
             $tagsId = $tags->random(5)->pluck('id');
             $post->tags()->attach($tagsId);
         }


    }
}
