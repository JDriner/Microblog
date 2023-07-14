<?php

namespace App\Http\Controllers;

use App\Models\UserFollower;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function follow(Request $request)
    {
        $follow = UserFollower::updateOrCreate([
            'user_id' => auth()->user()->id,
            'user_following_id' => $request->user_id,
        ]);

        return response()->json([
            'success' => 'Followed'
        ]);
    }

    public function unfollow(Request $request)
    {
        $followedUser = UserFollower::whereUserId(auth()->user()->id)
            ->whereUserFollowingId($request->user_id)
            ->first();
        $followedUser->delete();

        return response()->json([
            'success' => 'Unfollowed'
        ]);
    }
}
