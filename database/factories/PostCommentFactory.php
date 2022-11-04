<?php

namespace Database\Factories;
use \App\Models\User;
use \App\Models\Post;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostComment>
 */
class PostCommentFactory extends Factory
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
            'comment' => fake()->text(),
        ];
    }
}
