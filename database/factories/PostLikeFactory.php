<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\user;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class PostLikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::inRandomOrder()->firstOrFail();
        $post = Post::inRandomOrder()->firstOrFail();

        return [
            'user_id' => $user->id,
            'post_id' => $post->id,
        ];
    }
}
