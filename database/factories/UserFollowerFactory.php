<?php

namespace Database\Factories;

use App\Models\user;
use App\Models\UserFollower;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFollowerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $follower = User::inRandomOrder()->firstOrFail();
        $following = User::where('id', '!=', $follower->id)->inRandomOrder()->first();

        return [
            'user_id' => $follower->id,
            'user_following_id' => $following->id,
        ];
    }
}
