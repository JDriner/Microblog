<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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


    public function scopeSearch($query, $keyword): belongsTo
    {
        return $query->where('first_name', 'LIKE', '%' . $keyword . '%')
            ->orWhere('last_name', 'LIKE', '%' . $keyword . '%')
            ->get();
    }
}