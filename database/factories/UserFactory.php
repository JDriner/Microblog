<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'is_activated' => 1,
            'email_verified_at' => $this->faker->unique()->dateTime(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_activated' => 0,
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Create the posts of the users
     *
     * @return \Database\Factories\UserFactory
     */
    public function withPosts()
    {
        return $this
            ->has(PostFactory::new()->originalPost()
                    ->count(2)
                    ->withComments(), 'posts');
    }
}
