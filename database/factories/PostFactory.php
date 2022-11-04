<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $paragraphs = fake()->paragraphs(rand(2, 6));
        $title = fake()->realText(50);
        $post = "<h1>".$title."</h1>";
        foreach ($paragraphs as $para) {
            $post .= "<p>".$para."</p>";
        }
        $user=User::inRandomOrder()->first();
        return [
            'user_id'=>$user->id,
            'content' =>$post
        ];
    }
}
