<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use App\Models\UserFollower;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserFollowerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function follow(User $user, $user_following_id)
    {
        return !UserFollower::where('user_id', $user->id)
            ->where('user_following_id', $user_following_id)
            ->exists()
            ? Response::allow()
            : Response::deny('Error! you are already following this user!');
    }

    public function unfollow(User $user, $user_following_id)
    {
        return UserFollower::where('user_id', $user->id)
            ->where('user_following_id', $user_following_id)
            ->exists()
            ? Response::allow()
            : Response::deny('Error! you have already unfollowed this user!');
    }
}