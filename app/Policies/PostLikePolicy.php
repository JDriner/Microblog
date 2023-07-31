<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\PostLike;
use App\Models\User;
use App\Models\UserFollower;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PostLikePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function like(User $user, $post_id)
    {
        return !PostLike::where('user_id', $user->id)
            ->where('post_id', $post_id)
            ->exists()
            ? Response::allow()
            : Response::deny('Error! You have already liked this post!');
    }

    public function unlike(User $user, $post_id)
    {
        return PostLike::where('user_id', $user->id)
            ->where('post_id', $post_id)
            ->exists()
            ? Response::allow()
            : Response::deny('Error! You haven\'t liked this post yet!');
    }
}