<?php

namespace Database\Factories;

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
        $imageUrl = "https://picsum.photos/400/300?random=" . $this->faker->randomNumber();

        return [
            'user_id' => $this->faker->firstName(),
            // 'post_id' => $this->faker->lastName(),
            'content' => $this->faker->unique()->realText($this->faker->numberBetween(10, 140)),
            'image' => $imageUrl,
        ];
    }
    
    public function withComments()
    {
        return $this
            ->has(PostFactory::new()->count(10), 'employees');
            // ->withComments();  
    }
}
