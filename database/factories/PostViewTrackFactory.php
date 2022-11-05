<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\User;
use \App\Models\Post;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostViewTrack>
 */
class PostViewTrackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user=User::inRandomOrder()->first();
        $post=Post::inRandomOrder()->first();

        return [
            'post_id' =>$post->id,
            'user_id' =>$user->id,
            'viewed_at'=> \Carbon\Carbon::now()
        ];
    }
}
