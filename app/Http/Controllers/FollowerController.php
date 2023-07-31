<?php

namespace App\Http\Controllers;

use App\Http\Requests\FollowRequest;
use App\Models\User;
use App\Models\UserFollower;
use App\Policies\FollowPolicy;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    /**
     * Follow a user that was requested
     * @param Request $request
     * @return
     */
    public function follow(Request $request, $user_id)
    {
        $this->authorize(
            'follow',
            [UserFollower::class, $user_id]
        );

        $follow = UserFollower::create([
            'user_id' => auth()->user()->id,
            'user_following_id' => $user_id,
        ]);

        return response()->json([
            'success' => 'You have followed a user!',
        ]);
    }

    /**
     * Unfollow a user
     * @param Request $request
     * @return void
     */
    public function unfollow(Request $request, $user_id)
    {
        $this->authorize(
            'unfollow',
            [UserFollower::class, $user_id]
        );

        $followedUser = UserFollower::whereUserId(auth()->user()->id)
            ->whereUserFollowingId($user_id)
            ->firstOrFail();
        $followedUser->delete();

        return response()->json([
            'success' => 'You have unfollowed a user!',
        ]);
    }

    /**
     * List down the followers/following and suggested users in the page
     * @param [type] $type
     * @return
     */
    public function listFollows($type)
    {
        $user = auth()->user();
        $following = User::whereIn('id', $user->followings()
            ->pluck('user_following_id'))
            ->get();

        $followers = User::whereIn('id', $user->followers()
            ->pluck('user_id'))
            ->get();

        $suggestedUsers = User::suggestedUsers()->get();
        $users = User::get();

        return view(
            'profile.follow-list',
            compact(
                'followers',
                'following',
                'users',
                'suggestedUsers'
            )
        );
    }
}