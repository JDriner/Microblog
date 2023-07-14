<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFollower extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_following_id',
    ];

    public function follower()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function following()
    {
        return $this->belongsTo(User::class, 'user_following_id', 'id');
    }

    // If authenticated user follows the user
    // public function userIsFollowing()
    // {
    //     return $this->followers->where('user_id', auth()->id())->first();
    // }


}