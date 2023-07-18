<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserFollower;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function follow(Request $request)
    {
        $follow = UserFollower::create([
            'user_id' => auth()->user()->id,
            'user_following_id' => $request->user_id,
        ]);

        return response()->json([
            'success' => 'Followed',
        ]);
    }

    public function unfollow(Request $request)
    {
        $followedUser = UserFollower::whereUserId(auth()->user()->id)
            ->whereUserFollowingId($request->user_id)
            ->first();
        $followedUser->delete();

        return response()->json([
            'success' => 'Unfollowed',
        ]);
    }

    public function listFollows()
    {
        $user = auth()->user();
        // Get the IDs of users being followed
        // $following = $user->followings()
        //     ->pluck('user_following_id');

        // Get the IDs of users being followed
        // $followers = $user->followers()
        //     ->pluck('user_id');

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