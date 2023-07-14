<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    public function listFollows()
    {
        $user = auth()->user();
        // print("USER".$user."<br>");

        // Get the IDs of users being followed
        $following = $user->followings()
            ->pluck('user_following_id');
        // print("FOLLOWING".$following."<br>");

        // Get the IDs of users being followed
        $followers = $user->followers()
            ->pluck('user_id');
        // print("FOLLOWER".$followers."<br>");

        $followingUsers = User::whereIn('id', $following)
            ->get();

        $followerUsers = User::whereIn('id', $followers)
            ->get();
        // print("MY ID: ".$user->id ."<br>");
        // print("users i follow: ".$following ."<br>");

        $suggestedUserId = UserFollower::whereIn('user_id', $following)
            ->whereNotIn('user_following_id', $following)
            ->pluck('user_following_id');

        // print("Suggested User IDs".$suggestedUserId ."<br>");

        $suggestedUsers = User::whereIn('id', $suggestedUserId)->get();

        // print("Suggested Users".$suggestedUsers."<br>");

        $users = User::get();

        return view(
            'profile.follow-list',
            compact(
                'followingUsers',
                'followerUsers',
                'users',
                'suggestedUsers'
            )
        );
    }
}