<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::inRandomOrder()->firstOrFail();
        $post = Post::inRandomOrder()->first();

        $imageUrl = "https://picsum.photos/400/300?random=" . $this->faker->randomNumber();

        return [
            'user_id' => $user->id,
            'post_id' => $post ? $post->id : null,
            'content' => $this->faker->unique()->realText($this->faker->numberBetween(10, 140)),
            'image' => $imageUrl,
            'created_at' => $this->faker->dateTimeThisYear(),
        ];
    }
    
    public function originalPost(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'post_id' => null,
            ];
        });
    }

    /**
     * Create a factory state for a factory worker employee classification.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
     */
    public function sharedPost(): Factory
    {
        $post = Post::inRandomOrder()->first();
        
        return $this->state(function (array $attributes) use ($post) {
            return [
                'post_id' => $post ? $post->id : null,
                'image' => null,
            ];
        });
    }
    
    public function withComments()
    {
        return $this
            ->has(CommentFactory::new()->count(1), 'comments');
    }
}
