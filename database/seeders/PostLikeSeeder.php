<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use \App\Models\User;
use \App\Models\Post;
use \App\Models\PostLike;


class PostLikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=User::all();
        $userCount = User::count();
        Post::all()->each(function ($post) use ($users,$userCount) { 
            $post->likes()->attach($users->random(rand(1, $userCount))->pluck('id'));
        });         
       
    }
}
