<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'profile_picture',
        'phone_no',
        'password',
        'is_activated',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // followers of the logged in user
    public function followers()
    {
        return $this->hasMany(UserFollower::class, 'user_following_id', 'id');
    }

    // followings of the logged in user
    public function followings()
    {
        return $this->hasMany(UserFollower::class, 'user_id', 'id');
    }

    public function isUserFollowed()
    {
        return $this->followers()->where('user_id', auth()->id())->exists();
    }

    public function isUserFollower()
    {
        return $this->followers()->where('user_id', auth()->id())->exists();
    }

    // search function - returns users based on keyword
    public function scopeSearchUser(Builder $query, $search)
    {
        $loggedInUserId = auth()->user()->id;

        return $query->where(function ($query) use ($search) {
            $query->where('first_name', 'LIKE', '%' . $search . '%')
                ->orWhere('last_name', 'LIKE', '%' . $search . '%');
        })
            ->where('id', '!=', $loggedInUserId)
            ->get();
    }

    // Show suggested users
    public function scopeSuggestedUsers(Builder $query)
    {
        $user = auth()->user();
        $followingIds = $user->followings->pluck('user_following_id');
        $suggestedUserId = UserFollower::whereIn('user_id', $followingIds)
            ->whereNotIn('user_following_id', $followingIds)
            ->pluck('user_following_id');

        return $query->whereIn('id', $suggestedUserId)
            ->where('id', '!=', $user->id);
    }




    // For Mutual Followers count ------ not working ----> not required tho -----------
    public function scopeMutualFollowers($query)
    {
        $userId = $this->id;
        $authUser = auth()->user();
        $followingIds = $this->followings->pluck('user_following_id');
        $followersIds = $this->followers->pluck('user_id');
        $userFollowingIds = $authUser->followings->pluck('user_following_id');

        // $result = $query->whereExists(function ($subquery) use ($userId) {
        //     $subquery->select('user_id')
        //         ->from('user_followers')
        //         ->whereColumn('user_id', '=', 'user_followers.user_following_id')
        //         ->where('user_followers.user_id', $userId);
        // });
        $result = 2;

        return $userFollowingIds;
    }
    
}